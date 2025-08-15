# Definimos una función para mostrar los divisores de un número
def mostrar_divisores(n):
    # Imprime un mensaje indicando el número del que se mostrarán los divisores
    print(f"Los divisores de {n} son: ")
    # Itera desde 1 hasta n
    for i in range(1, n + 1):
        # Si n es divisible entre i, entonces i es un divisor
        if n % i == 0:
            print(i, end = ", ")

# Punto de entrada principal del programa
if __name__ == "__main__":
    try:
        # Solicita al usuario que introduzca un número entero positivo
        numero = int(input("Introduce un número entero positivo: "))
        if numero > 0:
            mostrar_divisores(numero)
        else:
            print("Por favor, introduce un número entero positivo.")
    except ValueError:
        print("Entrada no válida. Debes introducir un número entero positivo.")