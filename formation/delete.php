
<?php
require_once "../database/connexion.php";

$id = $_GET["id"];

$sql = "DELETE FROM Formation WHERE id_formation = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute([":id" => $id]);

header("Location: index.php");
exit();
?>
