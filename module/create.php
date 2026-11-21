
<?php
require_once "../database/connexion.php";

$sql = "SELECT * FROM Formation";
$stmt = $pdo->query($sql);
$formations = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nom_module = $_POST["nom_module"];
    $volume_horaire = $_POST["volume_horaire"];
    $id_formation = $_POST["id_formation"];

    $sql = "INSERT INTO Module (nom_module, volume_horaire, id_formation)
            VALUES (:nom_module, :volume_horaire, :id_formation)";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ":nom_module" => $nom_module,
        ":volume_horaire" => $volume_horaire,
        ":id_formation" => $id_formation
    ]);

    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un module</title>
</head>
<body>

    <h1>Ajouter un module</h1>

    <form method="POST">

        <label>Nom du module :</label>
        <input type="text" name="nom_module" required>
        <br><br>

        <label>Volume horaire :</label>
        <input type="number" name="volume_horaire" required>
        <br><br>

        <label>Formation :</label>
        <select name="id_formation" required>
            <option value="">Choisir une formation</option>

            <?php foreach ($formations as $formation): ?>
                <option value="<?= $formation['id_formation'] ?>">
                    <?= $formation['nom_formation'] ?>
                </option>
            <?php endforeach; ?>

        </select>
        <br><br>

        <button type="submit">Ajouter</button>

    </form>

    <a href="index.php">Retour à la liste</a>

</body>
</html>
