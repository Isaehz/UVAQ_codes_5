# Explicación del código: Inversa Modular en Python

Este archivo implementa el cálculo de la **inversa modular** usando el Algoritmo Extendido de Euclides. Es útil en criptografía y teoría de números.

---

## 1. Función `modulo(a, m)`

Calcula el residuo de `a` entre `m` (operación módulo).

```python
def modulo(a, m):
    # Calcula el residuo de a entre m, reutilizacion de codigo Mod_Function
    return a % m
```

---

## 2. Función `Inv(a, m)`

Calcula la inversa modular de `a` módulo `m`, es decir, encuentra un número `inv` tal que:

```
(a * inv) % m == 1
```

Utiliza el **Algoritmo Extendido de Euclides** para encontrar la solución.

```python
def Inv(a, m):
    """
    Calcula la inversa modular de 'a' módulo 'm'
    usando el Algoritmo Extendido de Euclides.
    Retorna inv tal que (a * inv) % m = 1
    """

    # Variables iniciales para el algoritmo
    old_r, r = m, a       # restos
    old_t, t = 0, 1       # coeficientes para la inversa

    # Bucle del algoritmo extendido de Euclides
    while r != 0:
        quotient = old_r // r  # cociente de la división
        old_r, r = r, old_r - quotient * r
        old_t, t = t, old_t - quotient * t

    # Si el máximo común divisor no es 1 → no existe inversa
    if old_r != 1:
        return None

    # Ajustar a positivo usando nuestra función modulo
    return modulo(old_t, m)
```

**Notas:**
- Si el máximo común divisor (MCD) de `a` y `m` no es 1, no existe inversa modular.
- El resultado se ajusta para ser positivo usando la función `modulo`.

---

## 3. Ejemplo de uso

El usuario ingresa los valores de `a` y `m`, y el programa muestra la inversa modular si existe.

```python
a = int(input("Introduce a: "))
m = int(input("Introduce m: "))

inv = Inv(a, m)

if inv is None:
    print(f"No existe inversa modular de {a} mod {m}")
else:
    print(f"La inversa de {a} mod {m} es: {inv}")
```

---

## 4. Ejemplo de ejecución

Supón que el usuario ingresa `a = 3` y `m = 11`:

```
Introduce a: 3
Introduce m: 11
La inversa de 3 mod 11 es: 4
```

Porque `3 * 4 % 11 = 12 % 11 = 1`.

---

## 5. Resumen

- El código calcula la inversa modular usando el Algoritmo Extendido de Euclides.
- Si no existe inversa, retorna `None`.
- Es útil para aplicaciones criptográficas y matemáticas.

