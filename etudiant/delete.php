
<?php
require_once "../database/connexion.php";

$id = $_GET["id"];

$sql = "DELETE FROM Etudiant WHERE id_etudiant = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute([":id" => $id]);

header("Location: index.php");
exit();
?>
