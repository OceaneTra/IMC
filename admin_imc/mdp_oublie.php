<?php

session_start();
include("C:/wamp64/www/Ivoire_Medical_Center/IMC/config/db_connect.php"); ?>




<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Connexion</title>
    <link rel="stylesheet" href="/Ivoire_Medical_Center/IMC/admin_imc/assets/css/mdp_style.css">
</head>

<body>
    <form action="" method="post">
        <div class="home">
            <img src="/Ivoire_Medical_Center/IMC/admin_imc/assets/images/logo_imc_fblanc.png" width="80px" height="80px" alt="">
            <div class="titles">
                <div class="title">IVOIRE</div>
                <span class="subtitle">Medical Center</span>
            </div>
            <a href="connexion.php" style="text-decoration:none; color:#fff;margin-left: 50px;"><i class="fa-solid fa-reply fa-2x"></i></a>
        </div>


        <div class="text">
            <div>Mot de passe oublié ?</div>
            <p>Entrez votre adresse mail. <br> Nous vous enverrons un mail de confirmation</p>
        </div>


        <div class="input-container">
            <div class="mail">
                <i class="fa-solid fa-envelope"></i>
                <input type="email" name="mail" id="mail" placeholder="Entrer votre mail">
            </div>
        </div>

        <div class="cnx">
            <input type="submit" name="envoyez" value="Envoyez le mail">
        </div>



    </form>


</body>

</html>