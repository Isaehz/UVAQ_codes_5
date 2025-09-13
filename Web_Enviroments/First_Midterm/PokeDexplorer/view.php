<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Buscar Pokémon</title>
</head>
<body>
    <h1>Pokédex (Búsqueda)</h1>

    <form method="get" action="">
        <label for="pokemon">Nombre del Pokémon:</label>
        <input type="text" id="pokemon" name="pokemon" value="<?= htmlspecialchars($pokemonName) ?>" required>
        <button type="submit">Buscar</button>
    </form>

    <hr>

    <?php if ($error): ?>
        <p style="color:red;"><?= htmlspecialchars($error) ?></p>
    <?php elseif ($pokemonData): ?>
        <div>
            <p><strong>ID:</strong> <?= htmlspecialchars($pokemonData["id"]) ?></p>
            <p><strong>Nombre:</strong> <?= htmlspecialchars($pokemonData["name"]) ?></p>
            <p><strong>Altura:</strong> <?= htmlspecialchars($pokemonData["height"]) ?></p>
            <p><strong>Peso:</strong> <?= htmlspecialchars($pokemonData["weight"]) ?></p>
            <p><strong>Tipos:</strong> <?= htmlspecialchars(implode(", ", $pokemonData["types"])) ?></p>
            <img src="<?= htmlspecialchars($pokemonData["sprite"]) ?>" alt="Sprite de <?= htmlspecialchars($pokemonData["name"]) ?>">
        </div>
    <?php elseif ($pokemonName): ?>
        <p>No se encontró información para el Pokémon ingresado.</p>
    <?php endif; ?>
</body>
</html>