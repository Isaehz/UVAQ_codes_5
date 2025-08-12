import codecs

def show_all_formats(char):
    print(f"Caracter: {char}")
    print(f"Decimal (ASCII): {ord(char)}")
    print(f"Binario: {bin(ord(char))[2:].zfill(8)}")
    print(f"Hexadecimal: {hex(ord(char))[2:].upper().zfill(2)}")
    print(f"Usando ord(): {ord(char)}")
    hex_val = codecs.encode(char.encode(), 'hex').decode()
    print(f"codecs (hex): {hex_val}")

def menu():
    while True:
        print("\nMenu:")
        print("1. Mostrar representaciones de un carácter")
        print("2. Salir")
        choice = input("Selecciona una opción: ")
        if choice == "1":
            char = input("Ingresa un carácter: ")
            if len(char) != 1:
                print("Por favor ingresa solo un carácter.")
            else:
                show_all_formats(char)
        elif choice == "2":
            break
        else:
            print("Opción inválida.")

if __name__ == "__main__":
    menu()
	
