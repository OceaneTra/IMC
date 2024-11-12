<?php
session_start();
include __DIR__ . '/www/config/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = htmlspecialchars($_POST['email']);
    $password = $_POST['password'];

    try {
        // Vérifier dans la table médecin
        $sql = "SELECT * FROM medecin WHERE email_medecin = :email";
        $stmt = $connexion->prepare($sql);
        $stmt->execute([':email' => $email]);
        $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$utilisateur) {
            // Vérifier dans la table secrétaire
            $sql = "SELECT * FROM secretaire WHERE email_secretaire = :email";
            $stmt = $connexion->prepare($sql);
            $stmt->execute([':email' => $email]);
            $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);
        }

        if (!$utilisateur) {
            // Vérifier dans la table infirmier
            $sql = "SELECT * FROM infirmier WHERE email_infirmier = :email";
            $stmt = $connexion->prepare($sql);
            $stmt->execute([':email' => $email]);
            $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);
        }

        if ($utilisateur) {
            // Vérifier le mot de passe
            if (password_verify($password, $utilisateur['mot_de_passe'])) {
                // Connexion réussie
                $_SESSION['utilisateur_id'] = $utilisateur['id_medecin'] ?? $utilisateur['id_secretaire'] ?? $utilisateur['id_infirmier'];
                $_SESSION['utilisateur_type'] = isset($utilisateur['id_medecin']) ? 'medecin' :
                                               (isset($utilisateur['id_secretaire']) ? 'secretaire' : 'infirmier');
                $_SESSION['utilisateur_nom'] = $utilisateur['nom_' . $_SESSION['utilisateur_type']] . ' ' .  $utilisateur['prenom_' . $_SESSION['utilisateur_type']];

                // Redirection vers la page d'accueil après connexion
                header("Location: dashboard.php");
                exit();
            } else {
                $_SESSION['error'] = "Mot de passe incorrect";
                header("Location: PageConnexion.php");
                exit();
            }
        } else {
            $_SESSION['error'] = "Email non trouvé";
            header("Location: PageConnexion.php");
            exit();
        }
    } catch (PDOException $e) {
        $_SESSION['error'] = "Erreur de connexion : " . $e->getMessage();
        header("Location: PageConnexion.php");
        exit();
    }
} else {
    header("Location: PageConnexion.php");
    exit();
}