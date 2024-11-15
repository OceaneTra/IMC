<?php
session_start();
include __DIR__ . '/www/config/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = htmlspecialchars($_POST['email']);
    $password = $_POST['password'];

    try {
        
        $sql = "SELECT * FROM medecin WHERE email_medecin = :email";
        $stmt = $connexion->prepare($sql);
        $stmt->execute([':email' => $email]);
        $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$utilisateur) {
            
            $sql = "SELECT * FROM secretaire WHERE email_secretaire = :email";
            $stmt = $connexion->prepare($sql);
            $stmt->execute([':email' => $email]);
            $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);
        }

        if (!$utilisateur) {
           
            $sql = "SELECT * FROM infirmier WHERE email_infirmier = :email";
            $stmt = $connexion->prepare($sql);
            $stmt->execute([':email' => $email]);
            $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);
        }

        if ($utilisateur) {
            
            if (password_verify($password, $utilisateur['mot_de_passe'])) {
               
                $_SESSION['utilisateur_id'] = $utilisateur['id_medecin'] ?? $utilisateur['id_secretaire'] ?? $utilisateur['id_infirmier'];
                $_SESSION['utilisateur_type'] = isset($utilisateur['id_medecin']) ? 'medecin' :
                                               (isset($utilisateur['id_secretaire']) ? 'secretaire' : 'infirmier');
                $_SESSION['utilisateur_nom'] = $utilisateur['nom_' . $_SESSION['utilisateur_type']] . ' ' .  $utilisateur['prenom_' . $_SESSION['utilisateur_type']];

                 // Redirection vers l'interface spécifique selon le rôle
                 if ($_SESSION['utilisateur_type'] == 'medecin') {
                    header("Location: medecin_dashboard.php");
                } elseif ($_SESSION['utilisateur_type'] == 'secretaire') {
                    header("Location: secretaire_dashboard.php");
                } elseif ($_SESSION['utilisateur_type'] == 'infirmier') {
                    header("Location: infirmier_dashboard.php");
                }
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