# Explicación del código: Euler’s Totient Function

Este archivo explica el funcionamiento del script `euler_totient.py`, que calcula la función totiente de Euler φ(n).

## ¿Qué es la función totiente de Euler?

La función totiente de Euler, φ(n), cuenta cuántos números enteros positivos menores o iguales a `n` son coprimos con `n` (es decir, su máximo común divisor con `n` es 1).

## Código explicado

### Importación de la librería

```python
import math
```
Se importa el módulo `math` para usar la función `gcd` (máximo común divisor).

### Definición de la función

```python
def euler_phi(n):
    count = 0
    for k in range(1, n + 1):
        if math.gcd(n, k) == 1:
            count += 1
    return count
```
- Recorre todos los números desde 1 hasta `n`.
- Si el máximo común divisor entre `n` y `k` es 1, incrementa el contador.
- Devuelve el total de números coprimos con `n`.

### Entrada del usuario

```python
n = int(input("Introduce un número entero n: "))
```
Solicita al usuario un número entero.

### Salida del resultado

```python
print(f"φ({n}) = {euler_phi(n)}")
```
Muestra el resultado de la función totiente de Euler para el número ingresado.

## Ejemplo de uso

```
Introduce un número entero n: 9
φ(9) = 6
```
Esto significa que hay 6 números entre 1 y 9 que son coprimos con 9.

## Resumen

Este script es útil para entender la función totiente de Euler y su aplicación en criptografía y teoría de números.
