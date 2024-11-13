<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Document</title>
    <link rel="stylesheet" href="/Ivoire_Medical_Center/IMC/admin_imc/assets/css/index_style.css">
</head>

<body>

    <nav id="navbar">
        <div class="logo-container">
            <div class="logo">
                <img src="/Ivoire_Medical_Center/IMC/admin_imc/assets/images/logoImc.jpg" width="30%" height="100%" alt="">
                <div class="text">
                    <h3>Ivoire Medical</h3>
                    <h3 style="text-align:center;color:#405ae7; font-weight:bold;">Center</h3>
                </div>
            </div>
            <div class="subtitle">
                <h5>afficher ici le type du personnel</h5>
            </div>
        </div>

        <ul>
            <span>Main</span>
            <li>
                <i class="fa-solid fa-table-cells"></i>
                <a href="index.php?page=dashboard">Tableau de bord</a>
            </li>
            <hr>

            <span>Menu de gestion</span>
            <li>
                <i class="fa-solid fa-house-chimney-medical"></i>
                <a href="index.php?page=gsClinique">Gestion des cliniques</a>
            </li>
            <li>
                <i class="fa-solid fa-tag"></i>
                <a href="index.php?page=gsForfaits">Gestion des forfaits</a>
            </li>
            <hr>
            <span>Paramètres géneraux</span>
            <li>
                <i class="fa-solid fa-bell"></i>
                <a href="index.php?page=gsNotifications">Notifications</a>
            </li>
            <hr>
            <span>Paramètres</span>
            <li>
                <i class="fa-solid fa-gear"></i>
                <a href="index.php?page=gsParams">Paramètres</a>
            </li>
            <li>
                <i class="fa-solid fa-power-off"></i>
                <a href="#">Deconnexion</a>
            </li>


        </ul>

    </nav>

    <main>
        <header>
            <div class="search">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" placeholder="rechercher...">
            </div>

            <div class="datetime">
                <h3><?php echo date("Y:m:d H:i"); ?></h3>
            </div>

            <div class="personal">
                <h3>nom d'utilisateur</h3>
                <img src="" alt="">
            </div>
        </header>

        <div class="main-container">
            <h2>Bienvenue, Gomez Axel</h2>

            <?php

            switch ($_GET['page'] ?? 'dashboard') {
                case 'dashboard':
                    include("dashboard.php");
                    break;
                case 'gsClinique':
                    include("gestion_clinique.php");
                    break;
                case 'gsForfaits':
                    include("gestion_forfaits.php");
                    break;
                case 'gsNotifications':
                    include("notifications.php");
                    break;
                case 'gsParams':
                    include("parametres.php");
                    break;
            }




            ?>
        </div>


        <!----Partie Php---->

    </main>







</body>

</html>