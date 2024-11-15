<?php 

include __DIR__ . '/www/config/db_connect.php'; 

// Vérifiez si l'utilisateur est connecté et est une secrétaire
if (!isset($_SESSION['utilisateur_id']) || $_SESSION['utilisateur_type'] !== 'infirmier') {
    header("Location: PageConnexion.php");
    exit();
}

$user_id = $_SESSION['utilisateur_id'];

// Récupération des données actuelles de la secrétaire
$sql = "SELECT nom_infirmier as nom, prenom_infirmier as prenom, tel_infirmier as telephone, email_infirmier as email, photo, mot_de_passe 
        FROM infirmier WHERE id_infirmier = :id";
$stmt = $connexion->prepare($sql);
$stmt->execute([':id' => $user_id]);
$utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);

$nom_utilisateur = $utilisateur['nom'] ?? '';
$prenom_utilisateur = $utilisateur['prenom'] ?? '';
$telephone_utilisateur = $utilisateur['telephone'] ?? '';
$email_utilisateur = $utilisateur['email'] ?? '';
$photo_utilisateur = $utilisateur['photo'] ?? 'default.jpg';
$mdp_actuel = $utilisateur['mot_de_passe'] ?? '';

$message = "";

// Traitement de la soumission du formulaire pour la mise à jour
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenoms']);
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
            $photo = $photo_utilisateur;
        }
    } else {
        $photo = $photo_utilisateur;
    }

    // Vérification et hachage du nouveau mot de passe
    if ($mdp_actuel_form && password_verify($mdp_actuel_form, $mdp_actuel)) {
        if ($nouveau_mdp === $confirmer_mdp) {
            $nouveau_mdp_hash = password_hash($nouveau_mdp, PASSWORD_DEFAULT);
        } else {
            $message = "Les nouveaux mots de passe ne correspondent pas.";
        }
    } elseif ($mdp_actuel_form) {
        $message = "Mot de passe actuel incorrect.";
    }

   
    if (!$message) { 
        $sql = "UPDATE infirmier SET nom_infirmier = :nom, prenom_infirmier = :prenom, tel_infirmier = :telephone, 
                email_infirmier = :email, photo = :photo";

       
        if (!empty($nouveau_mdp_hash)) {
            $sql .= ", mot_de_passe = :nouveau_mdp";
        }

        $sql .= " WHERE id_infirmier = :id";
        $stmt = $connexion->prepare($sql);

        $params = [
            ':nom' => $nom,
            ':prenom' => $prenom,
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
        header("Location: parametres_infirmier.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paramètres</title>
    <link rel="stylesheet" href="css/parametres.css">
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
                        <img src="<?php echo $photo_utilisateur ?>" alt="Profile photo">
                    </div>
                    <input type="file" name="photo">
                </div>
            </div>
        </div>

        <div class="section">
            <h2>Informations personnelles</h2>
            <div class="form-row">
                <div class="form-group">
                    <label for="email">Adresse mail</label>
                    <input type="email" name="email" value="<?= htmlspecialchars($email_utilisateur) ?>" required>
                </div>
                <div class="form-group">
                    <label for="telephone">Numéro de téléphone</label>
                    <input type="text" name="telephone" value="<?= htmlspecialchars($telephone_utilisateur) ?>" required>
                </div>
            </div>
        </div>

        <div class="section">
            <h2>Changer le mot de passe</h2>
            <div class="form-group">
                <label for="mdp_actuel">Mot de passe actuel</label>
                <input type="password" name="mdp_actuel" required>
            </div>
            <div class="form-group">
                <label for="nouveau_mdp">Nouveau mot de passe</label>
                <input type="password" name="nouveau_mdp" required>
            </div>
            <div class="form-group">
                <label for="confirmer_mdp">Confirmer le nouveau mot de passe</label>
                <input type="password" name="confirmer_mdp" required>
            </div>
        </div>

        <div class="action">
            <input type="submit" name="sauvegarder" value="Sauvegarder les modifications">
        </div>
    </form>
</body>
</html>
