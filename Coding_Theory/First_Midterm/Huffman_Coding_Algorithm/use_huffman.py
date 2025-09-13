import sys
# Agrega el directorio actual al path para poder importar módulos locales
sys.path.insert(1, '.')

# Importa la clase HuffmanCoding del archivo huffman.py
from huffman import HuffmanCoding

# Solicita al usuario el nombre o ruta del archivo a comprimir
path = input("Cual archivo comprimo: ")

# Crea una instancia de HuffmanCoding con la ruta del archivo
h = HuffmanCoding(path)

# Comprime el archivo y obtiene la ruta del archivo comprimido
output_path = h.compress()
print("Compressed file path: " + output_path)

# Descomprime el archivo comprimido y obtiene la ruta del archivo descomprimido
decom_path = h.decompress(output_path)
print("Decompressed file path: " + decom_path)