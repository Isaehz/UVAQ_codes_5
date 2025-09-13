def modulo(a, m):
    # Calcula el residuo de a entre m, reutilizacion de codigo Mod_Function
    return a % m

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


# --- Ejemplo de uso ---
a = int(input("Introduce a: "))
m = int(input("Introduce m: "))

inv = Inv(a, m)

if inv is None:
    print(f"No existe inversa modular de {a} mod {m}")
else:
    print(f"La inversa de {a} mod {m} es: {inv}")
