<?php include("C:/wamp64/www/Ivoire_Medical_Center/IMC/config/db_connect.php"); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/Ivoire_Medical_Center/IMC/admin_cm/assets/css/infirmier/parametres.css">
</head>

<body>

    <body>
        <form  method="post" action="" class="container">
            <h1>Mon compte</h1>

            <div class="section">

                <div class="form-row">
                    <div class="form-group">
                        <label for="nom">Nom</label>
                        <input type="text" name="nom">
                    </div>
                    <div class="form-group">
                        <label for="prenoms">Prénoms</label>
                        <input type="text" name="prenoms">
                    </div>
                </div>


                <div class="form-group">
                    <label>Photo</label>
                    <div class="photo-section">
                        <div class="photo-preview">
                            <img src="/api/placeholder/48/48" alt="Profile photo">
                        </div>
                        <div class="submit-group">
                            <input type="submit" class="change" value="Changer la photo">
                            <input type="submit" class="delete" value="Supprimer cette photo">
                        </div>
                    </div>
                </div>


            </div>

            <div class="section">
                <h2>Informations personnelles</h2>
                <div class="subtitle">Vos informations personnelles sont traités avec le plus grand soin. Nous utilisons des technologies avancées de sécurité pour assurer la confidentialité et l'intégrité de vos données.</div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Adresse mail</label>
                        <input type="email">
                    </div>
                    <div class="form-group">
                        <label>Numéro de téléphone</label>
                        <input type="text">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Votre spécialité</label>
                        <input type="text">
                    </div>
                    <div class="form-group">
                        <label>Mot de passe</label>
                        <input type="password">
                    </div>
                </div>
            </div>

            <div class="creation-info">
                Ne partagez jamais vos informations personnelles avec qui que ce soit !
            </div>

            <div class="action">
                <input type="submit" name="sauvegarder" value="Sauvegarder les modifications">
            </div>
        </form>
    </body>

</html>
</body>

</html>