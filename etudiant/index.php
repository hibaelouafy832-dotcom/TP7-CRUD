
<?php
require_once "../database/connexion.php";

$sql = "SELECT e.*, f.nom_formation
        FROM Etudiant e
        INNER JOIN Formation f
        ON e.id_formation = f.id_formation";

$stmt = $pdo->query($sql);
$etudiants = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des étudiants</title>
</head>
<body>

    <h1>Liste des étudiants</h1>

    <a href="create.php">Ajouter un étudiant</a>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Email</th>
            <th>Formation</th>
            <th>Actions</th>
        </tr>

        <?php foreach ($etudiants as $etudiant): ?>
        <tr>
            <td><?= $etudiant['id_etudiant'] ?></td>
            <td><?= $etudiant['nom'] ?></td>
            <td><?= $etudiant['prenom'] ?></td>
            <td><?= $etudiant['email'] ?></td>
            <td><?= $etudiant['nom_formation'] ?></td>
            <td>
                <a href="edit.php?id=<?= $etudiant['id_etudiant'] ?>">Modifier</a>
                |
                <a href="delete.php?id=<?= $etudiant['id_etudiant'] ?>">Supprimer</a>
            </td>
        </tr>
        <?php endforeach; ?>

    </table>

</body>
</html>
