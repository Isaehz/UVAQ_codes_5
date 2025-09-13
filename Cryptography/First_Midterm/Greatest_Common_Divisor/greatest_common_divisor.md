# Cálculo del Máximo Común Divisor (MCD)

Este programa en Python solicita dos números enteros positivos al usuario y calcula su **máximo común divisor (MCD)** utilizando el **algoritmo de Euclides**.

## Código

```python
# Definimos una función para calcular el máximo común divisor (MCD) 
def gcd(a, b):
    # Mientras b no sea cero, seguimos iterando
    while b != 0:
        # Asignamos a 'a' el valor de 'b' y a 'b' el residuo de 'a' entre 'b'
        a, b = b, a % b
    # Cuando b es cero, 'a' es el MCD
    return a

# Función principal del programa
def main():
    try:
        # Solicitamos al usuario el primer número entero positivo
        num1 = int(input("Ingresa el primer número entero positivo: "))
        # Solicitamos al usuario el segundo número entero positivo
        num2 = int(input("Ingresa el segundo número entero positivo: "))
        # Verificamos que ambos números sean positivos
        if num1 <= 0 or num2 <= 0:
            print("Por favor, ingresa solo números enteros positivos.")
            return
        # Calculamos el MCD usando la función definida
        resultado = gcd(num1, num2)
        # Mostramos el resultado al usuario
        print(f"El máximo común divisor de {num1} y {num2} es: {resultado}")
    except ValueError:
        # Si el usuario ingresa un valor no entero, mostramos un mensaje de error
        print("Entrada inválida. Por favor, ingresa números enteros.")

# Verificamos que este archivo se esté ejecutando directamente
if __name__ == "__main__":
    main()
```

## Ejemplo de ejecución

```
Ingresa el primer número entero positivo: 56
Ingresa el segundo número entero positivo: 98
El máximo común divisor de 56 y 98 es: 14
```

## Notas
- Se utiliza el **algoritmo de Euclides** para obtener el MCD de manera eficiente.
- El programa verifica que los números sean positivos.
- Maneja errores en caso de que el usuario ingrese valores no enteros.
