<?php
class PokemonAPI {
    private $baseUrl = "https://pokeapi.co/api/v2/pokemon/";

    public function getPokemonData($pokemonName) {
        $url = $this->baseUrl . strtolower($pokemonName);
        $response = @file_get_contents($url);

        if ($response === FALSE) {
            return [
                "error" => true,
                "message" => "No se encontró el Pokémon solicitado."
            ];
        }

        $data = json_decode($response, true);

        // Obtener sprites adicionales
        $sprites = [
            "front_default" => $data["sprites"]["front_default"],
            "back_default" => $data["sprites"]["back_default"],
            "front_shiny" => $data["sprites"]["front_shiny"],
            "back_shiny" => $data["sprites"]["back_shiny"]
        ];

        // Obtener URL de especie para buscar la cadena de evolución
        $speciesUrl = $data["species"]["url"];
        $speciesResponse = @file_get_contents($speciesUrl);
        $speciesData = $speciesResponse ? json_decode($speciesResponse, true) : null;

        $evolutions = [];
        if ($speciesData && isset($speciesData["evolution_chain"]["url"])) {
            $evoUrl = $speciesData["evolution_chain"]["url"];
            $evoResponse = @file_get_contents($evoUrl);
            $evoData = $evoResponse ? json_decode($evoResponse, true) : null;

            // Extraer nombres e imágenes de la cadena de evolución
            if ($evoData) {
                $evolutions = $this->extractEvolutionData($evoData["chain"]);
            }
        }

        return [
            "id" => $data["id"],
            "name" => ucfirst($data["name"]),
            "height" => $data["height"],
            "weight" => $data["weight"],
            "types" => array_map(function($type) {
                return $type["type"]["name"];
            }, $data["types"]),
            "sprites" => $sprites,
            "evolutions" => $evolutions,
            "abilities" => array_map(function($ab) {
                return $ab["ability"]["name"];
            }, $data["abilities"]),
            "stats" => array_map(function($stat) {
                return [
                    "name" => $stat["stat"]["name"],
                    "base" => $stat["base_stat"]
                ];
            }, $data["stats"]),
        ];
    }

    // Extrae nombres e imágenes de la cadena de evolución
    private function extractEvolutionData($chain) {
        $evolutions = [];
        if (isset($chain["species"]["name"])) {
            $name = ucfirst($chain["species"]["name"]);
            $sprite = $this->getPokemonSprite($chain["species"]["name"]);
            $evolutions[] = [
                "name" => $name,
                "sprite" => $sprite
            ];
        }
        if (!empty($chain["evolves_to"])) {
            foreach ($chain["evolves_to"] as $evo) {
                $evolutions = array_merge($evolutions, $this->extractEvolutionData($evo));
            }
        }
        return $evolutions;
    }

    // Obtiene el sprite principal de un Pokémon por nombre
    private function getPokemonSprite($name) {
        $url = $this->baseUrl . strtolower($name);
        $response = @file_get_contents($url);
        if ($response === FALSE) return null;
        $data = json_decode($response, true);
        return $data["sprites"]["front_default"] ?? null;
    }
}

// ============================================
// Punto de entrada de la API
// ============================================

header("Content-Type: application/json");

if (isset($_GET["pokemon"])) {
    $api = new PokemonAPI();
    $pokemonName = $_GET["pokemon"];
    $result = $api->getPokemonData($pokemonName);

    echo json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
} else {
    echo json_encode([
        "error" => true,
        "message" => "Debes proporcionar un nombre de Pokémon en la URL. Ejemplo: ?pokemon=snorlax"
    ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
}
?>