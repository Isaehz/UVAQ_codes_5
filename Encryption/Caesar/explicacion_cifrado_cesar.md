# Explicación del Código – Cifrado César

## Descripción general
El **Cifrado César** es uno de los métodos más antiguos de cifrado. Consiste en desplazar cada letra del mensaje un número fijo de posiciones en el alfabeto. 
Por ejemplo, con un desplazamiento de `3`, la letra `A` se convierte en `D`, la `B` en `E`, y así sucesivamente.

Este script implementa el Cifrado César para letras mayúsculas y minúsculas, manteniendo sin cambios cualquier carácter que no sea letra (como espacios, números o signos de puntuación).

---

## Funcionamiento del código

### 1. Función `cifrado_cesar(texto, desplazamiento)`
- **Entrada:** 
  - `texto`: El mensaje que se quiere cifrar. 
  - `desplazamiento`: Número de posiciones que se moverán las letras en el alfabeto.
- **Proceso:** 
  1. Recorre cada carácter del texto. 
  2. Si el carácter es **mayúscula** (`isupper()`), convierte la letra en su valor ASCII con `ord()`, aplica el desplazamiento usando módulo 26 para mantener el rango de letras, y vuelve a convertirlo a carácter con `chr()`. 
  3. Si el carácter es **minúscula** (`islower()`), hace el mismo proceso pero usando el rango ASCII de letras minúsculas. 
  4. Si el carácter **no es una letra**, lo deja igual.
- **Salida:** 
  Devuelve el texto cifrado.

---

### 2. Solicitud de entrada al usuario
```python
mensaje = input("Ingresa el mensaje a cifrar: ")
```
Pide al usuario que escriba el texto que quiere cifrar.

---

### 3. Configuración del desplazamiento
```python
desplazamiento = 5
```
El valor `5` significa que cada letra será reemplazada por la que está **cinco posiciones adelante** en el alfabeto. 
Por ejemplo:
- `A → F`
- `b → g`

---

### 4. Cifrado del mensaje
```python
mensaje_cifrado = cifrado_cesar(mensaje, desplazamiento)
```
Se llama a la función y se guarda el resultado.

---

### 5. Impresión del resultado
```python
print("Mensaje original:", mensaje)
print("Mensaje cifrado:", mensaje_cifrado)
```
Muestra el mensaje original y el mensaje cifrado.

---

## Ejemplo de ejecución
```
Ingresa el mensaje a cifrar: Hola Mundo
------
Mensaje original: Hola Mundo
Mensaje cifrado: Mtqf Rzsit
```

---

## Ventajas y desventajas
**Ventajas:**
- Fácil de implementar.
- Sirve para introducir conceptos de criptografía.

**Desventajas:**
- Es muy inseguro: solo tiene 25 posibles claves.
- Puede romperse fácilmente con análisis de frecuencia.
