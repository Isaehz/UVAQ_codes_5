# Explicación del Código: Cálculo de Módulo en Python

Este archivo explica cómo funciona el código para calcular el módulo (`a mod m`) de dos números en Python.

## 1. Definición de la función

El código define una función llamada `metodo` que recibe dos parámetros: `a` y `m`. La función retorna el residuo de la división de `a` entre `m` usando el operador `%`.

```python
def metodo(a, m):
    b = a % m  # Calcula el residuo de la división de 'a' entre 'm'
    return b   # Retorna el resultado
```

## 2. Solicitud de datos al usuario

El programa solicita al usuario dos números enteros: el número a calcular el módulo (`a`) y el módulo (`m`).

```python
a = int(input("Introduce a: "))  # Solicita al usuario el valor de 'a'
m = int(input("Introduce m: "))  # Solicita al usuario el valor de 'm'
```

## 3. Mostrar el resultado

Finalmente, el programa muestra el resultado del cálculo usando la función `metodo` y una cadena formateada.

```python
print(f"{a} mod {m} = {metodo(a, m)}")
```

## Ejemplo de ejecución

```
Introduce a: 17
Introduce m: 5
17 mod 5 = 2
```

## Resumen

Este código es útil para calcular el residuo de una división entre dos números, lo cual es fundamental en criptografía y matemáticas modulares.
