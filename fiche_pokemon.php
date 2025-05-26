<?php

require_once 'controller/pokemon_controller.php';
require_once 'controller/pokemon_type_controller.php';

// Vérifier si un ID est passé dans l'URL
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die('ID de Pokémon invalide.');
}

$pokemonId = (int)$_GET['id'];

// Charger les données du Pokémon
$pokemonController = new PokemonController();
$pokemonTypeController = new PokemonTypeController();

$pokemon = $pokemonController->getPokemonById($pokemonId);
if (!$pokemon) {
    die('Pokémon introuvable.');
}

$types = $pokemonTypeController->getTypesByPokemon($pokemonId);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Fiche Pokémon - <?= htmlspecialchars($pokemon['name']) ?></title>
    <link rel="stylesheet" href="css/fiche_pokemon.css">
</head>
<body>
    <!-- Pokedex Structure -->
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
            <h1><?= htmlspecialchars($pokemon['name']) ?></h1>
            
            <div class="pokemon-details">
                <img src="<?= htmlspecialchars($pokemon['image']) ?>" alt="<?= htmlspecialchars($pokemon['name']) ?>" class="pokemon-image">
                <ul>
                    <li><strong>Numéro :</strong> <?= str_pad(htmlspecialchars($pokemon['numero']), 3, '0', STR_PAD_LEFT) ?></li>
                    <li><strong>Poids :</strong> <?= htmlspecialchars($pokemon['weight']) ?> kg</li>
                    <li><strong>Taille :</strong> <?= htmlspecialchars($pokemon['height']) ?> m</li>
                    <li><strong>Sexe :</strong> <?= htmlspecialchars($pokemon['sexe']) ?></li>
                    <li><strong>Talent :</strong> <?= htmlspecialchars($pokemon['talent']) ?></li>
                    <li><strong>Légendaire :</strong> <?= $pokemon['legendary'] ? 'Oui' : 'Non' ?></li>
                    <li><strong>Génération :</strong> Génération <?= htmlspecialchars($pokemon['id_gen']) ?></li>
                    <li><strong>Types :</strong>
                        <div class="pokemon-type">
                            <?php foreach ($types as $type): ?>
                                <span class="type type-<?= strtolower($type['name']) ?>">
                                    <?= htmlspecialchars($type['name']) ?>
                                </span>
                            <?php endforeach; ?>
                        </div>
                    </li>
                </ul>
            </div>
            <!-- Bouton de retour -->
            <div class="back-button-container">
                <a href="index.php" class="back-button">Retour à la liste</a>
            </div>
        </div>
        <div class="pokedex-footer">
            <div class="screen"></div>
        </div>
    </div>
</body>
</html>