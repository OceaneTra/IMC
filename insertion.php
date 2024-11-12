<?php
session_start();

include __DIR__ . '/www/config/db_connect.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire
    $nom = htmlspecialchars($_POST['Nom']);
    $prenom = htmlspecialchars($_POST['Prenom']);
    $email = htmlspecialchars($_POST['Email']);
    $telephone = htmlspecialchars($_POST['Telephone']);
    $password = password_hash($_POST['Password'], PASSWORD_DEFAULT);
    $type_utilisateur = htmlspecialchars($_POST['type_utilisateur']);

    try {
        switch ($type_utilisateur) {
            case 'medecin':
                $sql = "INSERT INTO medecin (nom_medecin, prenom_medecin, tel_medecin, email_medecin, specialite, mot_de_passe) 
                        VALUES (:nom, :prenom, :tel, :email, '', :password)";
                $stmt = $connexion->prepare($sql);
                $stmt->execute([
                    ':nom' => $nom,
                    ':prenom' => $prenom,
                    ':tel' => $telephone,
                    ':email' => $email,
                    ':password' => $password
                ]);
                $message = "Médecin enregistré avec succès!";
                break;

            case 'secretaire':
                $sql = "INSERT INTO secretaire (nom_secretaire, prenom_secretaire, tel_secretaire, email_secretaire, mot_de_passe) 
                        VALUES (:nom, :prenom, :tel, :email, :password)";
                $stmt = $connexion->prepare($sql);
                $stmt->execute([
                    ':nom' => $nom,
                    ':prenom' => $prenom,
                    ':tel' => $telephone,
                    ':email' => $email,
                    ':password' => $password
                ]);
                $message = "Secrétaire enregistré avec succès!";
                break;

            case 'infirmier':
                $sql = "INSERT INTO infirmier (nom_infirmier, prenom_infirmier, tel_infirmier, email_infirmier, mot_de_passe) 
                        VALUES (:nom, :prenom, :tel, :email, :password)";
                $stmt = $connexion->prepare($sql);
                $stmt->execute([
                    ':nom' => $nom,
                    ':prenom' => $prenom,
                    ':tel' => $telephone,
                    ':email' => $email,
                    ':password' => $password
                ]);
                $message = "Infirmier enregistré avec succès!";
                break;

            default:
                throw new Exception("Type d'utilisateur non reconnu");
        }

        $_SESSION['message'] = $message;
        header("Location: PageConnexion.php");
        exit();

    } catch (PDOException $e) {
        $_SESSION['error'] = "Erreur lors de l'inscription : " . $e->getMessage();
        header("Location: PageInscription.php");
        exit();
    }
}

// Ajout de débogage
else {
    $_SESSION['error'] = "Le formulaire n'a pas été soumis en POST";
    header("Location: PageInscription.php");
    exit();
}
?>