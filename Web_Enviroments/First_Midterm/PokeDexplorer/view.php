<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Buscar Pokémon</title>
    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: #f7f7f7;
            color: #333;
            margin: 0;
            padding: 0;
        }
        h1 {
            background: #ef5350;
            color: #fff;
            margin: 0;
            padding: 20px 0;
            text-align: center;
            letter-spacing: 2px;
        }
        .search-bar {
            position: sticky;
            top: 0;
            z-index: 100;
            background: #fff;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            padding-top: 10px;
            padding-bottom: 10px;
        }
        form {
            background: #fff;
            margin: 0 auto 10px auto;
            padding: 20px;
            border-radius: 8px;
            max-width: 400px;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        label {
            font-weight: bold;
        }
        input[type="text"] {
            padding: 8px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }
        button {
            background: #ef5350;
            color: #fff;
            border: none;
            padding: 10px;
            border-radius: 4px;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.2s;
        }
        button:hover {
            background: #d32f2f;
        }
        .main-content {
            display: flex;
            justify-content: center;
            align-items: flex-start;
            gap: 32px;
            margin-top: 24px;
        }
        .pokemon-card {
            background: #fff;
            padding: 24px;
            border-radius: 12px;
            max-width: 500px;
            min-width: 320px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.10);
        }
        .pokemon-card img {
            margin: 8px;
            background: #f1f1f1;
            border-radius: 8px;
            border: 1px solid #eee;
        }
        .evolutions {
            margin-top: 16px;
        }
        .evolutions ul {
            padding-left: 20px;
            list-style: none;
            display: flex;
            gap: 24px;
        }
        .evolutions li {
            display: flex;
            flex-direction: column;
            align-items: center;
            background: #f9f9f9;
            border-radius: 8px;
            padding: 8px 12px;
            box-shadow: 0 1px 4px rgba(0,0,0,0.05);
        }
        .evolutions img {
            width: 48px;
            height: 48px;
            margin-bottom: 4px;
            background: #fff;
        }
        .stats-card {
            background: #fff;
            padding: 24px;
            border-radius: 12px;
            min-width: 260px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.10);
            margin-top: 0;
        }
        .stats-card h2 {
            margin-top: 0;
            margin-bottom: 16px;
            color: #ef5350;
            font-size: 1.2em;
            text-align: center;
        }
        .stats-table {
            width: 100%;
            border-collapse: collapse;
        }
        .stats-table td {
            padding: 6px 8px;
        }
        .stat-bar-bg {
            background: #eee;
            border-radius: 6px;
            height: 14px;
            width: 120px;
            display: inline-block;
            vertical-align: middle;
        }
        .stat-bar {
            background: #ef5350;
            height: 14px;
            border-radius: 6px;
            display: inline-block;
            vertical-align: middle;
        }
        .error {
            color: #d32f2f;
            text-align: center;
            margin-top: 20px;
        }
        hr {
            border: none;
            border-top: 1px solid #eee;
            margin: 20px 0;
        }
        @media (max-width: 900px) {
            .main-content {
                flex-direction: column;
                align-items: center;
            }
            .stats-card {
                margin-top: 24px;
            }
        }
    </style>
</head>
<body>
    <h1>Pokédex (Búsqueda)</h1>

    <div class="search-bar">
        <form method="get" action="">
            <label for="pokemon">Nombre del Pokémon:</label>
            <input type="text" id="pokemon" name="pokemon" value="<?= htmlspecialchars($pokemonName) ?>" required>
            <button type="submit">Buscar</button>
        </form>
    </div>

    <hr>

    <?php if ($error): ?>
        <p class="error"><?= htmlspecialchars($error) ?></p>
    <?php elseif ($pokemonData): ?>
        <div class="main-content">
            <!-- Panel izquierdo: info, imágenes, evoluciones, habilidades -->
            <div class="pokemon-card">
                <p><strong>ID:</strong> <?= htmlspecialchars($pokemonData["id"]) ?></p>
                <p><strong>Nombre:</strong> <?= htmlspecialchars($pokemonData["name"]) ?></p>
                <p><strong>Altura:</strong> <?= htmlspecialchars($pokemonData["height"]) ?></p>
                <p><strong>Peso:</strong> <?= htmlspecialchars($pokemonData["weight"]) ?></p>
                <p><strong>Tipos:</strong> <?= htmlspecialchars(implode(", ", $pokemonData["types"])) ?></p>
                <p><strong>Habilidades:</strong> <?= htmlspecialchars(implode(", ", $pokemonData["abilities"])) ?></p>
                <div>
                    <strong>Imágenes:</strong><br>
                    <?php foreach ($pokemonData["sprites"] as $label => $url): ?>
                        <?php if ($url): ?>
                            <img src="<?= htmlspecialchars($url) ?>" alt="<?= htmlspecialchars($label) ?>" style="width:96px;height:96px;">
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
                <?php if (!empty($pokemonData["evolutions"])): ?>
                    <div class="evolutions">
                        <strong>Evoluciones:</strong>
                        <ul>
                            <?php foreach ($pokemonData["evolutions"] as $evo): ?>
                                <li>
                                    <?php if ($evo["sprite"]): ?>
                                        <img src="<?= htmlspecialchars($evo["sprite"]) ?>" alt="<?= htmlspecialchars($evo["name"]) ?>">
                                    <?php endif; ?>
                                    <?= htmlspecialchars($evo["name"]) ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>
            <!-- Panel derecho: stats -->
            <div class="stats-card">
                <h2>Estadísticas</h2>
                <table class="stats-table">
                    <?php foreach ($pokemonData["stats"] as $stat): ?>
                        <tr>
                            <td><?= htmlspecialchars(strtoupper($stat["name"])) ?></td>
                            <td>
                                <div class="stat-bar-bg">
                                    <div class="stat-bar" style="width:<?= min($stat["base"],150) * 0.8 ?>px"></div>
                                </div>
                            </td>
                            <td><?= htmlspecialchars($stat["base"]) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    <?php elseif ($pokemonName): ?>
        <p class="error">No se encontró información para el Pokémon ingresado.</p>
    <?php endif; ?>
</body>
</html>