
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

    $nom_formation = trim($_POST["nom_formation"]);
    $description = trim($_POST["description"]);
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>EduManage - Modifier une formation</title>

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
                <h1 class="page-title">Modifier une formation</h1>
                <p class="page-subtitle">
                    Modifiez les informations de votre formation.
                </p>
            </div>

            <a href="index.php" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-2"></i>
                Retour
            </a>
        </div>

        <div class="row justify-content-center">

            <div class="col-lg-9">

                <div class="content-card">

                    <div class="d-flex align-items-center gap-3 mb-4">

                        <div class="rounded-3 p-3" style="background:#E9E5F5;color:#39345C;">
                            <i class="bi bi-pencil-square fs-3"></i>
                        </div>

                        <div>
                            <h2 class="fs-5 fw-bold mb-1">
                                Informations de la formation
                            </h2>

                            <p class="text-secondary small mb-0">
                                Vous pouvez modifier les champs ci-dessous.
                            </p>
                        </div>

                    </div>

                    <hr style="border-color:#ECE9F3;">

                    <form method="POST">

                        <div class="mb-4">
                            <label class="form-label">
                                Nom de la formation
                            </label>

                            <input
                                type="text"
                                name="nom_formation"
                                class="form-control"
                                value="<?= htmlspecialchars($formation['nom_formation']) ?>"
                                placeholder="Ex : Développement Web"
                                required
                            >
                        </div>

                        <div class="mb-4">
                            <label class="form-label">
                                Description
                            </label>

                            <textarea
                                name="description"
                                class="form-control"
                                rows="4"
                                placeholder="Décrivez brièvement cette formation..."
                            ><?= htmlspecialchars($formation['description']) ?></textarea>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">
                                Durée (mois)
                            </label>

                            <input
                                type="number"
                                name="duree"
                                class="form-control"
                                value="<?= htmlspecialchars($formation['duree']) ?>"
                                min="1"
                                required
                            >
                        </div>

                        <hr style="border-color:#ECE9F3;">

                        <div class="d-flex justify-content-end gap-2">

                            <a href="index.php" class="btn btn-outline-secondary">
                                Annuler
                            </a>

                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-lg me-2"></i>
                                Enregistrer les modifications
                            </button>

                        </div>

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
