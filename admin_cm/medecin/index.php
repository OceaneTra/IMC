<?php include("C:/wamp64/www/Ivoire_Medical_Center/IMC/config/db_connect.php"); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Document</title>
    <link rel="stylesheet" href="/Ivoire_Medical_Center/IMC/admin_cm/assets/css/index.css">
</head>

<body>
    <nav id="navbar">
        <ul>
            <div class="logo-container">
                <div class="logo">
                    <img src="/Ivoire_Medical_Center/IMC/admin_imc/assets/images/logoImc.jpg" width="30%" height="100%" alt="">
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
                    <a href="?page=staff">Staffs</a>
                </div>
                <ul class="sub-items-containers">
                    <li class="sub-items"><span><i class="fa-solid fa-stethoscope"></i></span> <a href="">Medecins</a></li>
                    <li class="sub-items"><span><i class="fa-solid fa-user-nurse"></i></span><a href="">Infirmiers</a></li>
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
                <a href="#">Deconnexion</a>
            </li>
        </ul>

        <div class="personal">
            <img src="/api/placeholder/45/45" alt="Profile">
            <div class="info">
                <h3 class="nom">John Doe</h3>
                <h5 class="fonction">Administrateur</h5>
            </div>
        </div>
    </nav>

    <main>
        <?php  

        switch($_GET['page'] ?? 'dashboard'){
            case 'dashboard': include("dashboard.php"); break;
            case 'patient': include("patients.php"); break;
            case 'staff': include("staffs.php"); break;
            case 'agenda': include("agenda.php"); break;
            case 'params': include("parametres.php"); break;
        }
        
        ?>
    </main>

</body>

</html>