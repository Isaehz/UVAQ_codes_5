# Explicación del Código – Cifrado One-Time Pad (OTP)

## Descripción general
El **One-Time Pad** es un método de cifrado teóricamente irrompible, siempre que se cumplan ciertas condiciones:
1. La clave es completamente aleatoria.
2. La clave tiene la misma longitud que el mensaje.
3. La clave se usa solo una vez.

Este cifrado funciona aplicando la operación XOR (`^`) entre cada byte del mensaje y el byte correspondiente de la clave.

---

## Funcionamiento del código

### 1. Importación de librerías
```python
import os
```
Se importa `os` para usar `os.urandom()`, que genera bytes aleatorios criptográficamente seguros.

---

### 2. Funciones auxiliares
```python
def str_to_bytes(s):
    return s.encode('utf-8')

def bytes_to_str(b):
    return b.decode('utf-8')
```
- **`str_to_bytes`**: Convierte un texto en bytes usando UTF-8.
- **`bytes_to_str`**: Convierte bytes a texto usando UTF-8.

---

### 3. Generación de clave
```python
def generate_key(length):
    return os.urandom(length)
```
Genera una clave aleatoria de `length` bytes.

---

### 4. Funciones de cifrado y descifrado
```python
def otp_encrypt(message, key):
    return bytes([m ^ k for m, k in zip(message, key)])

def otp_decrypt(ciphertext, key):
    return bytes([c ^ k for c, k in zip(ciphertext, key)])
```
- **Cifrado (`otp_encrypt`)**: Aplica XOR entre cada byte del mensaje (`m`) y el byte de la clave (`k`).
- **Descifrado (`otp_decrypt`)**: Aplica XOR entre cada byte del cifrado y la clave. 
  *(La operación XOR es reversible: aplicar XOR dos veces con la misma clave devuelve el mensaje original).*

---

### 5. Solicitar mensaje
```python
mensaje = input("Introduce el mensaje a cifrar: ")
mensaje_bytes = str_to_bytes(mensaje)
```
Convierte el mensaje a bytes para trabajar con valores binarios.

---

### 6. Generar clave
```python
clave = generate_key(len(mensaje_bytes))
```
Crea una clave aleatoria con la misma longitud que el mensaje.

---

### 7. Cifrar mensaje
```python
cifrado = otp_encrypt(mensaje_bytes, clave)
print("Mensaje cifrado (hex):", cifrado.hex())
print("Clave (hex):", clave.hex())
```
- Cifra el mensaje y muestra el resultado en formato **hexadecimal** para que sea legible.
- Muestra también la clave en hexadecimal.

---

### 8. Descifrar mensaje (opcional)
```python
descifrado = otp_decrypt(cifrado, clave)
print("Mensaje descifrado:", bytes_to_str(descifrado))
```
Descifra el mensaje para verificar que el proceso funciona.

---

## Ejemplo de ejecución
```
Introduce el mensaje a cifrar: Hola
Mensaje cifrado (hex): 4f9a17d3
Clave (hex): 020d75a7
Mensaje descifrado: Hola
```

---

## Ventajas y desventajas
**Ventajas:**
- Seguridad perfecta si se cumplen las condiciones.
- Imposible romperlo sin la clave.

**Desventajas:**
- La clave debe ser tan larga como el mensaje.
- No se puede reutilizar la clave.
- Requiere un método seguro para compartir la clave.
