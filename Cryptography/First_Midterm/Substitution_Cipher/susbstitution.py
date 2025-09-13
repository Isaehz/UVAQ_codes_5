import random #Para generar valores aleatorios

# Generar abecedario (mayúsculas y minúsculas)
abecedario = [chr(i) for i in range(ord('A'), ord('Z')+1)] + [chr(i) for i in range(ord('a'), ord('z')+1)]

# Generar valores ASCII aleatorios únicos para cada letra (dentro de 65-90 y 97-122)
ascii_vals = random.sample(list(range(65, 91)) + list(range(97, 123)), len(abecedario))

# Crear diccionario de sustitución
sustitucion = dict(zip(abecedario, ascii_vals))

# Imprimir asociación
print("Asociación letra - valor ASCII:")
for letra in abecedario:
    print(f"{letra} -> {sustitucion[letra]}")

# Pedir mensaje al usuario
mensaje = input("\nIngresa el mensaje a cifrar: ")

# Cifrar el mensaje
cifrado = []
for c in mensaje:
    if c in sustitucion:
        cifrado.append(str(sustitucion[c]))
    else:
        cifrado.append(c)  # Caracteres fuera del abecedario se mantienen igual

print("\nMensaje cifrado:")
print(' '.join(cifrado))