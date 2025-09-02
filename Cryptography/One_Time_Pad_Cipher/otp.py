import os

def str_to_bytes(s):
    return s.encode('utf-8')

def bytes_to_str(b):
    return b.decode('utf-8')

def generate_key(length):
    return os.urandom(length)

def otp_encrypt(message, key):
    return bytes([m ^ k for m, k in zip(message, key)])

def otp_decrypt(ciphertext, key):
    return bytes([c ^ k for c, k in zip(ciphertext, key)])

# Solicitar mensaje al usuario
mensaje = input("Introduce el mensaje a cifrar: ")
mensaje_bytes = str_to_bytes(mensaje)

# Generar clave aleatoria
clave = generate_key(len(mensaje_bytes))

# Cifrar mensaje
cifrado = otp_encrypt(mensaje_bytes, clave)
print("Mensaje cifrado (hex):", cifrado.hex())
print("Clave (hex):", clave.hex())

# Descifrar mensaje (opcional, para probar)
descifrado = otp_decrypt(cifrado, clave)
print("Mensaje descifrado:", bytes_to_str(descifrado))