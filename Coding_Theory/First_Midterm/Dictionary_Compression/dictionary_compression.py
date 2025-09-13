def lzw_compress(uncompressed):
    """
    Realiza la compresión LZW sobre una cadena de texto.
    Devuelve una lista de códigos numéricos correspondientes a las subcadenas.
    """
    dict_size = 256
    dictionary = {chr(i): i for i in range(dict_size)}
    w = ""
    result = []
    for c in uncompressed:
        wc = w + c
        if wc in dictionary:
            w = wc
        else:
            result.append(dictionary[w])
            dictionary[wc] = dict_size
            dict_size += 1
            w = c
    if w:
        result.append(dictionary[w])
    return result

def lzw_decompress(compressed):
    """
    Realiza la descompresión LZW a partir de una lista de códigos numéricos.
    """
    dict_size = 256
    dictionary = {i: chr(i) for i in range(dict_size)}
    result = []
    w = chr(compressed.pop(0))
    result.append(w)
    for k in compressed:
        if k in dictionary:
            entry = dictionary[k]
        elif k == dict_size:
            entry = w + w[0]
        else:
            raise ValueError("Código inválido: %s" % k)
        result.append(entry)
        dictionary[dict_size] = w + entry[0]
        dict_size += 1
        w = entry
    return "".join(result)

def to_binary_string(codes):
    """
    Convierte una lista de códigos numéricos a una cadena binaria continua,
    usando el mismo número de bits para todos los códigos, basado en el valor máximo.
    """
    if not codes:
        return ""
    max_code = max(codes)
    bit_length = max_code.bit_length()
    return ''.join(f"{code:0{bit_length}b}" for code in codes), bit_length

def from_binary_string(bin_str, bit_length):
    """
    Convierte una cadena binaria continua y la longitud de bit a una lista de códigos numéricos.
    """
    codes = []
    for i in range(0, len(bin_str), bit_length):
        code = int(bin_str[i:i+bit_length], 2)
        codes.append(code)
    return codes

def main():
    """
    Menú interactivo para comprimir y descomprimir texto usando LZW y binario.
    """
    while True:
        print("\nOpciones:")
        print("1. Comprimir texto (LZW, salida binaria)")
        print("2. Descomprimir cadena binaria (LZW)")
        print("3. Salir")
        opcion = input("Selecciona una opción (1/2/3): ").strip()
        if opcion == "1":
            texto = input("Ingresa el texto a comprimir: ")
            comprimido = lzw_compress(texto)
            binario, bits = to_binary_string(comprimido)
            print(f"Comprimido (binario): {binario}")
            print(f"Longitud de bit por código: {bits}")
        elif opcion == "2":
            binario = input("Ingresa la cadena binaria comprimida: ").strip()
            bits = int(input("Ingresa la longitud de bit por código: "))
            try:
                lista_codigos = from_binary_string(binario, bits)
                descomprimido = lzw_decompress(lista_codigos)
                print("Descomprimido:", descomprimido)
            except Exception as e:
                print("Error:", e)
        elif opcion == "3":
            print("¡Hasta luego!")
            break
        else:
            print("Opción no válida. Intenta de nuevo.")

if __name__ == "__main__":
    main()