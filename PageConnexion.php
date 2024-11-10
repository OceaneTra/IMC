<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/PageInscription.css">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <title>Connexion</title>
</head>

<body>
    <div class="container">
        <div class="left-side">
            <div class="headline">
                Facilitez la connexion entre le <span class="highlight">personnel médical</span> et les<br>
                <span class="highlight"> patients </span> en ligne !
            </div>
            <div class="illustration"></div>
        </div>
        <div class="right-side">
            <div class="logo">
                <img src="../IMC/img/logo.jpg" alt="IMC">
            </div>

            <h1 class="welcome-text">Bonjour, bon retour sur <span class="highlight">IMC</span></h1>
            <div class="register-prompt">
                Nouveau sur notre plateforme ? <a href="PageInscription.php" class="register-link">Inscrivez-vous gratuitement</a>

            </div>


            <form>
                <div class="form-group">
                    <input type="email" placeholder="Exemple : email@exemple.com">
                    <input type="password" placeholder="Entrez votre mot de passe">
                </div>

                <a href="#" class="login-button">Se Connecter</a>

                <div class="forgot-password">
                    <a href="#">Vous avez oublié votre mot de passe ? </a>
                    <a href="#">Vous avez oublié votre mot de passe ? </a>
                </div>

                <div class="remember-device">
                    <input type="checkbox" id="remember">
                    <label for="remember">Se souvenir de cet appareil</label>
                </div>

                <div class="divider">Ou connectez-vous en utilisant</div>

                <div class="social-buttons">
                    <a href="#" class="social-button">
                        <ion-icon name="logo-facebook"></ion-icon> </a>

                    <a href="#" class="social-button">
                        <ion-icon name="logo-google"></ion-icon> </a>


                    <a href="#" class="social-button">
                        <ion-icon name="logo-apple"></ion-icon> </a>


                </div>

                <div class="terms">
                    En continuant, vous acceptez nos <a href="#">condition d'utilisation</a> et<br>
                    <a href="#">politique de confidentialité</a>.
                </div>
            </form>
        </div>
    </div>
</body>

</html>