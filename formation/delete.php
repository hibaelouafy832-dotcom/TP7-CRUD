
<?php
require_once "../database/connexion.php";

$id = $_GET["id"] ?? null;

if (!$id) {
    header("Location: index.php");
    exit();
}

$sql = "SELECT * FROM Formation WHERE id_formation = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute([":id" => $id]);
$formation = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$formation) {
    header("Location: index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $sql = "DELETE FROM Formation WHERE id_formation = :id";
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

    <title>EduManage - Supprimer une formation</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>

    <aside class="sidebar">

        <a href="../index.php" class="sidebar-brand">
            Edu<span>Manage</span>
        </a>

        <p class="sidebar-label">MENU PRINCIPAL</p>

        <nav class="nav flex-column">

            <a href="../index.php" class="nav-link">
                <i class="bi bi-grid-1x2-fill"></i>
                <span>Dashboard</span>
            </a>

            <a href="index.php" class="nav-link active">
                <i class="bi bi-mortarboard-fill"></i>
                <span>Formations</span>
            </a>

            <a href="../etudiant/index.php" class="nav-link">
                <i class="bi bi-people-fill"></i>
                <span>Étudiants</span>
            </a>

            <a href="../module/index.php" class="nav-link">
                <i class="bi bi-journal-bookmark-fill"></i>
                <span>Modules</span>
            </a>

        </nav>

        <div class="mt-auto">
            <p class="sidebar-label">GESTION</p>

            <a href="../index.php" class="nav-link">
                <i class="bi bi-house-fill"></i>
                <span>Accueil</span>
            </a>
        </div>

    </aside>

    <main class="main-content">

        <div class="topbar">
            <div>
                <h1 class="page-title">Supprimer une formation</h1>
                <p class="page-subtitle">
                    Vérifiez les informations avant de confirmer la suppression.
                </p>
            </div>
        </div>

        <div class="row justify-content-center">

            <div class="col-lg-8">

                <div class="content-card text-center">

                    <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-4"
                         style="width:75px;height:75px;background:#FCE8E8;color:#DC3545;">
                        <i class="bi bi-trash3-fill fs-2"></i>
                    </div>

                    <h2 class="fs-4 fw-bold mb-2">
                        Confirmer la suppression
                    </h2>

                    <p class="text-secondary mb-4">
                        Voulez-vous vraiment supprimer cette formation ?
                    </p>

                    <div class="text-start rounded-3 p-4 mb-4"
                         style="background:#F8F6FC;">

                        <p class="mb-3">
                            <strong>ID :</strong>
                            <?= htmlspecialchars($formation['id_formation']) ?>
                        </p>

                        <p class="mb-3">
                            <strong>Nom :</strong>
                            <?= htmlspecialchars($formation['nom_formation']) ?>
                        </p>

                        <p class="mb-3">
                            <strong>Description :</strong>
                            <?= htmlspecialchars($formation['description']) ?>
                        </p>

                        <p class="mb-0">
                            <strong>Durée :</strong>
                            <?= htmlspecialchars($formation['duree']) ?> mois
                        </p>

                    </div>

                    <div class="alert alert-warning text-start small">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        Attention : cette opération peut être définitive.
                    </div>

                    <form method="POST" class="d-flex justify-content-center gap-2">

                        <a href="index.php" class="btn btn-outline-secondary">
                            Annuler
                        </a>

                        <button type="submit" class="btn btn-danger">
                            <i class="bi bi-trash3 me-2"></i>
                            Confirmer la suppression
                        </button>

                    </form>

                </div>

            </div>

        </div>

        <footer>
            © 2026 EduManage - Tous droits réservés
        </footer>

    </main>

</body>
</html>
