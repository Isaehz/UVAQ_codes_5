# Explicación del Shift Cipher en Python

Este archivo implementa el cifrado por desplazamiento (Shift Cipher), también conocido como cifrado César. El programa permite cifrar y descifrar mensajes usando una llave numérica.

## Funciones principales

### 1. `encrypt(message, key)`

Esta función cifra el mensaje desplazando cada letra por el valor de la llave.

```python
def encrypt(message, key):
    result = ""
    for char in message:
        if char.isalpha():  # Solo procesa letras
            shift = ord('A') if char.isupper() else ord('a')  # Determina base según mayúscula/minúscula
            result += chr((ord(char) - shift + key) % 26 + shift)  # Aplica el desplazamiento
        else:
            result += char  # Conserva espacios y símbolos
    return result
```

- **char.isalpha()**: Solo cifra letras, dejando intactos espacios y símbolos.
- **shift**: Determina si la letra es mayúscula o minúscula para mantener el caso.
- **chr((ord(char) - shift + key) % 26 + shift)**: Realiza el desplazamiento circular en el alfabeto.

### 2. `decrypt(message, key)`

Esta función descifra el mensaje invirtiendo el desplazamiento.

```python
def decrypt(message, key):
    return encrypt(message, -key)  # Desencripta invirtiendo el desplazamiento
```

- Utiliza la función `encrypt` con la llave negativa para revertir el cifrado.

## Uso interactivo

El programa solicita al usuario el mensaje y la llave, luego muestra el mensaje cifrado y descifrado.

```python
message = input("Escribe el mensaje: ")  # Solicita mensaje
key = int(input("Escribe la llave (número): "))  # Solicita llave

ciphertext = encrypt(message, key)  # Cifra el mensaje
print("Mensaje cifrado:", ciphertext)

plaintext = decrypt(ciphertext, key)  # Descifra el mensaje
print("Mensaje descifrado:", plaintext)
```

## Ejemplo de ejecución

```
Escribe el mensaje: Hola Mundo!
Escribe la llave (número): 3
Mensaje cifrado: Krod Pxqgr!
Mensaje descifrado: Hola Mundo!
```

## Resumen

- El cifrado por desplazamiento es sencillo y rápido.
- Solo afecta letras, manteniendo espacios y símbolos.
- La función `decrypt` reutiliza la lógica de `encrypt` con la llave negativa.
