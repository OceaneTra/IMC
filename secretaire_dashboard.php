<?php
session_start();
include __DIR__ . '/www/config/db_connect.php';

if (!isset($_SESSION['utilisateur_id'])) {
    header("Location: PageConnexion.php");
    exit();
}

$user_id = $_SESSION['utilisateur_id'];
$user_type = $_SESSION['utilisateur_type'];

// Optimisation de la requête SQL avec un switch
$sql = "";
switch ($user_type) {
    case 'medecin':
        $sql = "SELECT nom_medecin as nom, prenom_medecin as prenom, photo FROM medecin WHERE id_medecin = :id";
        break;
    case 'secretaire':
        $sql = "SELECT nom_secretaire as nom, prenom_secretaire as prenom, photo FROM secretaire WHERE id_secretaire = :id";
        break;
    case 'infirmier':
        $sql = "SELECT nom_infirmier as nom, prenom_infirmier as prenom, photo FROM infirmier WHERE id_infirmier = :id";
        break;
}

$stmt = $connexion->prepare($sql);
$stmt->execute([':id' => $user_id]);
$utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);

$nom_utilisateur = $utilisateur['nom'] ?? '';
$prenom_utilisateur = $utilisateur['prenom'] ?? '';
$photo_utilisateur = $utilisateur['photo'] ?? 'default.jpg';
?>










<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/index.css">
    <title>Secrétariat</title>
</head>

<body>
    <nav id="navbar">
        <ul>
            <div class="logo-container">
                <div class="logo">
                    <img src="../IMC/img/logo.jpg" width="30%" height="100%" alt="">
                    <div class="text">
                        <h3>Ivoire Medical</h3>
                        <h3 style="text-align:center;color:#405ae7; font-weight:bold;">Center</h3>
                    </div>
                </div>
            </div>

            <li class="items" style="align-items:center;">
                <i class="fa-solid fa-calendar-check"></i>
                <a href="?page=rendez-vous">Rendez-vous</a>
            </li>

            <li class="items" style="align-items:center;">
                <i class="fa-solid fa-user"></i>
                <a href="?page=patients">Liste des Patients</a>
            </li>

            <li class="items" style="align-items:center;">
                <i class="fa-solid fa-gear"></i>
                <a href="?page=params">Paramètres</a>
            </li>

            <li class="items" style="align-items:center;">
                <i class="fa-solid fa-power-off"></i>
                <a href="PageConnexion.php">Déconnexion</a>
            </li>
        </ul>

        <div class="personal">
        <img src="<?php  echo $photo_utilisateur?>" alt="Profile">
            <div class="info">
                <h3 class="nom"><?= htmlspecialchars($nom_utilisateur) . ' ' . htmlspecialchars($prenom_utilisateur) ?></h3>
                <h5 class="fonction"><?= ucfirst($user_type) ?></h5>
            </div>
        </div>

    </nav>

    <main>
        <?php
        switch ($_GET['page'] ?? 'rendez-vous') {
            case 'rendez-vous':
                include("rendez-vous.php");
                break;
            case 'patients':
                include("patients.php");
                break;
            case 'params':
                include("parametres_secretaire.php");
                break;
            default:
                include("rendez-vous.php");
                break;
        }
        ?>
    </main>
</body>

</html>