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
                Rejoignez notre communauté de <span class="highlight">professionnels de santé</span> et de
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
            
            <form action="insertion.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <input type="text" name="Nom" placeholder="Nom" required>
                    <input type="text" name="Prenom" placeholder="Prénom" required>
                    <input type="text" name="Telephone" placeholder="Numero de telephone" required>
                    <input type="email" name="Email" placeholder="Exemple : email@exemple.com" required>
                    <input type="password" name="Password" placeholder="Créez votre mot de passe" required>
                    <select name="type_utilisateur" id="type_utilisateur" onchange="toggleSpecialityField()" required>
                        <option value="" disabled selected>Je suis un...</option>
                        <option value="medecin">Médecin</option>
                        <option value="infirmier">Infirmier</option>
                        <option value="secretaire">Secrétaire</option>
                    </select>

                    <!-- Champ spécialité caché par défaut -->
                    <input type="text" name="Specialite" id="specialite" placeholder="Spécialité" style="display: none;">
                </div>
                
                <button type="submit" class="login-button">Créer mon compte</button>
                
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

    <script>
        function toggleSpecialityField() {
            const typeUtilisateur = document.getElementById("type_utilisateur").value;
            const specialiteField = document.getElementById("specialite");

            // Afficher le champ spécialité uniquement pour "médecin" ou "infirmier"
            if (typeUtilisateur === "medecin") {
                specialiteField.style.display = "block";
                specialiteField.required = true; // Rendre le champ requis
            } else {
                specialiteField.style.display = "none";
                specialiteField.required = false; // Rendre le champ non requis
            }
        }
    </script>
</body>
</html>
