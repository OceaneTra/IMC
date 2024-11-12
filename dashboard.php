<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord</title>
</head>
<body>
    <?php
    session_start();
    if (!isset($_SESSION['utilisateur_id']) || !isset($_SESSION['utilisateur_type'])) {
        // L'utilisateur n'est pas connecté, le rediriger vers la page de connexion
        header("Location: PageConnexion.php");
        exit();
    }
    ?>

    <h1>Bienvenue, <?php echo $_SESSION['utilisateur_nom']; ?></h1>
    <p>Vous êtes connecté en tant que <?php echo $_SESSION['utilisateur_type']; ?>.</p>

    <?php
    if ($_SESSION['utilisateur_type'] === 'medecin') {
        // Afficher les fonctionnalités spécifiques aux médecins
        echo "<h2>Mes patients</h2>";
        echo "<ul>";
        // Récupérer la liste des patients du médecin depuis la base de données
        $sql = "SELECT * FROM patients WHERE id_medecin = :id_medecin";
        $stmt = $connexion->prepare($sql);
        $stmt->execute([':id_medecin' => $_SESSION['utilisateur_id']]);
        $patients = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($patients as $patient) {
            echo "<li>" . $patient['nom'] . " " . $patient['prenom'] . "</li>";
        }
        echo "</ul>";
    } elseif ($_SESSION['utilisateur_type'] === 'infirmier') {
        // Afficher les fonctionnalités spécifiques aux infirmiers
        // ...
    } elseif ($_SESSION['utilisateur_type'] === 'secretaire') {
        // Afficher les fonctionnalités spécifiques aux secrétaires
        // ...
    }
    ?>

    <a href="PageConnexion.php">Se déconnecter</a>
</body>
</html>