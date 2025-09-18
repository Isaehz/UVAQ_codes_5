import java.io.*;
import java.util.Scanner;

public class Main {
    public static void main(String[] args) {
        Scanner scanner = new Scanner(System.in);

        // Solicita el archivo a comprimir
        System.out.print("¿Qué archivo quieres comprimir?: ");
        String inputPath = scanner.nextLine();

        // Lee el archivo original
        StringBuilder textBuilder = new StringBuilder();
        try (BufferedReader reader = new BufferedReader(new FileReader(inputPath))) {
            String line;
            while ((line = reader.readLine()) != null) {
                textBuilder.append(line).append("\n");
            }
        } catch (IOException e) {
            System.out.println("No se pudo leer el archivo: " + e.getMessage());
            return;
        }
        String text = textBuilder.toString();

        // Comprime el texto
        HuffmanCoding huffman = new HuffmanCoding();
        huffman.buildTree(text);
        String encoded = huffman.encode(text);

        // Guarda el archivo comprimido como binario real
        String compressedPath = inputPath + ".huff";
        byte[] compressedBytes = huffman.getBytesFromBitString(encoded);
        try (FileOutputStream fos = new FileOutputStream(compressedPath);
             DataOutputStream dos = new DataOutputStream(fos)) {
            // Guarda la longitud real de bits al inicio
            dos.writeInt(encoded.length());
            dos.write(compressedBytes);
        } catch (IOException e) {
            System.out.println("No se pudo guardar el archivo comprimido: " + e.getMessage());
            return;
        }
        System.out.println("Archivo comprimido: " + compressedPath);

        // Lee el archivo comprimido y lo decodifica
        String decoded = "";
        try (FileInputStream fis = new FileInputStream(compressedPath);
             DataInputStream dis = new DataInputStream(fis)) {
            int bitLength = dis.readInt();
            byte[] fileBytes = new byte[(bitLength + 7) / 8];
            dis.readFully(fileBytes);
            String bitString = huffman.getBitStringFromBytes(fileBytes, bitLength);
            decoded = huffman.decode(bitString);
        } catch (IOException e) {
            System.out.println("No se pudo leer el archivo comprimido: " + e.getMessage());
            return;
        }

        // Guarda el archivo descomprimido
        String decompressedPath = inputPath + ".decompressed.txt";
        try (BufferedWriter writer = new BufferedWriter(new FileWriter(decompressedPath))) {
            writer.write(decoded);
        } catch (IOException e) {
            System.out.println("No se pudo guardar el archivo descomprimido: " + e.getMessage());
            return;
        }
        System.out.println("Archivo descomprimido: " + decompressedPath);
    }
}