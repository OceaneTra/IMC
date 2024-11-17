<?php

include __DIR__ . '/www/config/db_connect.php';

// Vérifiez si l'utilisateur est connecté et est un médecin
if (!isset($_SESSION['utilisateur_id']) || $_SESSION['utilisateur_type'] !== 'medecin') {
    header("Location: PageConnexion.php");
    exit();
}

$user_id = $_SESSION['utilisateur_id'];

// Récupération des données actuelles du médecin
$sql = "SELECT nom_medecin AS nom, prenom_medecin AS prenom, specialite, tel_medecin AS telephone, email_medecin AS email, photo, mot_de_passe 
        FROM medecin WHERE id_medecin = :id";
$stmt = $connexion->prepare($sql);
$stmt->execute([':id' => $user_id]);
$utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);

$nom_utilisateur = $utilisateur['nom'] ?? '';
$prenom_utilisateur = $utilisateur['prenom'] ?? '';
$specialite_utilisateur = $utilisateur['specialite'] ?? '';
$telephone_utilisateur = $utilisateur['telephone'] ?? '';
$email_utilisateur = $utilisateur['email'] ?? '';
$photo_utilisateur = $utilisateur['photo'] ?? 'default.jpg';
$mdp_actuel = $utilisateur['mot_de_passe'] ?? '';

$message = "";

// Traitement de la soumission du formulaire pour la mise à jour
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenoms']);
    $specialite = htmlspecialchars($_POST['specialite']);
    $telephone = htmlspecialchars($_POST['telephone']);
    $email = htmlspecialchars($_POST['email']);
    $mdp_actuel_form = htmlspecialchars($_POST['mdp_actuel']);
    $nouveau_mdp = htmlspecialchars($_POST['nouveau_mdp']);
    $confirmer_mdp = htmlspecialchars($_POST['confirmer_mdp']);

    // Gestion de l'image
    if (isset($_FILES['photo']) && $_FILES['photo']['size'] > 0) {
        $fileTmpPath = $_FILES['photo']['tmp_name'];
        $fileName = $_FILES['photo']['name'];
        $targetDirectory = "img/";
        $targetFile = $targetDirectory . basename($fileName);

        if (move_uploaded_file($fileTmpPath, $targetFile)) {
            $photo = $targetFile;
        } else {
            $photo = $photo_utilisateur;  // Conserver la photo actuelle si le téléchargement échoue
        }
    } else {
        $photo = $photo_utilisateur;
    }

    // Vérification et hachage du mot de passe
    if ($mdp_actuel_form && password_verify($mdp_actuel_form, $mdp_actuel)) {
        if ($nouveau_mdp === $confirmer_mdp) {
            $nouveau_mdp_hash = password_hash($nouveau_mdp, PASSWORD_DEFAULT);
        } else {
            $message = "Les nouveaux mots de passe ne correspondent pas.";
        }
    } elseif ($mdp_actuel_form) {
        $message = "Mot de passe actuel incorrect.";
    }

    // Mise à jour des informations dans la base de données
    if (!$message) { // Exécute uniquement si aucun message d'erreur
        $sql = "UPDATE medecin SET nom_medecin = :nom, prenom_medecin = :prenom, specialite = :specialite, tel_medecin = :telephone, 
                email_medecin = :email, photo = :photo";

        // Ajouter le nouveau mot de passe si haché
        if (!empty($nouveau_mdp_hash)) {
            $sql .= ", mot_de_passe = :nouveau_mdp";
        }

        $sql .= " WHERE id_medecin = :id";
        $stmt = $connexion->prepare($sql);

        $params = [
            ':nom' => $nom,
            ':prenom' => $prenom,
            ':specialite' => $specialite,
            ':telephone' => $telephone,
            ':email' => $email,
            ':photo' => $photo,
            ':id' => $user_id
        ];

        if (!empty($nouveau_mdp_hash)) {
            $params[':nouveau_mdp'] = $nouveau_mdp_hash;
        }

        $stmt->execute($params);
        $_SESSION['message'] = "Profil et mot de passe mis à jour avec succès!";
        header("Location: parametres_medecin.php");  // Reste sur la même page après la mise à jour
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paramètres du médecin</title>
    <link rel="stylesheet" href="css/parametres_medecin.css">
</head>

<body>

    <form method="post" enctype="multipart/form-data" class="container">
        <h1>Mon compte</h1>

        <!-- Message de retour -->
        <?php if ($message): ?>
            <p><?= htmlspecialchars($message) ?></p>
        <?php endif; ?>

        <div class="section">
            <div class="form-row">
                <div class="form-group">
                    <label for="nom">Nom</label>
                    <input type="text" name="nom" value="<?= htmlspecialchars($nom_utilisateur) ?>" required>
                </div>
                <div class="form-group">
                    <label for="prenoms">Prénoms</label>
                    <input type="text" name="prenoms" value="<?= htmlspecialchars($prenom_utilisateur) ?>" required>
                </div>
            </div>

            <div class="form-group">
                <label>Photo</label>
                <div class="photo-section">
                    <div class="photo-preview">
                        <img src="<?= htmlspecialchars($photo_utilisateur) ?>" alt="Photo de profil">
                    </div>

                    <!-- Champ caché pour le téléchargement de la photo -->
                    <input type="file" name="photo" id="photo" accept="image/*" style="display: none;" onchange="previewImage(event)">

                    <!-- Bouton pour ouvrir l'explorateur de fichiers -->
                    <div class="submit-group">
                        <input type="button" class="change" value="Changer la photo" onclick="document.getElementById('photo').click();">
                    </div>
                </div>
            </div>

            <script>
                // Fonction pour prévisualiser l'image sélectionnée
                function previewImage(event) {
                    var reader = new FileReader();
                    reader.onload = function() {
                        var output = document.querySelector('.photo-preview img');
                        output.src = reader.result;
                    };
                    reader.readAsDataURL(event.target.files[0]);
                }
            </script>
        </div>

        <div class="section">
            <h2>Informations personnelles</h2>
            <div class="form-row">
                <div class="form-group">
                    <label>Adresse mail</label>
                    <input type="email" name="email" value="<?= htmlspecialchars($email_utilisateur) ?>">
                </div>
                <div class="form-group">
                    <label>Numéro de téléphone</label>
                    <input type="text" name="telephone" value="<?= htmlspecialchars($telephone_utilisateur) ?>" >
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Votre spécialité</label>
                    <input type="text" name="specialite" value="<?= htmlspecialchars($specialite_utilisateur) ?>" >
                </div>
                <div class="form-group">
                    <label>Mot de passe actuel</label>
                    <input type="password" name="mdp_actuel" >
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label> Nouveau mot de passe</label>
                    <input type="password" name="nouveau_mdp">
                </div>
                <div class="form-group">
                    <label> Confirmer le mot de passe</label>
                    <input type="password" name="confirmer_mdp">
                </div>
            </div>
        </div>

        <div class="action">
            <input type="submit" name="sauvegarder" value="Sauvegarder les modifications">
        </div>
    </form>

</body>

</html>