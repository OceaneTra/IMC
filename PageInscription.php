<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/PageInscription.css">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <title>Inscription</title>
</head>
<body>
    <div class="container">
        <div class="left-side">
            <div class="headline">
                Rejoignez notre communauté de <span class="highlight">professionnels de santé</span> et de<br>
                <span class="highlight">patients</span> en quelques clics !
            </div>
            <div class="illustration"></div>
        </div>
        <div class="right-side">
            <div class="logo">
                <img src="../IMC/img/logo.jpg" alt="IMC">
            </div>
            
            <h1 class="welcome-text">Créez votre compte <span class="highlight">IMC</span></h1>
            <div class="register-prompt">
                Déjà membre ? <a href="PageConnexion.php" class="register-link">Connectez-vous ici</a>
            </div>
            
            <form>
                <div class="form-group">
                    <input type="text" placeholder="Nom" required>
                    <input type="text" placeholder="Prénom" required>
                    <input type="email" placeholder="Exemple : email@exemple.com" required>
                    <input type="password" placeholder="Créez votre mot de passe" required>
                    <input type="password" placeholder="Confirmez votre mot de passe" required>
                    <select required>
                        <option value="" disabled selected>Je suis un...</option>
                        <option value="patient">Patient</option>
                        <option value="medecin">Médecin</option>
                        <option value="autre">Autre professionnel de santé</option>
                    </select>
                </div>
                
                <a href="PageConnexion.php" class="login-button">Créer mon compte</a>
                
                <div class="divider">Ou inscrivez-vous avec</div>
                
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
                
                <div class="terms">
                    En créant votre compte, vous acceptez nos <a href="#">conditions d'utilisation</a> et<br>
                    notre <a href="#">politique de confidentialité</a>.
                </div>
            </form>
        </div>
    </div>
</body>
</html>