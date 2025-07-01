<?php
require_once 'controller/type_controller.php';
$typeController = new TypeController();
$stats = $typeController->getNbr();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Statistiques des Pokémon par type</title>
    <link rel="stylesheet" href="css/stats.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <h1>Nombre de Pokémon par type</h1>
    <canvas id="typeChart" width="400" height="400"></canvas>
    <script>
        // Récupérations du nom des types et du nombre de pokemon
        const labels = <?= json_encode(array_column($stats, 'type')) ?>;
        const data = <?= json_encode(array_column($stats, 'nbr_pokemons')) ?>;
        // Association type => couleur
        const colorMap = {
            "Normal": "#A8A77A", "Feu": "#EE8130", "Eau": "#6390F0", "Plante": "#7AC74C",
            "Electrik": "#F7D02C", "Glace": "#96D9D6", "Combat": "#C22E28", "Poison": "#A33EA1",
            "Sol": "#E2BF65", "Vol": "#A98FF3", "Psy": "#F95587", "Insecte": "#A6B91A",
            "Roche": "#B6A136", "Spectre": "#735797", "Dragon": "#6F35FC", "Tenebres": "#705746",
            "Acier": "#B7B7CE", "Fee": "#D685AD"
        };
        const backgroundColor = labels.map(type => colorMap[type] || "#888"); // Tableau qui récupère l'association type => couleur
        new Chart(document.getElementById('typeChart'), {
            type: 'pie',
            data: {
                labels: labels, // labels = types 
                datasets: [{
                    data: data, // data = nombre de Pokémon
                    backgroundColor: backgroundColor // backgroundColor = tableau de couleur
                }]
            },
            options: {
                responsive: false, // false = dimensions de la balise canvas
                plugins: { legend: { position: 'right' } } // la légende du schema est a droite
            }
        });
    </script>
    <table>
        <tr>
            <th>#</th>
            <th>Type</th>
            <th>Nombre de Pokémon</th>
        </tr>
        <?php $i = 1; foreach ($stats as $row): ?>
            <?php
                $class = '';
                if ($i == 1) $class = 'gold';
                elseif ($i == 2) $class = 'silver';
                elseif ($i == 3) $class = 'copper';
            ?>
            <tr class="<?= $class ?>">
                <td><?= $i++ ?></td>
                <td><?= ($row['type']) ?></td>
                <td><?= $row['nbr_pokemons'] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>