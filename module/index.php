
<?php
require_once "../database/connexion.php";

$sql = "SELECT m.*, f.nom_formation
        FROM Module m
        INNER JOIN Formation f
        ON m.id_formation = f.id_formation";

$stmt = $pdo->query($sql);
$modules = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduManage - Modules</title>

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
            <h1 class="page-title">Gestion des modules</h1>
            <p class="page-subtitle">Consultez et gérez les modules de formation.</p>
        </div>

        <a href="create.php" class="btn btn-primary">
            <i class="bi bi-plus-lg me-2"></i>Nouveau module
        </a>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="stat-card">
                <h3>Nombre total de modules</h3>
                <div class="number"><?= count($modules) ?></div>
            </div>
        </div>
    </div>

    <div class="content-card">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h5 class="fw-bold mb-1">Liste des modules</h5>
                <p class="text-secondary small mb-0">Les modules et leurs formations associées</p>
            </div>

            <i class="bi bi-book fs-3" style="color:#8B7CC8;"></i>
        </div>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom du module</th>
                        <th>Volume horaire</th>
                        <th>Formation</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if (count($modules) > 0): ?>
                        <?php foreach ($modules as $module): ?>
                            <tr>
                                <td><?= htmlspecialchars($module['id_module']) ?></td>

                                <td class="fw-semibold">
                                    <?= htmlspecialchars($module['nom_module']) ?>
                                </td>

                                <td>
                                    <span class="badge rounded-pill" style="background:#E9E5F5;color:#39345C;">
                                        <?= htmlspecialchars($module['volume_horaire']) ?> heures
                                    </span>
                                </td>

                                <td><?= htmlspecialchars($module['nom_formation']) ?></td>

                                <td>
                                    <a href="edit.php?id=<?= $module['id_module'] ?>" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>

                                    <a href="delete.php?id=<?= $module['id_module'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Voulez-vous vraiment supprimer ce module ?');">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center py-4 text-secondary">
                                Aucun module trouvé.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <footer>
        © 2026 EduManage. Tous droits réservés.
    </footer>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
