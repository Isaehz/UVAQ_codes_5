# Explicación del Algoritmo de Compresión Huffman en Python

Este documento explica el funcionamiento del código de compresión y descompresión de archivos usando el algoritmo de Huffman, implementado en el archivo `huffman.py`.

---

## ¿Qué es Huffman Coding?

El **algoritmo de Huffman** es un método de compresión sin pérdida que asigna códigos binarios más cortos a los caracteres más frecuentes y códigos más largos a los menos frecuentes, logrando así reducir el tamaño total del archivo.

---

## Estructura del Código

### 1. Construcción del Árbol de Huffman

- **Frecuencia de caracteres:**  
  Se cuenta cuántas veces aparece cada carácter en el texto.
  ```python
  def make_frequency_dict(self, text):
      frequency = {}
      for character in text:
          if not character in frequency:
              frequency[character] = 0
          frequency[character] += 1
      return frequency
  ```

- **Heap de nodos:**  
  Se crea un min-heap donde cada nodo representa un carácter y su frecuencia.
  ```python
  def make_heap(self, frequency):
      for key in frequency:
          node = self.HeapNode(key, frequency[key])
          heapq.heappush(self.heap, node)
  ```

- **Fusión de nodos:**  
  Se combinan los dos nodos de menor frecuencia hasta que solo queda uno (la raíz del árbol).
  ```python
  def merge_nodes(self):
      while(len(self.heap)>1):
          node1 = heapq.heappop(self.heap)
          node2 = heapq.heappop(self.heap)
          merged = self.HeapNode(None, node1.freq + node2.freq)
          merged.left = node1
          merged.right = node2
          heapq.heappush(self.heap, merged)
  ```

---

### 2. Asignación de Códigos Binarios

Se recorre el árbol para asignar un código binario único a cada carácter.
```python
def make_codes_helper(self, root, current_code):
    if(root == None):
        return
    if(root.char != None):
        self.codes[root.char] = current_code
        self.reverse_mapping[current_code] = root.char
        return
    self.make_codes_helper(root.left, current_code + "0")
    self.make_codes_helper(root.right, current_code + "1")
```

---

### 3. Codificación del Texto

Cada carácter del texto original se reemplaza por su código binario.
```python
def get_encoded_text(self, text):
    encoded_text = ""
    for character in text:
        encoded_text += self.codes[character]
    return encoded_text
```

---

### 4. Relleno y Conversión a Bytes

- **Relleno:**  
  Se añaden ceros al final para que la longitud sea múltiplo de 8 bits.
  ```python
  def pad_encoded_text(self, encoded_text):
      extra_padding = 8 - len(encoded_text) % 8
      for i in range(extra_padding):
          encoded_text += "0"
      padded_info = "{0:08b}".format(extra_padding)
      encoded_text = padded_info + encoded_text
      return encoded_text
  ```

- **Conversión a bytes:**  
  El texto binario se agrupa en bytes para escribirlo en un archivo binario.
  ```python
  def get_byte_array(self, padded_encoded_text):
      b = bytearray()
      for i in range(0, len(padded_encoded_text), 8):
          byte = padded_encoded_text[i:i+8]
          b.append(int(byte, 2))
      return b
  ```

---

### 5. Compresión

El método `compress` coordina todo el proceso de compresión y guarda el resultado en un archivo `.bin`.
```python
def compress(self):
    filename, file_extension = os.path.splitext(self.path)
    output_path = filename + ".bin"
    with open(self.path, 'r+') as file, open(output_path, 'wb') as output:
        text = file.read()
        text = text.rstrip()
        frequency = self.make_frequency_dict(text)
        self.make_heap(frequency)
        self.merge_nodes()
        self.make_codes()
        encoded_text = self.get_encoded_text(text)
        padded_encoded_text = self.pad_encoded_text(encoded_text)
        b = self.get_byte_array(padded_encoded_text)
        output.write(bytes(b))
    print("Compressed")
    return output_path
```

---

### 6. Descompresión

- **Lectura y decodificación:**  
  Se lee el archivo binario, se eliminan los ceros de relleno y se reconstruye el texto original.
  ```python
  def decompress(self, input_path):
      filename, file_extension = os.path.splitext(self.path)
      output_path = filename + "_decompressed" + ".txt"
      with open(input_path, 'rb') as file, open(output_path, 'w') as output:
          bit_string = ""
          byte = file.read(1)
          while(len(byte) > 0):
              byte = ord(byte)
              bits = bin(byte)[2:].rjust(8, '0')
              bit_string += bits
              byte = file.read(1)
          encoded_text = self.remove_padding(bit_string)
          decompressed_text = self.decode_text(encoded_text)
          output.write(decompressed_text)
      print("Decompressed")
      return output_path
  ```

---

## Resumen del Flujo

1. **Compresión:**  
   - Leer archivo → calcular frecuencias → construir árbol → asignar códigos → codificar texto → rellenar → guardar como binario.

2. **Descompresión:**  
   - Leer binario → reconstruir bits → quitar relleno → decodificar usando el árbol → guardar texto original.

---

## Notas

- El árbol de Huffman y los códigos generados solo se mantienen en memoria durante la ejecución.
- Para descomprimir correctamente, el diccionario de códigos debe ser el mismo que se usó para comprimir.
