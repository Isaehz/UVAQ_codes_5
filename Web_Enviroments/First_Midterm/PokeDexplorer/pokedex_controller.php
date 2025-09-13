<?php
class PokemonClient {
    private $apiUrl = "http://localhost/pokemon_api.php";

    public function getPokemon($name) {
        $url = $this->apiUrl . "?pokemon=" . urlencode($name);
        $response = @file_get_contents($url);

        if ($response === FALSE) {
            return null;
        }

        $data = json_decode($response, true);

        if (isset($data["error"]) && $data["error"] === true) {
            return null;
        }

        return $data;
    }
}

$pokemonName = '';
$pokemonData = null;
$error = null;

// Si el usuario envió el formulario
if (isset($_GET['pokemon']) && $_GET['pokemon'] !== '') {
    $pokemonName = trim($_GET['pokemon']);
    $client = new PokemonClient();
    $pokemonData = $client->getPokemon($pokemonName);

    if (!$pokemonData) {
        $error = "No se encontró el Pokémon '$pokemonName'.";
    }
}

// Carga la vista
include 'view.php';
?>