
<?php
require_once "../database/connexion.php";

$id = $_GET["id"];

$sql = "SELECT * FROM Etudiant WHERE id_etudiant = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute([":id" => $id]);
$etudiant = $stmt->fetch(PDO::FETCH_ASSOC);

$sql = "SELECT * FROM Formation";
$stmt = $pdo->query($sql);
$formations = $stmt->fetchAll(PDO::FETCH_ASSOC);


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $email = $_POST["email"];
    $id_formation = $_POST["id_formation"];

    $sql = "UPDATE Etudiant
            SET nom = :nom,
                prenom = :prenom,
                email = :email,
                id_formation = :id_formation
            WHERE id_etudiant = :id";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ":nom" => $nom,
        ":prenom" => $prenom,
        ":email" => $email,
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
    <title>Modifier un étudiant</title>
</head>
<body>

    <h1>Modifier un étudiant</h1>

    <form method="POST">

        <label>Nom :</label>
        <input type="text" name="nom"
               value="<?= htmlspecialchars($etudiant['nom']) ?>" required>
        <br><br>

        <label>Prénom :</label>
        <input type="text" name="prenom"
               value="<?= htmlspecialchars($etudiant['prenom']) ?>" required>
        <br><br>

        <label>Email :</label>
        <input type="email" name="email"
               value="<?= htmlspecialchars($etudiant['email']) ?>" required>
        <br><br>

        <label>Formation :</label>
        <select name="id_formation" required>

            <?php foreach ($formations as $formation): ?>
                <option value="<?= $formation['id_formation'] ?>"
                    <?= ($formation['id_formation'] == $etudiant['id_formation']) ? 'selected' : '' ?>>
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
