<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/param_styles.css">
</head>

<body>




    <h2 style="margin-left: 200px;" id="textp">Mon profil</h2>
    <p style="margin-left: 200px;">Gérez les paramètres de votre profil</p>

    <form action="" method="post">

        <div class="top">
            <div class="profil">
                <img src="../assets/images/img_profil1.png" alt="">
                <div class="submit-container">
                    <input type="submit" name="changer" value="Changer la photo">
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
                <img src="../assets/images/imgLock.png" alt="">
            </div>
        </div>

        <div class="infos">

            <div class="nom">
                <label for="nom">Nom: </label>
                <input type="text" name="nom" id="nom">
            </div>

            <div class="mail">
                <label for="mail">Email: </label>
                <input type="email" name="mail" id="mail">
            </div>

            <div class="mdp">
                <label for="mdp">Mot de passe: </label>
                <input type="password" name="mdp" id="mdp">
            </div>
        </div>

        <div class="sauvegarder">
            <input type="submit" name="sauvegarder" value="Sauvegarder les changements">
        </div>


    </form>



</body>

</html>