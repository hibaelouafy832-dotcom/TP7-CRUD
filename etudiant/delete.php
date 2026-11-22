
<?php
require_once "../database/connexion.php";

$id = $_GET["id"] ?? null;

if (!$id) {
    header("Location: index.php");
    exit();
}

$sql = "SELECT * FROM Etudiant WHERE id_etudiant = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute([":id" => $id]);
$etudiant = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$etudiant) {
    header("Location: index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $sql = "DELETE FROM Etudiant WHERE id_etudiant = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([":id" => $id]);

    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduManage - Supprimer un étudiant</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="sidebar">
    <a href="../index.php" class="sidebar-brand">Edu<span>Manage</span></a>

    <p class="sidebar-label">MENU PRINCIPAL</p>

    <a href="../index.php" class="nav-link">
        <i class="bi bi-grid"></i><span>Dashboard</span>
    </a>

    <a href="../formation/index.php" class="nav-link">
        <i class="bi bi-journal-bookmark"></i><span>Formations</span>
    </a>

    <a href="../etudiant/index.php" class="nav-link active">
        <i class="bi bi-people"></i><span>Étudiants</span>
    </a>

    <a href="../module/index.php" class="nav-link">
        <i class="bi bi-book"></i><span>Modules</span>
    </a>
</div>

<div class="main-content">

    <div class="topbar">
        <div>
            <h1 class="page-title">Supprimer un étudiant</h1>
            <p class="page-subtitle">Confirmation de la suppression d'un étudiant.</p>
        </div>
    </div>

    <div class="content-card text-center" style="max-width:650px; margin:40px auto;">

        <div class="mb-3">
            <i class="bi bi-exclamation-triangle-fill" style="font-size:55px;color:#D97757;"></i>
        </div>

        <h4 class="fw-bold mb-3">Confirmer la suppression ?</h4>

        <p class="text-secondary">
            Voulez-vous vraiment supprimer cet étudiant ?
            Cette action est irréversible.
        </p>

        <div class="rounded-3 p-3 my-4 text-start" style="background:#F5F3FA;">
            <p class="mb-2"><strong>Nom :</strong> <?= htmlspecialchars($etudiant['nom']) ?></p>
            <p class="mb-2"><strong>Prénom :</strong> <?= htmlspecialchars($etudiant['prenom']) ?></p>
            <p class="mb-0"><strong>Email :</strong> <?= htmlspecialchars($etudiant['email']) ?></p>
        </div>

        <form method="POST" class="d-flex justify-content-center gap-2">
            <a href="index.php" class="btn btn-light border">
                Annuler
            </a>

            <button type="submit" class="btn btn-danger">
                <i class="bi bi-trash me-2"></i>Confirmer la suppression
            </button>
        </form>

    </div>

    <footer>
        © 2026 EduManage. Tous droits réservés.
    </footer>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
