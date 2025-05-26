<?php
// Chargement des contrôleurs
require_once 'controller/generation_controller.php';
require_once 'controller/type_controller.php';
require_once 'controller/pokemon_controller.php';
require_once 'controller/pokemon_type_controller.php';

// Fonction pour initialiser les données
function loadData() {
    $typeController = new TypeController();
    $generationController = new GenerationController();
    $pokemonController = new PokemonController();

    return [
        'types' => $typeController->getAllTypes(),
        'generations' => $generationController->getAllGenerations(),
        'pokemons' => $pokemonController->getAllPokemons()
    ];
}

$data = loadData();
$pokemonTypeController = new PokemonTypeController();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>New Pokedex</title>
    <link rel="stylesheet" href="css/index.css">    <div class="pokemon-type">
                                <?php
                                $types = $pokemonTypeController->getTypesByPokemon($pokemon['id']);
                                foreach ($types as $type): ?>
                                    <span class="type type-<?= strtolower($type['name']) ?>">
                                        <?= htmlspecialchars($type['name']) ?>
                                    </span>
                                <?php endforeach; ?>
                            </div>
</head>
<body class="loading">
    <!-- Loader -->
    <div id="loader">
        <video autoplay loop muted id="loader-animation">
            <source src="images/animation.webm" type="video/webm">
            <source src="images/animation.mov" type="video/mov">
            <img src="images/animation.gif" alt="Loading...">
        </video>
    </div>

    <!-- Le haut du Pokedex -->
    <div class="pokedex">
        <div class="pokedex-header">
            <div class="circle"></div>
            <div class="lights">
                <div class="light red"></div>
                <div class="light yellow"></div>
                <div class="light green"></div>
            </div>
        </div>
        <div class="pokedex-content">
            <h1>Pokédex</h1>
            
            <!-- Barre de recherche par nom-->
            <form class="search-bar" method="GET" action="index.php">
                <input type="text" name="name" placeholder="Rechercher par nom" value="<?= htmlspecialchars($_GET['name'] ?? '') ?>">
                
                <!-- Sélecteur de type -->
                <select name="type">
                    <option value="">Tous les types</option>
                    <?php foreach ($data['types'] as $type): ?>
                        <option value="<?= htmlspecialchars($type['name']) ?>" <?= (isset($_GET['type']) && $_GET['type'] === $type['name']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($type['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                
                <!-- Sélecteur de génération -->
                <select name="generation">
                    <option value="">Toutes les générations</option>
                    <?php foreach ($data['generations'] as $generation): ?>
                        <option value="<?= htmlspecialchars($generation['id']) ?>" <?= (isset($_GET['generation']) && $_GET['generation'] == $generation['id']) ? 'selected' : '' ?>>
                            Génération <?= htmlspecialchars($generation['id']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                
                <button type="submit">Rechercher</button>
            </form>

            <div class="pokemon-container">
                <?php 
                $counter = 0;
                foreach ($data['pokemons'] as $pokemon): 
                    // Filtrage par nom, type et génération
                    if (!empty($_GET['name']) && stripos($pokemon['name'], $_GET['name']) === false) continue;
                    if (!empty($_GET['type']) && !in_array($_GET['type'], array_column($pokemonTypeController->getTypesByPokemon($pokemon['id']), 'name'))) continue;
                    if (!empty($_GET['generation']) && $pokemon['id_gen'] != $_GET['generation']) continue;

                    if ($counter > 0 && $counter % 4 == 0): ?>
                        </div><div class="pokemon-container">
                    <?php endif; ?>

                    <div class="pokemon-item">
                        <a href="fiche_pokemon.php?id=<?= $pokemon['id'] ?>">
                            <div class="pokemon-number">
                                N° <?= str_pad(htmlspecialchars($pokemon['numero']), 3, '0', STR_PAD_LEFT) ?>
                            </div>
                            <img src="<?= $pokemon['image'] ?>" alt="<?= htmlspecialchars($pokemon['name']) ?>" class="pokemon-image">
                            <div class="pokemon-name">
                                <?= htmlspecialchars($pokemon['name']) ?>
                            </div>
                            <div class="pokemon-type">
                                <?php
                                $types = $pokemonTypeController->getTypesByPokemon($pokemon['id']);
                                foreach ($types as $type): ?>
                                    <span class="type type-<?= strtolower($type['name']) ?>">
                                        <?= htmlspecialchars($type['name']) ?>
                                    </span>
                                <?php endforeach; ?>
                            </div>
                        </a>
                    </div>
                <?php 
                $counter++;
                endforeach; ?>
            </div>
        </div>
        <div class="pokedex-footer">
            <div class="screen"></div>
        </div>
    </div>

    <script>
        // Masquer le loader une fois que la page est complètement chargée
        window.addEventListener('load', function () {
            document.body.classList.remove('loading'); // Supprime la classe "loading"
            document.getElementById('loader').style.display = 'none'; // Masque le loader
        });
    </script>
</body>
</html> 