import codecs

# Solicita una cadena al usuario
texto = input("Introduce una cadena: ")

# Decodifica la cadena (si fuera bytes, aquí suponemos que es str, así que lo convertimos a bytes primero)
texto_bytes = texto.encode('ascii')
texto_decodificado = codecs.decode(texto_bytes, encoding='ascii', errors='strict')

# Vuelve a codificar en otra codificación (por ejemplo, latin1)
texto_codificado = texto_decodificado.encode('cp949', errors='replace')

print("Texto original:", texto)
print("Texto recodificado:", texto_codificado) 