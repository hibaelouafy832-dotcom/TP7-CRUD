
<?php
require_once "../database/connexion.php";

$sql = "SELECT m.*, f.nom_formation
        FROM Module m
        INNER JOIN Formation f
        ON m.id_formation = f.id_formation";

$stmt = $pdo->query($sql);
$modules = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des modules</title>
</head>
<body>

    <h1>Liste des modules</h1>

    <a href="create.php">Ajouter un module</a>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nom du module</th>
            <th>Volume horaire</th>
            <th>Formation</th>
            <th>Actions</th>
        </tr>

        <?php foreach ($modules as $module): ?>
        <tr>
            <td><?= $module['id_module'] ?></td>
            <td><?= $module['nom_module'] ?></td>
            <td><?= $module['volume_horaire'] ?></td>
            <td><?= $module['nom_formation'] ?></td>
            <td>
                <a href="edit.php?id=<?= $module['id_module'] ?>">Modifier</a>
                |
                <a href="delete.php?id=<?= $module['id_module'] ?>">Supprimer</a>
            </td>
        </tr>
        <?php endforeach; ?>

    </table>

</body>
</html>
