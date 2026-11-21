
<?php
require_once "../database/connexion.php";

$sql = "SELECT * FROM Formation";
$stmt = $pdo->query($sql);
$formations = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des formations</title>
</head>
<body>

    <h1>Liste des formations</h1>

    <a href="create.php">Ajouter une formation</a>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Description</th>
            <th>Durée</th>
            <th>Actions</th>
        </tr>

        <?php foreach ($formations as $formation): ?>
        <tr>
            <td><?= $formation['id_formation'] ?></td>
            <td><?= $formation['nom_formation'] ?></td>
            <td><?= $formation['description'] ?></td>
            <td><?= $formation['duree'] ?></td>
            <td>
                <a href="edit.php?id=<?= $formation['id_formation'] ?>">Modifier</a>
                |
                <a href="delete.php?id=<?= $formation['id_formation'] ?>">Supprimer</a>
            </td>
        </tr>
        <?php endforeach; ?>

    </table>

</body>
</html>
