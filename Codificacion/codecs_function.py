import codecs 

string =  "Hello, World!"
encoded_string = codecs.encode(string, 'utf_8')
print(encoded_string)

decoded_string = codecs.decode(encoded_string, 'utf_8')
print(decoded_string)

decoded_string = codecs.decode(encoded_string, 'latin_1')
print(decoded_string)