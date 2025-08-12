import unicodedata

max_codepoint = 0x10FFFF
cols = 8
count = 0

for code in range(max_codepoint + 1):
    try:
        char = chr(code)
        # Filtrar caracteres de control, no basarse solo en isprintable()
        category = unicodedata.category(char)
        if not category.startswith("C"):  # Evita control chars
            print(f"U+{code:04X} {char}".ljust(12), end="")
            count += 1
            if count % cols == 0:
                print()
    except:
        pass
