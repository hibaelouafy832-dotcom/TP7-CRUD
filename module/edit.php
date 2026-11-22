
<?php
require_once "../database/connexion.php";

$id = $_GET["id"] ?? null;

if (!$id) {
    header("Location: index.php");
    exit();
}

$sql = "SELECT * FROM Module WHERE id_module = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute([":id" => $id]);
$module = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$module) {
    header("Location: index.php");
    exit();
}

$sql = "SELECT * FROM Formation";
$stmt = $pdo->query($sql);
$formations = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nom_module = trim($_POST["nom_module"]);
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduManage - Modifier un module</title>

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

    <a href="../etudiant/index.php" class="nav-link">
        <i class="bi bi-people"></i><span>Étudiants</span>
    </a>

    <a href="../module/index.php" class="nav-link active">
        <i class="bi bi-book"></i><span>Modules</span>
    </a>
</div>

<div class="main-content">

    <div class="topbar">
        <div>
            <h1 class="page-title">Modifier un module</h1>
            <p class="page-subtitle">Modifiez les informations du module sélectionné.</p>
        </div>
    </div>

    <div class="content-card" style="max-width:850px;">

        <div class="d-flex align-items-center mb-4">
            <div class="rounded-3 p-3 me-3" style="background:#E9E5F5;color:#39345C;">
                <i class="bi bi-journal-text fs-3"></i>
            </div>

            <div>
                <h5 class="fw-bold mb-1">Informations du module</h5>
                <p class="text-secondary small mb-0">Modifiez les champs nécessaires</p>
            </div>
        </div>

        <form method="POST">

            <div class="mb-3">
                <label class="form-label">Nom du module</label>
                <input type="text" name="nom_module" class="form-control"
                       value="<?= htmlspecialchars($module['nom_module']) ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Volume horaire</label>
                <div class="input-group">
                    <input type="number" name="volume_horaire" class="form-control"
                           value="<?= htmlspecialchars($module['volume_horaire']) ?>" min="1" required>
                    <span class="input-group-text">Heures</span>
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label">Formation</label>
                <select name="id_formation" class="form-select" required>

                    <?php foreach ($formations as $formation): ?>
                        <option value="<?= $formation['id_formation'] ?>"
                            <?= ($formation['id_formation'] == $module['id_formation']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($formation['nom_formation']) ?>
                        </option>
                    <?php endforeach; ?>

                </select>
            </div>

            <div class="d-flex gap-2 justify-content-end">
                <a href="index.php" class="btn btn-light border">
                    Annuler
                </a>

                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-lg me-2"></i>Enregistrer les modifications
                </button>
            </div>

        </form>
    </div>

    <footer>
        © 2026 EduManage. Tous droits réservés.
    </footer>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
