<?php
// Clase que define la API
class PokemonAPI {

    private $baseUrl = "https://pokeapi.co/api/v2/pokemon/";

    // Función que obtiene datos del Pokémon
    public function getPokemonData($pokemonName) {
        // Construir URL con el nombre del Pokémon
        $url = $this->baseUrl . strtolower($pokemonName);

        // Obtener respuesta de la API externa
        $response = @file_get_contents($url);

        // Validar si la respuesta fue correcta
        if ($response === FALSE) {
            return [
                "error" => true,
                "message" => "No se encontró el Pokémon solicitado."
            ];
        }

        // Decodificar JSON
        $data = json_decode($response, true);

        // Retornar solo los atributos más relevantes
        return [
            "id" => $data["id"],
            "name" => ucfirst($data["name"]),
            "height" => $data["height"],
            "weight" => $data["weight"],
            "types" => array_map(function($type) {
                return $type["type"]["name"];
            }, $data["types"]),
            "sprite" => $data["sprites"]["front_default"]
        ];
    }
}

// ============================================
// Punto de entrada de la API
// ============================================

// Configuración de cabecera para JSON
header("Content-Type: application/json");

// Revisar si se pasó un parámetro "pokemon"
if (isset($_GET["pokemon"])) {
    $api = new PokemonAPI();
    $pokemonName = $_GET["pokemon"];
    $result = $api->getPokemonData($pokemonName);

    echo json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
} else {
    // Error si no se pasa parámetro
    echo json_encode([
        "error" => true,
        "message" => "Debes proporcionar un nombre de Pokémon en la URL. Ejemplo: ?pokemon=snorlax"
    ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
}
?>
