# Explicación del Código – Cifrado por Sustitución Aleatoria

## Descripción general
El **Cifrado por Sustitución** consiste en reemplazar cada letra del mensaje original por otro símbolo o valor, según una tabla o diccionario de equivalencias. 
En este caso, el programa asigna a cada letra del alfabeto (mayúsculas y minúsculas) un **valor ASCII aleatorio** único.

Este método es más seguro que el Cifrado César, ya que no sigue un patrón fijo de desplazamiento, sino una correspondencia aleatoria entre letras y códigos.

---

## Funcionamiento del código

### 1. Importación de librerías
```python
import random  # Para generar valores aleatorios
```
Se importa la librería `random`, necesaria para crear asignaciones aleatorias.

---

### 2. Generar el abecedario
```python
abecedario = [chr(i) for i in range(ord('A'), ord('Z')+1)] + [chr(i) for i in range(ord('a'), ord('z')+1)]
```
- Se crean dos listas: una con letras mayúsculas (`A` a `Z`) y otra con minúsculas (`a` a `z`).
- Se combinan en una sola lista llamada `abecedario`.

---

### 3. Generar valores ASCII aleatorios únicos
```python
ascii_vals = random.sample(list(range(65, 91)) + list(range(97, 123)), len(abecedario))
```
- `range(65, 91)` son los valores ASCII de `A` a `Z`.
- `range(97, 123)` son los valores ASCII de `a` a `z`.
- `random.sample()` mezcla estos valores y devuelve una lista con todos, sin repetir.

---

### 4. Crear diccionario de sustitución
```python
sustitucion = dict(zip(abecedario, ascii_vals))
```
- Se crea un **diccionario** que asocia cada letra con un valor ASCII aleatorio.

Ejemplo:
```
A -> 120
B -> 68
...
```

---

### 5. Mostrar la asociación
```python
for letra in abecedario:
    print(f"{letra} -> {sustitucion[letra]}")
```
Imprime cada letra con el valor ASCII que le fue asignado.

---

### 6. Pedir mensaje al usuario
```python
mensaje = input("\nIngresa el mensaje a cifrar: ")
```
Solicita el texto que será cifrado.

---

### 7. Cifrar el mensaje
```python
cifrado = []
for c in mensaje:
    if c in sustitucion:
        cifrado.append(str(sustitucion[c]))
    else:
        cifrado.append(c)
```
- Si el carácter está en el diccionario, se sustituye por su valor ASCII aleatorio.
- Si no está (espacios, signos, números), se mantiene igual.

---

### 8. Mostrar el mensaje cifrado
```python
print(' '.join(cifrado))
```
Muestra el mensaje como una secuencia de números separados por espacios.

---

## Ejemplo de ejecución
```
Asociación letra - valor ASCII:
A -> 110
B -> 97
C -> 122
...

Ingresa el mensaje a cifrar: Hola
Mensaje cifrado:
120 101 105 110
```

---

## Ventajas y desventajas
**Ventajas:**
- Difícil de descifrar sin la clave.
- No sigue un patrón predecible.

**Desventajas:**
- Se necesita conocer y compartir la tabla de sustitución exacta.
- Si la clave se pierde, es casi imposible recuperar el mensaje original.
