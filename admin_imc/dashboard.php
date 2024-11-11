<?php include("C:/wamp64/www/Ivoire_Medical_Center/IMC/config/db_connect.php"); ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <title>Document</title>
    <link rel="stylesheet" href="/Ivoire_Medical_Center/IMC/admin_imc/assets/css/style_dashboard.css">
</head>

<body>

    <!----Principal----->
    <h2 id="first">Général</h2>
    <div class="cards-container-principal">
        <div class="card">
            <div class="title">
                <h2>Nombre de visite</h2>
                <i class="fa-solid fa-user-group fa-2x"></i>
            </div>
            <div class="number">
                <h1>0</h1>
            </div>
            <div class="subtitles">
                <h3>Nombre de visite par jours</h3>
            </div>

        </div>


        <div class="card">
            <div class="title">
                <h2>Nombre de cliniques</h2>
                <i class="fa-regular fa-hospital fa-2x"></i>
            </div>
            <div class="number">
                <?php
                $requete = $bdd->prepare("SELECT COUNT(*) FROM centre_medical");
                $requete->execute();
                $nb_cm = $requete->fetchColumn();
                ?>
                <h1><?php echo $nb_cm; ?></h1>
            </div>
            <div class="subtitles">
                <h3>Nombre de clinique ajoutées</h3>
            </div>
        </div>

        <div class="card">
            <div class="title">
                <h2>Chiffre d'affaire</h2>
                <i class="fa-solid fa-money-bill-wave"></i>
            </div>
            <div class="number">
                <?php /*
                $requete = $bdd->prepare("SELECT COUNT(*) FROM centre_medical");
                $requete->execute();
                $nb_cm = $requete->fetchColumn(); */
                ?>
                <h1>0 FCFA</h1>
            </div>
            <div class="subtitles">
                <h3>Chiffre d'affaire actuel</h3>
            </div>
        </div>


    </div>

    <!----Gestion des forfaits----->

    <h2>Forfaits</h2>
    <div class="cards-container-secondary">
        <div class="card">
            <div class="title">
                <h2>Basic plan</h2>
                <i class="fa-solid fa-users fa-2x"></i>
            </div>
            <div class="number">
                <?php
                $requete = $bdd->prepare("SELECT COUNT(*) FROM forfaits WHERE type_forfait = 'plan basic'  ");
                $requete->execute();
                $nb_plan_basic = $requete->fetchColumn();
                ?>
                <h1> <?php echo $nb_plan_basic; ?> </h1>
            </div>
            <div class="subtitles">
                <h3>Cliniques bénéficiant du forfait basic plan</h3>
            </div>

        </div>

        <div class="card">
            <div class="title">
                <h2>Business plan</h2>
                <i class="fa-solid fa-business-time fa-2x"></i>
            </div>
            <div class="number">
                <?php
                $requete = $bdd->prepare("SELECT COUNT(*) FROM forfaits WHERE type_forfait = 'plan business'  ");
                $requete->execute();
                $nb_plan_business = $requete->fetchColumn();
                ?>
                <h1><?php echo $nb_plan_business; ?></h1>
            </div>
            <div class="subtitles">
                <h3>Cliniques bénéficiant du forfait business plan</h3>
            </div>

        </div>

        <div class="card">
            <div class="title">
                <h2>Entreprise plan</h2>
                <i class="fa-solid fa-user-tie fa-2x"></i>
            </div>
            <div class="number">
                <?php
                $requete = $bdd->prepare("SELECT COUNT(*) FROM forfaits WHERE type_forfait = 'plan entreprise'  ");
                $requete->execute();
                $nb_plan_entreprise = $requete->fetchColumn();
                ?>
                <h1><?php echo $nb_plan_entreprise; ?></h1>
            </div>
            <div class="subtitles">
                <h3>Cliniques bénéficiant du forfait entreprise plan</h3>
            </div>

        </div>
    </div>

    <!------Diagramme----->
    <div class="charts-container">
        <div class="chart-header">
            <h2>Statistiques des forfaits</h2>
        </div>
        <div class="graph" style="text-align:center;">
            <div id="myChart"></div>
        </div>
    </div>






    <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.49.1/apexcharts.min.js" integrity="sha512-qiVW4rNFHFQm0jHli5vkdEwP4GPSzCSp85J7JRHdgzuuaTg31tTMC8+AHdEC5cmyMFDByX639todnt6cxEc1lQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="/Ivoire_Medical_Center/IMC/admin_imc/assets/js/chart.js"></script>
</body>

</html>