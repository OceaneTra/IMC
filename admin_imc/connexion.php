<?php

session_start();
include("C:/wamp64/www/Ivoire_Medical_Center/IMC/config/db_connect.php");

//traitement connexion
$error_message = '';
if (isset($_POST['se_connecter'])) {
    $adresse_mail = $_POST['mail'];
    $mdp = $_POST['mdp'];
    if (!empty($adresse_mail) && !empty($mdp)) {
        $recupUser = $bdd->prepare('SELECT * FROM admin_imc WHERE `email_imc` = ? AND `password_imc` = ?');
        $recupUser->execute(array($adresse_mail, $mdp));
        if ($recupUser->rowCount() > 0) {
            $userInfo = $recupUser->fetch();
            $_SESSION['id_imc'] = $userInfo['id_imc'];
            $_SESSION['mail'] = $adresse_mail;
            $_SESSION['mdp'] = $mdp;
            $_SESSION['nom_imc'] = $userInfo["nom_imc"];
            $_SESSION['photo_profil'] = $userInfo['photo_profil'];
            header('Location: index.php');
            exit;
        }
    }
}

if (isset($_GET['op']) && $_GET['op'] == 'deconnexion') {
    session_unset();
    session_destroy();

    header('Location: connexion.php');
    exit();
}

?>




<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Connexion</title>
    <link rel="stylesheet" href="/Ivoire_Medical_Center/IMC/admin_imc/assets/css/connexion_style.css">
</head>

<body>
    <form action="" method="post">
        <div class="home">
            <img src="/Ivoire_Medical_Center/IMC/admin_imc/assets/images/logo_imc_fblanc.png" width="80px" height="80px" alt="">
            <div class="titles">
                <div class="title">IVOIRE</div>
                <span class="subtitle">Medical Center</span>
            </div>
        </div>


        <div class="text">
            <div>Connectez-vous <br> à votre plateforme</div>
            <p>Saisissez votre mail et mot de passe pour vous connecter</p>
        </div>


        <div class="input-container">
            <div class="mail">
                <i class="fa-solid fa-circle-user"></i>
                <input type="email" name="mail" id="mail" placeholder="tapez votre adresse mail ici">
            </div>

            <div class="mdp">
                <i class="fa-solid fa-lock"></i>
                <input type="password" name="mdp" id="mdp" placeholder="••••••••••••">
            </div>
        </div>
        <p><a href="mdp_oublie.php">Mot de passe <span>oublié ?</span></a></p>

        <div class="cnx">
            <input type="submit" name="se_connecter" value="Connexion   &gt;" >
        </div>



    </form>


</body>

</html>