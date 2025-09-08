# Compresión y Descompresión LZW con Codificación Binaria

Este proyecto implementa el algoritmo de compresión LZW (Lempel-Ziv-Welch) y codifica la salida en una cadena binaria continua, usando el número mínimo de bits necesario para cada código. Permite comprimir y descomprimir cualquier texto de manera eficiente.

---

## Descripción del Código

### 1. Compresión LZW

La función `lzw_compress` toma una cadena de texto y genera una lista de códigos numéricos, construyendo un diccionario dinámico de subcadenas encontradas en el texto.

```python
def lzw_compress(uncompressed):
    dict_size = 256
    dictionary = {chr(i): i for i in range(dict_size)}
    w = ""
    result = []
    for c in uncompressed:
        wc = w + c
        if wc in dictionary:
            w = wc
        else:
            result.append(dictionary[w])
            dictionary[wc] = dict_size
            dict_size += 1
            w = c
    if w:
        result.append(dictionary[w])
    return result
```

---

### 2. Descompresión LZW

La función `lzw_decompress` toma una lista de códigos numéricos y reconstruye el texto original utilizando el mismo método de diccionario dinámico.

```python
def lzw_decompress(compressed):
    dict_size = 256
    dictionary = {i: chr(i) for i in range(dict_size)}
    result = []
    w = chr(compressed.pop(0))
    result.append(w)
    for k in compressed:
        if k in dictionary:
            entry = dictionary[k]
        elif k == dict_size:
            entry = w + w[0]
        else:
            raise ValueError("Código inválido: %s" % k)
        result.append(entry)
        dictionary[dict_size] = w + entry[0]
        dict_size += 1
        w = entry
    return "".join(result)
```

---

### 3. Codificación y Decodificación Binaria

Para reducir el tamaño de la salida, los códigos se convierten a una cadena binaria continua. El número de bits por código se determina por el valor máximo de la lista.

```python
def to_binary_string(codes):
    if not codes:
        return ""
    max_code = max(codes)
    bit_length = max_code.bit_length()
    return ''.join(f"{code:0{bit_length}b}" for code in codes), bit_length

def from_binary_string(bin_str, bit_length):
    codes = []
    for i in range(0, len(bin_str), bit_length):
        code = int(bin_str[i:i+bit_length], 2)
        codes.append(code)
    return codes
```

---

### 4. Menú Interactivo

El menú permite al usuario elegir entre comprimir texto, descomprimir una cadena binaria o salir del programa.

```python
def main():
    while True:
        print("\nOpciones:")
        print("1. Comprimir texto (LZW, salida binaria)")
        print("2. Descomprimir cadena binaria (LZW)")
        print("3. Salir")
        opcion = input("Selecciona una opción (1/2/3): ").strip()
        if opcion == "1":
            texto = input("Ingresa el texto a comprimir: ")
            comprimido = lzw_compress(texto)
            binario, bits = to_binary_string(comprimido)
            print(f"Comprimido (binario): {binario}")
            print(f"Longitud de bit por código: {bits}")
        elif opcion == "2":
            binario = input("Ingresa la cadena binaria comprimida: ").strip()
            bits = int(input("Ingresa la longitud de bit por código: "))
            try:
                lista_codigos = from_binary_string(binario, bits)
                descomprimido = lzw_decompress(lista_codigos)
                print("Descomprimido:", descomprimido)
            except Exception as e:
                print("Error:", e)
        elif opcion == "3":
            print("¡Hasta luego!")
            break
        else:
            print("Opción no válida. Intenta de nuevo.")
```

---

## Ejemplo de Uso

### Compresión

```
Selecciona una opción (1/2/3): 1
Ingresa el texto a comprimir: ababababa
Comprimido (binario): 011000010110001001000000100000010
Longitud de bit por código: 7
```

### Descompresión

```
Selecciona una opción (1/2/3): 2
Ingresa la cadena binaria comprimida: 011000010110001001000000100000010
Ingresa la longitud de bit por código: 7
Descomprimido: ababababa
```

---

## Requisitos

- Python 3.x

---

## Ejecución

Guarda el código en un archivo `.py` y ejecútalo con:

```bash
python3 dictionary_compression.py
```
