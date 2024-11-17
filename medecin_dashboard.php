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
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Medecin</title>
    <link rel="stylesheet" href="css/index_style.css">
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
                <i class="fa-solid fa-table"></i>
                <a href="?page=dashboard">Tableau de Bord</a>
            </li>

            <li class="items" style="align-items:center;">
                <i class="fa-solid fa-bed-pulse"></i>
                <a href="?page=patient">Patients</a>
            </li>

            <li class="items" style="display:flex; flex-direction:column;">
                <div class="title">
                    <i class="fa-solid fa-hospital-user"></i>
                    <a href="#">Staffs</a>
                </div>
                <ul class="sub-items-containers">
                    <li class="sub-items"><span><i class="fa-solid fa-stethoscope"></i></span> <a href="?page=staffMedecin">Medecins</a></li>
                    <li class="sub-items"><span><i class="fa-solid fa-user-nurse"></i></span><a href="?page=staffInfirmier">Infirmiers</a></li>
                </ul>
            </li>

            <li class="items" style="align-items:center;">
                <i class="fa-solid fa-calendar-days"></i>
                <a href="?page=agenda">Agenda</a>
            </li>

            <li class="items" style="align-items:center;">
                <i class="fa-solid fa-gear"></i>
                <a href="?page=params">Paramètres</a>
            </li>

            <li class="items" style="align-items:center;">
                <i class="fa-solid fa-power-off"></i>
                <a href="PageConnexion.php">Deconnexion</a>
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

        switch ($_GET['page'] ?? 'dashboard') {
            case 'dashboard':
                include("dashboard.php");
                break;
            case 'patient':
                include("patients_medecin.php");
                break;
            case 'staffMedecin':
                include("staffs_medecin.php");
                break;
            case 'staffInfirmier':
                include("staffs_infirmier.php");
                break;
            case 'agenda':
                include("agenda.php");
                break;
            case 'params':
                include("parametres_medecin.php");
                break;
        }

        ?>
    </main>

</body>

</html>