def encrypt(message, key):
    result = ""
    for char in message:
        if char.isalpha():  # Solo procesa letras
            shift = ord('A') if char.isupper() else ord('a')  # Determina base según mayúscula/minúscula
            result += chr((ord(char) - shift + key) % 26 + shift)  # Aplica el desplazamiento
        else:
            result += char  # Conserva espacios y símbolos
    return result

def decrypt(message, key):
    return encrypt(message, -key)  # Desencripta invirtiendo el desplazamiento

# Entrada del usuario
message = input("Escribe el mensaje: ")  # Solicita mensaje
key = int(input("Escribe la llave (número): "))  # Solicita llave

ciphertext = encrypt(message, key)  # Cifra el mensaje
print("Mensaje cifrado:", ciphertext)

plaintext = decrypt(ciphertext, key)  # Descifra el mensaje
print("Mensaje descifrado:", plaintext)