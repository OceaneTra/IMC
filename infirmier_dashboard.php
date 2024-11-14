<?php 


include __DIR__ . '/www/config/db_connect.php'; 
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/index.css">
    <title>Infirmerie</title>
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
                <i class="fa-solid fa-user-plus"></i>
                <a href="?page=nouveaux-patients">Nouveaux Patients</a>
            </li>

            <li class="items" style="align-items:center;">
                <i class="fa-solid fa-file-invoice"></i>
                <a href="?page=facturation">Facturation</a>
            </li>

            <li class="items" style="display:flex; flex-direction:column;">
                <div class="title">
                    <i class="fa-solid fa-folder-open"></i>
                    <a href="?page=dossiers">Dossiers Patients</a>
                </div>
                <ul class="sub-items-containers">
                    <li class="sub-items"><span><i class="fa-solid fa-clock-rotate-left"></i></span> <a href="?page=historique">Historique</a></li>
                    <li class="sub-items"><span><i class="fa-solid fa-file-medical"></i></span><a href="?page=documents">Documents</a></li>
                </ul>
            </li>

            <li class="items" style="align-items:center;">
                <i class="fa-solid fa-calendar-days"></i>
                <a href="?page=planning">Planning</a>
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
            <img src="/api/placeholder/45/45" alt="Profile">
            <div class="info">
                <h3 class="nom">Marie Konan</h3>
                <h5 class="fonction">Infirmier</h5>
            </div>
        </div>
    </nav>

    <main>
        <?php
        switch($_GET['page'] ?? 'rendez-vous'){
            case 'rendez-vous': include("rendez-vous.php"); break;
            case 'nouveaux-patients': include("nouveaux-patients.php"); break;
            case 'facturation': include("facturation.php"); break;
            case 'dossiers': include("dossiers.php"); break;
            case 'historique': include("historique.php"); break;
            case 'documents': include("documents.php"); break;
            case 'planning': include("planning.php"); break;
            case 'params': include("parametres.php"); break;
        }
        ?>
    </main>
</body>
</html>