# Explicación del flujo de `useHuffman.py`

Este archivo es un script que utiliza la clase `HuffmanCoding` para comprimir y descomprimir archivos usando el algoritmo de Huffman. A continuación se explica cada sección del código:

---

## 1. Importación de módulos

```python
import sys
# Agrega el directorio actual al path para poder importar módulos locales
sys.path.insert(1, '.')
```

Se importa el módulo `sys` y se agrega el directorio actual al `sys.path` para permitir la importación de módulos locales, como `huffman.py`.

---

## 2. Importación de la clase HuffmanCoding

```python
from huffman import HuffmanCoding
```

Se importa la clase `HuffmanCoding` desde el archivo `huffman.py`, que contiene la lógica para comprimir y descomprimir archivos usando el algoritmo de Huffman.

---

## 3. Solicitud de archivo al usuario

```python
# Solicita al usuario el nombre o ruta del archivo a comprimir
path = input("Cual archivo comprimo: ")
```

Se solicita al usuario que ingrese el nombre o la ruta del archivo que desea comprimir.

---

## 4. Creación de la instancia de HuffmanCoding

```python
# Crea una instancia de HuffmanCoding con la ruta del archivo
h = HuffmanCoding(path)
```

Se crea una instancia de la clase `HuffmanCoding` utilizando la ruta proporcionada por el usuario.

---

## 5. Compresión del archivo

```python
# Comprime el archivo y obtiene la ruta del archivo comprimido
output_path = h.compress()
print("Compressed file path: " + output_path)
```

Se llama al método `compress()` para comprimir el archivo y se imprime la ruta del archivo comprimido.

---

## 6. Descompresión del archivo

```python
# Descomprime el archivo comprimido y obtiene la ruta del archivo descomprimido
decom_path = h.decompress(output_path)
print("Decompressed file path: " + decom_path)
```

Se llama al método `decompress()` para descomprimir el archivo comprimido y se imprime la ruta del archivo descomprimido.

---

## Resumen del flujo

1. El usuario ingresa el archivo a comprimir.
2. Se crea un objeto para manejar la compresión y descompresión.
3. Se comprime el archivo y se muestra la ruta del archivo comprimido.
4. Se descomprime el archivo y se muestra la ruta del archivo descomprimido.
