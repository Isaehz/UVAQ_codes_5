# Definición de la función 'metodo' que calcula el módulo de 'a' respecto a 'm'
def metodo(a, m):
    b = a % m  # Calcula el residuo de la división de 'a' entre 'm'
    return b   # Retorna el resultado

# Ejemplo de uso
a = int(input("Introduce a: "))  # Solicita al usuario el valor de 'a'
m = int(input("Introduce m: "))  # Solicita al usuario el valor de 'm'

# Muestra el resultado de 'a mod m' usando la función 'metodo'
print(f"{a} mod {m} = {metodo(a, m)}")