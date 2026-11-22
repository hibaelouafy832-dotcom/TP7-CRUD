
<?php
require_once "database/connexion.php";

$totalFormations = $pdo->query("SELECT COUNT(*) FROM Formation")->fetchColumn();
$totalEtudiants = $pdo->query("SELECT COUNT(*) FROM Etudiant")->fetchColumn();
$totalModules = $pdo->query("SELECT COUNT(*) FROM Module")->fetchColumn();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>EduManage - Accueil</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <aside class="sidebar">

        <a href="index.php" class="sidebar-brand">
            Edu<span>Manage</span>
        </a>

        <p class="sidebar-label">MENU PRINCIPAL</p>

        <nav class="nav flex-column">

            <a href="index.php" class="nav-link active">
                <i class="bi bi-grid-1x2-fill"></i>
                <span>Dashboard</span>
            </a>

            <a href="formation/index.php" class="nav-link">
                <i class="bi bi-mortarboard-fill"></i>
                <span>Formations</span>
            </a>

            <a href="etudiant/index.php" class="nav-link">
                <i class="bi bi-people-fill"></i>
                <span>Étudiants</span>
            </a>

            <a href="module/index.php" class="nav-link">
                <i class="bi bi-journal-bookmark-fill"></i>
                <span>Modules</span>
            </a>

        </nav>

        <div class="mt-auto">
            <p class="sidebar-label">GESTION</p>

            <a href="index.php" class="nav-link">
                <i class="bi bi-house-fill"></i>
                <span>Accueil</span>
            </a>
        </div>

    </aside>

    <main class="main-content">

        <div class="topbar">
            <div>
                <h1 class="page-title">Bienvenue sur EduManage</h1>
                <p class="page-subtitle">
                    Votre plateforme de gestion académique.
                </p>
            </div>
        </div>

        <div class="content-card mb-4">

            <h2 class="fw-bold mb-3">
                Gérez votre établissement en toute simplicité
            </h2>

            <p class="text-secondary mb-0">
                EduManage est une application de gestion académique
                qui permet de gérer les formations, les étudiants
                et les modules dans une interface simple et organisée.
            </p>

        </div>

        <h2 class="fs-5 fw-bold mb-3">Vue d'ensemble</h2>

        <div class="row g-4">

            <div class="col-md-4">

                <div class="stat-card h-100">

                    <div class="d-flex justify-content-between align-items-center">
                        <h3>FORMATIONS</h3>
                        <i class="bi bi-mortarboard-fill fs-3" style="color:#8B7CC8;"></i>
                    </div>

                    <div class="number">
                        <?= $totalFormations ?>
                    </div>

                    <p class="text-secondary small mt-2">
                        Formations enregistrées
                    </p>

                    <a href="formation/index.php" class="btn btn-primary w-100 mt-2">
                        Gérer les formations
                        <i class="bi bi-arrow-right"></i>
                    </a>

                </div>

            </div>

            <div class="col-md-4">

                <div class="stat-card h-100">

                    <div class="d-flex justify-content-between align-items-center">
                        <h3>ÉTUDIANTS</h3>
                        <i class="bi bi-people-fill fs-3" style="color:#8B7CC8;"></i>
                    </div>

                    <div class="number">
                        <?= $totalEtudiants ?>
                    </div>

                    <p class="text-secondary small mt-2">
                        Étudiants inscrits
                    </p>

                    <a href="etudiant/index.php" class="btn btn-primary w-100 mt-2">
                        Gérer les étudiants
                        <i class="bi bi-arrow-right"></i>
                    </a>

                </div>

            </div>

            <div class="col-md-4">

                <div class="stat-card h-100">

                    <div class="d-flex justify-content-between align-items-center">
                        <h3>MODULES</h3>
                        <i class="bi bi-journal-bookmark-fill fs-3" style="color:#8B7CC8;"></i>
                    </div>

                    <div class="number">
                        <?= $totalModules ?>
                    </div>

                    <p class="text-secondary small mt-2">
                        Modules disponibles
                    </p>

                    <a href="module/index.php" class="btn btn-primary w-100 mt-2">
                        Gérer les modules
                        <i class="bi bi-arrow-right"></i>
                    </a>

                </div>

            </div>

        </div>

        <div class="mt-4">

            <h2 class="fs-5 fw-bold mb-3">Actions rapides</h2>

            <div class="row g-4">

                <div class="col-md-4">

                    <div class="content-card h-100">

                        <i class="bi bi-mortarboard-fill fs-2" style="color:#8B7CC8;"></i>

                        <h5 class="fw-bold mt-3">
                            Nouvelle formation
                        </h5>

                        <p class="text-secondary small">
                            Ajouter une nouvelle formation à votre établissement.
                        </p>

                        <a href="formation/create.php" class="btn btn-primary w-100">
                            Ajouter une formation
                            <i class="bi bi-plus-lg"></i>
                        </a>

                    </div>

                </div>

                <div class="col-md-4">

                    <div class="content-card h-100">

                        <i class="bi bi-person-plus-fill fs-2" style="color:#8B7CC8;"></i>

                        <h5 class="fw-bold mt-3">
                            Nouvel étudiant
                        </h5>

                        <p class="text-secondary small">
                            Inscrire un nouvel étudiant dans une formation.
                        </p>

                        <a href="etudiant/create.php" class="btn btn-primary w-100">
                            Ajouter un étudiant
                            <i class="bi bi-plus-lg"></i>
                        </a>

                    </div>

                </div>

                <div class="col-md-4">

                    <div class="content-card h-100">

                        <i class="bi bi-journal-plus fs-2" style="color:#8B7CC8;"></i>

                        <h5 class="fw-bold mt-3">
                            Nouveau module
                        </h5>

                        <p class="text-secondary small">
                            Ajouter un module à une formation existante.
                        </p>

                        <a href="module/create.php" class="btn btn-primary w-100">
                            Ajouter un module
                            <i class="bi bi-plus-lg"></i>
                        </a>

                    </div>

                </div>

            </div>

        </div>

        <footer>
            © 2026 EduManage - Tous droits réservés
        </footer>

    </main>

</body>
</html>
