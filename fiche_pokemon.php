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
    <!-- Conteneur principal du Pokédex -->
    <div class="pokedex">
        <!-- En-tête décorative du Pokédex -->
        <div class="pokedex-header">
            <div class="circle"></div>
            <div class="lights">
                <div class="light red"></div>
                <div class="light yellow"></div>
                <div class="light green"></div>
            </div>
        </div>
        <!-- Contenu principal de la fiche Pokémon -->
        <div class="pokedex-content">
            <!-- Colonne gauche : image du Pokémon -->
            <div class="fiche-left">
                <img src="<?= htmlspecialchars($pokemon['image']) ?>" alt="<?= htmlspecialchars($pokemon['name']) ?>" class="pokemon-image">
            </div>
            <!-- Colonne droite : infos détaillées -->
            <div class="fiche-right">
                <!-- Nom et numéro du Pokémon -->
                <div class="fiche-header">
                    <h1>
                        <?= htmlspecialchars($pokemon['name']) ?>
                        <span class="fiche-numero">#<?= str_pad(htmlspecialchars($pokemon['numero']), 3, '0', STR_PAD_LEFT) ?></span>
                    </h1>
                </div>
                <!-- Description du Pokémon -->
                <div class="fiche-description">
                    <p><?= htmlspecialchars($pokemon['description'] ?? "Ce Pokémon n'a pas encore de description.") ?></p>
                </div>
                <!-- Informations principales (taille, poids, sexe, talent, légendaire, génération) -->
                <div class="fiche-infos">
                    <div class="fiche-infos-col">
                        <div><span class="fiche-label">Taille</span><br><?= htmlspecialchars($pokemon['height']) ?> m</div>
                        <div><span class="fiche-label">Poids</span><br><?= htmlspecialchars($pokemon['weight']) ?> kg</div>
                        <div><span class="fiche-label">Sexe</span><br><?= htmlspecialchars($pokemon['sexe']) ?></div>
                    </div>
                    <div class="fiche-infos-col">
                        <div><span class="fiche-label">Talent</span><br><?= htmlspecialchars($pokemon['talent']) ?></div>
                        <div><span class="fiche-label">Légendaire</span><br><?= $pokemon['legendary'] ? 'Oui' : 'Non' ?></div>
                        <div><span class="fiche-label">Génération</span><br><?= htmlspecialchars($pokemon['id_gen']) ?></div>
                    </div>
                </div>
                <!-- Affichage des types du Pokémon -->
                <div class="fiche-types">
                    <span class="fiche-label">Type</span>
                    <div class="pokemon-type">
                        <?php foreach ($types as $type): ?>
                            <span class="type type-<?= strtolower($type['name']) ?>">
                                <?= htmlspecialchars($type['name']) ?>
                            </span>
                        <?php endforeach; ?>
                    </div>
                </div>
                <!-- Bouton de retour à la liste -->
                <div class="back-button-container">
                    <a href="index.php" class="back-button">Retour à la liste</a>
                </div>
            </div>
        </div>
        <!-- Pied de page décoratif du Pokédex -->
        <div class="pokedex-footer">
            <div class="screen"></div>
        </div>
    </div>
</body>
</html>