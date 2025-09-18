import java.io.*;
import java.util.*;

public class HuffmanCoding {

    // Nodo del árbol de Huffman
    private class Node implements Comparable<Node> {
        char ch;
        int freq;
        Node left, right;

        Node(char ch, int freq) {
            this.ch = ch;
            this.freq = freq;
        }

        Node(char ch, int freq, Node left, Node right) {
            this.ch = ch;
            this.freq = freq;
            this.left = left;
            this.right = right;
        }

        public boolean isLeaf() {
            return (left == null) && (right == null);
        }

        @Override
        public int compareTo(Node other) {
            return this.freq - other.freq;
        }
    }

    private Map<Character, String> huffmanCodes = new HashMap<>();
    private Map<String, Character> reverseCodes = new HashMap<>();
    private Node root;

    // Construye el árbol de Huffman y genera los códigos
    public void buildTree(String text) {
        // 1. Contar frecuencias
        Map<Character, Integer> freqMap = new HashMap<>();
        for (char c : text.toCharArray()) {
            freqMap.put(c, freqMap.getOrDefault(c, 0) + 1);
        }

        // 2. Crear heap de nodos
        PriorityQueue<Node> heap = new PriorityQueue<>();
        for (Map.Entry<Character, Integer> entry : freqMap.entrySet()) {
            heap.add(new Node(entry.getKey(), entry.getValue()));
        }

        // 3. Construir el árbol
        while (heap.size() > 1) {
            Node left = heap.poll();
            Node right = heap.poll();
            Node parent = new Node('\0', left.freq + right.freq, left, right);
            heap.add(parent);
        }
        root = heap.poll();

        // 4. Generar códigos
        buildCodes(root, "");
    }

    private void buildCodes(Node node, String code) {
        if (node == null) return;
        if (node.isLeaf()) {
            huffmanCodes.put(node.ch, code);
            reverseCodes.put(code, node.ch);
        }
        buildCodes(node.left, code + "0");
        buildCodes(node.right, code + "1");
    }

    // Codifica el texto usando los códigos de Huffman
    public String encode(String text) {
        StringBuilder sb = new StringBuilder();
        for (char c : text.toCharArray()) {
            sb.append(huffmanCodes.get(c));
        }
        return sb.toString();
    }

    // Decodifica el texto binario usando el árbol de Huffman
    public String decode(String encoded) {
        StringBuilder sb = new StringBuilder();
        Node node = root;
        for (char bit : encoded.toCharArray()) {
            node = (bit == '0') ? node.left : node.right;
            if (node.isLeaf()) {
                sb.append(node.ch);
                node = root;
            }
        }
        return sb.toString();
    }

    // Convierte una cadena de '0' y '1' a un arreglo de bytes
    public byte[] getBytesFromBitString(String bitString) {
        int len = (bitString.length() + 7) / 8;
        byte[] bytes = new byte[len];
        for (int i = 0; i < bitString.length(); i++) {
            int byteIndex = i / 8;
            bytes[byteIndex] <<= 1;
            if (bitString.charAt(i) == '1') {
                bytes[byteIndex] |= 1;
            }
            if (i % 8 == 7) {
                // nothing, already shifted 8 bits
            }
        }
        // Si la última posición no está llena, hay que hacer el shift final
        int remaining = bitString.length() % 8;
        if (remaining != 0) {
            bytes[len - 1] <<= (8 - remaining);
        }
        return bytes;
    }

    // Convierte un arreglo de bytes a una cadena de '0' y '1'
    public String getBitStringFromBytes(byte[] bytes, int bitLength) {
        StringBuilder sb = new StringBuilder();
        for (int i = 0; i < bytes.length; i++) {
            int b = bytes[i] & 0xFF;
            for (int j = 7; j >= 0; j--) {
                if (sb.length() < bitLength) {
                    sb.append(((b >> j) & 1) == 1 ? '1' : '0');
                }
            }
        }
        return sb.toString();
    }
}