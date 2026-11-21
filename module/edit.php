
<?php
require_once "../database/connexion.php";

$id = $_GET["id"];

$sql = "SELECT * FROM Module WHERE id_module = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute([":id" => $id]);
$module = $stmt->fetch(PDO::FETCH_ASSOC);

$sql = "SELECT * FROM Formation";
$stmt = $pdo->query($sql);
$formations = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nom_module = $_POST["nom_module"];
    $volume_horaire = $_POST["volume_horaire"];
    $id_formation = $_POST["id_formation"];

    $sql = "UPDATE Module
            SET nom_module = :nom_module,
                volume_horaire = :volume_horaire,
                id_formation = :id_formation
            WHERE id_module = :id";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ":nom_module" => $nom_module,
        ":volume_horaire" => $volume_horaire,
        ":id_formation" => $id_formation,
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
    <title>Modifier un module</title>
</head>
<body>

    <h1>Modifier un module</h1>

    <form method="POST">

        <label>Nom du module :</label>
        <input type="text" name="nom_module"
               value="<?= htmlspecialchars($module['nom_module']) ?>" required>
        <br><br>

        <label>Volume horaire :</label>
        <input type="number" name="volume_horaire"
               value="<?= htmlspecialchars($module['volume_horaire']) ?>" required>
        <br><br>

        <label>Formation :</label>
        <select name="id_formation" required>

            <?php foreach ($formations as $formation): ?>
                <option value="<?= $formation['id_formation'] ?>"
                    <?= ($formation['id_formation'] == $module['id_formation']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($formation['nom_formation']) ?>
                </option>
            <?php endforeach; ?>

        </select>
        <br><br>

        <button type="submit">Modifier</button>

    </form>

    <a href="index.php">Retour à la liste</a>

</body>
</html>
