<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/PageInscription.css">
    <title>Connexion</title>
</head>
<body>
    <div class="container">
        <div class="left-side">
            <div class="headline">
                Rejoignez notre communauté de <span class="highlight">professionnels de santé</span> et de
                <span class="highlight">patients</span> en quelques clics !
            </div>
            <div class="illustration"></div>
        </div>
        <div class="right-side">
            <div class="logo">
                <img src="../IMC/img/logo.jpg" alt="IMC">
            </div>

            <h1 class="welcome-text">Connectez-vous à <span class="highlight">IMC</span></h1>
            <div class="register-prompt">
                Pas encore membre ? <a href="PageInscription.php" class="register-link">Inscrivez-vous ici</a>
            </div>

            <?php if (isset($_SESSION['error'])) { ?>
                <div class="error-message"><?php echo $_SESSION['error']; ?></div>
                <?php unset($_SESSION['error']); ?>
            <?php } ?>

            <form action="traitement_connexion.php" method="post">
                <div class="form-group">
                    <input type="email" name="email" placeholder="Exemple : email@exemple.com" required>
                    <input type="password" name="password" placeholder="Mot de passe" required>
                </div>

                <button type="submit" class="login-button">Se connecter</button>

                <div class="divider">Ou connectez-vous avec</div>

                <div class="social-buttons">
                    <a href="#" class="social-button">
                        <ion-icon name="logo-facebook"></ion-icon>
                    </a>

                    <a href="#" class="social-button">
                        <ion-icon name="logo-google"></ion-icon>
                    </a>

                    <a href="#" class="social-button">
                        <ion-icon name="logo-apple"></ion-icon>
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
</body>
</html>