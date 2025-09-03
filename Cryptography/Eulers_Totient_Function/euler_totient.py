import math

# Calcula la función totiente de Euler φ(n)
def euler_phi(n):
    count = 0
    # Recorre todos los números desde 1 hasta n
    for k in range(1, n + 1):
        # Si k es coprimo con n, incrementa el contador
        if math.gcd(n, k) == 1:
            count += 1
    return count

# Solicita un número entero al usuario
n = int(input("Introduce un número entero n: "))

# Muestra el resultado de φ(n)
print(f"φ({n}) = {euler_phi(n)}")