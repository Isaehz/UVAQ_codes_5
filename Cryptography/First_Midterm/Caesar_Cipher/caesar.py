def cifrado_cesar(texto, desplazamiento):
    resultado = ""
    for caracter in texto:
        # Si el carácter es una letra mayúscula (ASCII)
        if caracter.isupper():
            resultado += chr((ord(caracter) - 65 + desplazamiento) % 26 + 65)
        # Si el carácter es una letra minúscula (ASCII)
        elif caracter.islower():
            resultado += chr((ord(caracter) - 97 + desplazamiento) % 26 + 97)
        # Si no es letra, lo deja igual
        else:
            resultado += caracter
    return resultado

# Solicita el mensaje al usuario
mensaje = input("Ingresa el mensaje a cifrar: ")
print("------")
desplazamiento = 5

# Cifra el mensaje
mensaje_cifrado = cifrado_cesar(mensaje, desplazamiento)

# Imprime resultados
print("Mensaje original:", mensaje)
print("Mensaje cifrado:", mensaje_cifrado)