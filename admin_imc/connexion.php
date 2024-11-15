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
    } else {
        $error_message = "Veuiller remplir tous les champs.";
    }
}

if (!empty($error_message)) {
    $_SESSION["error_message"] = $error_message;
    header('Location: connexion.php');
    exit;
}



?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/PageInscription.css">
    <title>Connexion</title>


    <style>
        * {
            margin: 0px;
        }

        body {
            width: 100%;
            height: 100%;
            margin: 0px;
            background: linear-gradient(90deg, rgba(2, 0, 0, 0.6) 0%, rgba(9, 9, 121, 1) 35%, rgba(0, 212, 255, 1) 100%);
            display: flex;
        }


        a {
            text-decoration: none;
        }

        form {
            display: flex;
            flex-direction: column;
            border-left: none;
            width: 37.5em;
            font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
            font-size: 15px;
            color: white;
            background-color: rgba(0, 0, 0, 0.3);
            border-radius: 7px;
            margin: auto;
            padding: 20px;
            margin-top: 175px;
        }

        form .btn {
            display: flex;
            font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
            font-size: 15px;
            justify-content: end;
            padding-top: 50px;
            padding-right: 50px;
            gap: 20px;

        }

        input {
            border-top: none;
            border-right: none;
            border-left: none;
            background-color: aliceblue;
            outline: none;
            cursor: pointer;
        }

        input[type="submit"] {
            border-bottom: none;
            border: 2px solid black;
            width: 325px;
            height: 50px;
            background-color: rgba(255, 255, 255);
            font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
            font-size: 15px;
        }

        input[type="text"],
        input[type="password"] {
            height: 20px;
        }



        form .Connexion {
            display: flex;
            flex-direction: column;
            gap: 50px;
            align-self: center;
        }

        form .Connexion .mail {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }


        form .Connexion .mdp {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }


        a {
            color: black;
        }
    </style>

</head>

<body>
    <form action="" method="post">

        <div class="Connexion">

            <h1>Se connecter</h1>

            <div class="mail">
                <label for="mail"> Adresse mail </label>
                <input type="email" name="mail" id="mail" placeholder="johnsmith@mail.com">
            </div>

            <div class="mdp">
                <label for="mdp"> Mot de passe </label>
                <input type="password" name="mdp" id="mdp" placeholder="*********">
            </div>

            <input type="submit" name="se_connecter" id="" value="Se connecter">
        </div>
    </form>


</body>

</html>