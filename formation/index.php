<?php
require_once "../database/connexion.php";

$sql = "SELECT * FROM Formation";
$stmt = $pdo->query($sql);
$formations = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>EduManage - Formations</title>

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
                <h1 class="page-title">Gestion des formations</h1>
                <p class="page-subtitle">
                    Consultez et gérez les formations de votre établissement.
                </p>
            </div>

            <a href="create.php" class="btn btn-primary">
                <i class="bi bi-plus-lg me-2"></i>
                Nouvelle formation
            </a>
        </div>

        <div class="row g-4 mb-4">

            <div class="col-md-4">
                <div class="stat-card">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3>TOTAL FORMATIONS</h3>
                        <i class="bi bi-mortarboard-fill fs-3" style="color:#8B7CC8;"></i>
                    </div>

                    <div class="number">
                        <?= count($formations) ?>
                    </div>

                    <p class="text-secondary small mt-2 mb-0">
                        Formations enregistrées
                    </p>
                </div>
            </div>

            <div class="col-md-8">
                <div class="content-card h-100 d-flex align-items-center">
                    <div>
                        <h5 class="fw-bold">Espace formations</h5>
                        <p class="text-secondary small mb-0">
                            Gérez les informations, les descriptions et les durées
                            de vos différentes formations.
                        </p>
                    </div>
                </div>
            </div>

        </div>

        <div class="content-card">

            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="fs-5 fw-bold mb-1">Liste des formations</h2>
                    <p class="text-secondary small mb-0">
                        Toutes les formations disponibles dans le système.
                    </p>
                </div>

                <span class="badge rounded-pill px-3 py-2" style="background:#E9E5F5;color:#39345C;">
                    <?= count($formations) ?> formations
                </span>
            </div>

            <div class="table-responsive">

                <table class="table align-middle">

                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nom de formation</th>
                            <th>Description</th>
                            <th>Durée</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php if (count($formations) > 0): ?>

                            <?php foreach ($formations as $formation): ?>

                                <tr>
                                    <td>
                                        <span class="badge rounded-pill" style="background:#F0EDF8;color:#39345C;">
                                            #<?= htmlspecialchars($formation['id_formation']) ?>
                                        </span>
                                    </td>

                                    <td class="fw-semibold">
                                        <?= htmlspecialchars($formation['nom_formation']) ?>
                                    </td>

                                    <td>
                                        <?= htmlspecialchars($formation['description']) ?>
                                    </td>

                                    <td>
                                        <span class="badge rounded-pill" style="background:#E9E5F5;color:#39345C;">
                                            <?= htmlspecialchars($formation['duree']) ?>
                                        </span>
                                    </td>

                                    <td class="text-center">

                                        <a href="edit.php?id=<?= urlencode($formation['id_formation']) ?>"
                                           class="btn btn-sm btn-outline-primary me-1"
                                           title="Modifier">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>

                                        <a href="delete.php?id=<?= urlencode($formation['id_formation']) ?>"
                                           class="btn btn-sm btn-outline-danger"
                                           title="Supprimer"
                                           onclick="return confirm('Voulez-vous vraiment supprimer cette formation ?')">
                                            <i class="bi bi-trash3"></i>
                                        </a>

                                    </td>
                                </tr>

                            <?php endforeach; ?>

                        <?php else: ?>

                            <tr>
                                <td colspan="5" class="text-center py-5 text-secondary">
                                    <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                                    Aucune formation enregistrée.
                                </td>
                            </tr>

                        <?php endif; ?>

                    </tbody>

                </table>

            </div>

        </div>

        <footer>
            © 2026 EduManage - Tous droits réservés
        </footer>

    </main>

</body>
</html>
