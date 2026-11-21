
<?php
require_once "../database/connexion.php";

$id = $_GET["id"];

$sql = "SELECT * FROM Formation WHERE id_formation = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute([":id" => $id]);
$formation = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nom_formation = $_POST["nom_formation"];
    $description = $_POST["description"];
    $duree = $_POST["duree"];

    $sql = "UPDATE Formation
            SET nom_formation = :nom,
                description = :description,
                duree = :duree
            WHERE id_formation = :id";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ":nom" => $nom_formation,
        ":description" => $description,
        ":duree" => $duree,
        ":id" => $id
    ]);

    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier une formation</title>
</head>
<body>

    <h1>Modifier une formation</h1>

    <form method="POST">

        <label>Nom de la formation :</label>
        <input type="text" name="nom_formation"
               value="<?= htmlspecialchars($formation['nom_formation']) ?>" required>
        <br><br>

        <label>Description :</label>
        <textarea name="description"><?= htmlspecialchars($formation['description']) ?></textarea>
        <br><br>

        <label>Durée (mois) :</label>
        <input type="number" name="duree"
               value="<?= htmlspecialchars($formation['duree']) ?>" required>
        <br><br>

        <button type="submit">Modifier</button>

    </form>

    <a href="index.php">Retour à la liste</a>

</body>
</html>
