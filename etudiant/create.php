
<?php
require_once "../database/connexion.php";

$sql = "SELECT * FROM Formation";
$stmt = $pdo->query($sql);
$formations = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nom = trim($_POST["nom"]);
    $prenom = trim($_POST["prenom"]);
    $email = trim($_POST["email"]);
    $id_formation = $_POST["id_formation"];

    $sql = "INSERT INTO Etudiant (nom, prenom, email, id_formation)
            VALUES (:nom, :prenom, :email, :id_formation)";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ":nom" => $nom,
        ":prenom" => $prenom,
        ":email" => $email,
        ":id_formation" => $id_formation
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
    <title>EduManage - Nouvel étudiant</title>

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
            <h1 class="page-title">Nouvel étudiant</h1>
            <p class="page-subtitle">Ajoutez un étudiant et associez-le à une formation.</p>
        </div>
    </div>

    <div class="content-card" style="max-width:850px;">

        <div class="d-flex align-items-center mb-4">
            <div class="rounded-3 p-3 me-3" style="background:#E9E5F5;color:#39345C;">
                <i class="bi bi-person-plus fs-3"></i>
            </div>
            <div>
                <h5 class="fw-bold mb-1">Informations de l'étudiant</h5>
                <p class="text-secondary small mb-0">Remplissez les champs ci-dessous</p>
            </div>
        </div>

        <form method="POST">

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Nom</label>
                    <input type="text" name="nom" class="form-control" placeholder="Saisir le nom" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Prénom</label>
                    <input type="text" name="prenom" class="form-control" placeholder="Saisir le prénom" required>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Adresse email</label>
                <input type="email" name="email" class="form-control" placeholder="exemple@email.com" required>
            </div>

            <div class="mb-4">
                <label class="form-label">Formation</label>
                <select name="id_formation" class="form-select" required>
                    <option value="">Choisir une formation</option>

                    <?php foreach ($formations as $formation): ?>
                        <option value="<?= $formation['id_formation'] ?>">
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
                    <i class="bi bi-check-lg me-2"></i>Enregistrer l'étudiant
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
