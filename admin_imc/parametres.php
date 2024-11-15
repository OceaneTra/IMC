<?php
include("C:/wamp64/www/Ivoire_Medical_Center/IMC/config/db_connect.php");


// traitement modification 
if (isset($_POST['sauvegarder'])) {
    $id_imc = $_SESSION['id_imc'];


    //Anciennes valeurs
    $ancien_nom = $_SESSION['nom_imc'];
    $ancien_mail = $_SESSION['email_imc'];
    $ancien_mdp = $_SESSION['password_imc'];
    $ancienne_photo = $_SESSION['photo_profil'];


    //Nouvelles valeurs
    $nom = $_POST['nom'];
    $mdp = $_POST['mdp'];
    $mail = $_POST['mail'];

    //traitement photo

    if (isset($_FILES['changer']) && $_FILES['changer']['error'] == 0) {
        $photo = basename($_FILES['changer']['name']);
        move_uploaded_file($_FILES['changer']['tmp_name'], $photo);
    } else {
        $photo = $ancienne_photo;
    }
    if ($_POST['mail'] != $ancien_mail || $_POST['mdp'] != $ancien_mdp || $_POST['nom'] != $ancien_nom || $photo != $ancienne_photo) {

        $req = $bdd->prepare("UPDATE admin_imc SET
        nom_imc = ?,
        email_imc = ?,
        password_imc = ?,
        photo_profil = ?
        WHERE id_imc = ? ");

        $req->execute([$nom, $mail, $mdp, $photo, $id_imc]);

        $_SESSION['nom_imc'] = $nom;
        $_SESSION['email_imc'] = $mail;
        $_SESSION['password_imc'] = $mdp;
        $_SESSION['photo_profil'] = $photo;

        header("Location: index.php?page=gsParams");
        exit();
    }
}

/* recuperation des données pour les afficher dans le formulaire */
if (isset($_SESSION['id_imc'])) {
    $id_imc = $_SESSION['id_imc'];
    $stmt = $bdd->prepare("SELECT * FROM admin_imc WHERE id_imc = ?");
    $stmt->execute([$id_imc]);
    $adminInfo = $stmt->fetch();

    if ($adminInfo) {
        $nom = $adminInfo['nom_imc'];
        $adresse_mail = $adminInfo['email_imc'];
        $mdp = $adminInfo['password_imc'];
        $photo = $adminInfo['photo_profil'];
    }
}

// traitement suppression
if (isset($_POST['supprimer'])) {
    $requete = $bdd->prepare('UPDATE admin_imc SET photo_profil = " "  WHERE id_imc = ? ');
    $requete->execute([$_SESSION['id_imc']]);
    $_SESSION['photo_profil'] = ' ';
    header("Location: index.php?page=gsParams");
    exit();
}





?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/Ivoire_Medical_Center/IMC/admin_imc/assets/css/params_styles.css">
</head>

<body>




    <h2 style="margin-left: 200px;" id="textp">Mon profil</h2>
    <p style="margin-left: 200px;">Gérez les paramètres de votre profil</p>

    <form action="" method="post" enctype="multipart/form-data">

        <div class="top">
            <div class="profil">
                <img src="<?php if (isset($adminInfo['photo_profil'])) {
                                echo $adminInfo['photo_profil'];
                            } ?>" name="photo" alt="">
                <div class="submit-container">
                    <label for="changer">Changer la photo</label>
                    <input type="file" name="changer" id="changer" value="Changer la photo" hidden>
                    <input type="submit" name="supprimer" value="Supprimer">
                </div>
            </div>


            <div class="alert">
                <div class="text">
                    <h3>Ayez confiance !</h3>
                    <p>Vos informations personnelles sont traités avec le plus grand soin.
                        Nous utilisons des technologies avancées de sécurité pour assurer la confidentialité et l'intégrité de vos données.
                        Naviguez donc en toute sérénité, votre confidentialités et notre priorité.</p>
                </div>
                <img src="/Ivoire_Medical_Center/IMC/admin_imc/assets/images/imgLock.png" alt="">
            </div>
        </div>

        <div class="infos">

            <div class="nom">
                <label for="nom">Nom: </label>
                <input type="text" name="nom" id="nom" value="<?php if (isset($adminInfo['nom_imc'])) {
                                                                    echo $adminInfo['nom_imc'];
                                                                } ?>">
            </div>

            <div class="mail">
                <label for="mail">Email: </label>
                <input type="email" name="mail" id="mail" value="<?php if (isset($adminInfo['email_imc'])) {
                                                                        echo $adminInfo['email_imc'];
                                                                    } ?>">
            </div>

            <div class="mdp">
                <label for="mdp">Mot de passe: </label>
                <input type="password" name="mdp" id="mdp" value="<?php if (isset($adminInfo['password_imc'])) {
                                                                        echo $adminInfo['password_imc'];
                                                                    } ?>">
            </div>
        </div>

        <div class="sauvegarder">
            <input type="submit" name="sauvegarder" value="Sauvegarder les changements" <?php if (!isset($nom) || !isset($adresse_mail) || !isset($mdp) || !isset($photo)) {
                                                                                            echo 'disabled';
                                                                                        }  ?>>
        </div>


    </form>



</body>

</html>