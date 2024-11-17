<?php

include __DIR__ . '/www/config/db_connect.php';


// Vérification de la session utilisateur
if (!isset($_SESSION['utilisateur_id']) || !isset($_SESSION['utilisateur_type'])) {
    header("Location: PageConnexion.php");
    exit();
}

$user_id = $_SESSION['utilisateur_id'];
$user_type = $_SESSION['utilisateur_type'];

// Optimisation de la requête SQL avec un switch
$sql = "";
switch ($user_type) {
    case 'medecin':
        $sql = "SELECT nom_medecin as nom, prenom_medecin as prenom, photo FROM medecin WHERE id_medecin = :id";
        break;
    case 'secretaire':
        $sql = "SELECT nom_secretaire as nom, prenom_secretaire as prenom, photo FROM secretaire WHERE id_secretaire = :id";
        break;
    case 'infirmier':
        $sql = "SELECT nom_infirmier as nom, prenom_infirmier as prenom, photo FROM infirmier WHERE id_infirmier = :id";
        break;
}

$stmt = $connexion->prepare($sql);
$stmt->execute([':id' => $user_id]);
$utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);

$nom_utilisateur = $utilisateur['nom'] ?? '';
$prenom_utilisateur = $utilisateur['prenom'] ?? '';
$photo_utilisateur = $utilisateur['photo'] ?? 'default.jpg';




// Traitement des actions sur les rendez-vous
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['accept'])) {
        $id_rdv = $_POST['accept'];
        $stmt = $connexion->prepare("UPDATE rdv SET statut = 'accepté' WHERE id_rdv = :id");
        $stmt->execute([':id' => $id_rdv]);
    } elseif (isset($_POST['reject'])) {
        $id_rdv = $_POST['reject'];
        $stmt = $connexion->prepare("UPDATE rdv SET statut = 'refusé' WHERE id_rdv = :id");
        $stmt->execute([':id' => $id_rdv]);
    }
}




?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Document</title>
    <link rel="stylesheet" href="css/dash.css">
</head>

<body>
    <div class="cards-container">
        <div class="card" style="background: #f4f0fe;">
            <?php
            $sql = $connexion->prepare("SELECT COUNT(*) FROM patient ");
            $sql->execute();
            $nb_patients = $sql->fetchColumn();
            ?>
            <h3 class="title"><i class="fa-solid fa-user"></i> Patients</h3>
            <h4 class="number"><?= $nb_patients; ?> </h4>
            <div class="sub">
                <h5 class="rate">Last 7 days </h5> <span><i class="fa-solid fa-chart-line"></i>24%</span>
            </div>
        </div>

        <div class="card" style="background: #eef9fb;">
            <?php
            $sql = $connexion->prepare("SELECT COUNT(*) FROM rdv WHERE statut = 'en attente' ");
            $sql->execute();
            $rdv_waiting = $sql->fetchColumn();
            ?>
            <h3 class="title"><i class="fa-solid fa-hourglass-start"></i>Rendez-vous en attente</h3>
            <h4 class="number"><?= $rdv_waiting; ?></h4>
            <div class="sub">
                <h5 class="rate">Last 7 days </h5> <span><i class="fa-solid fa-chart-line"></i>24%</span>
            </div>
        </div>

        <div class="card" style="background: #f3fdf4;">
            <?php
            $sql = $connexion->prepare("SELECT COUNT(*) FROM  rdv WHERE statut = 'accepté' ");
            $sql->execute();
            $rdv_accept = $sql->fetchColumn();
            ?>
            <h3 class="title"><i class="fa-solid fa-calendar-check"></i>Rendez-vous acceptés</h3>
            <h4 class="number"><?= $rdv_accept; ?></h4>
            <div class="sub">
                <h5 class="rate">Last 7 days </h5> <span><i class="fa-solid fa-chart-line"></i>24%</span>
            </div>
        </div>

        <div class="card" style="background: #fff6ed;">
            <?php
            $sql = $connexion->prepare("SELECT COUNT(*) FROM  rdv WHERE statut = 'refusé' ");
            $sql->execute();
            $rdv_reject = $sql->fetchColumn();
            ?>
            <h3 class="title"><i class="fa-solid fa-ban"></i>Rendez-vous Rejetés</h3>
            <h4 class="number"><?= $rdv_reject; ?></h4>
            <div class="sub">
                <h5 class="rate">Last 7 days </h5> <span><i class="fa-solid fa-chart-line"></i>24%</span>
            </div>
        </div>
    </div>



    <section id="list">
        <h4>Liste des patients</h4>
        <table>
            <thead>
                <tr>
                    
                    <th>Nom complet</th>
                    <th>Age</th>
                    <th>Sexe</th>
                    <th>Adresse Mail</th>
                    <th>Téléphone</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $stmt = $connexion->prepare("SELECT * FROM patient");
                $stmt->execute();
                $patients = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if ($patients) {
                    foreach ($patients as $patient) {
                        echo "<tr>
                           
                            <td>{$patient['nom_patient']} {$patient['prenom_patient']}</td>
                            <td>{$patient['age_patient']}</td>
                            <td>{$patient['sexe_patient']}</td>
                            <td>{$patient['adresse_patient']}</td>
                            <td>{$patient['tel_patient']}</td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>Aucun patient trouvé</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </section>

    <div id="rightbar">
        <div class="profil">
            <img src="<?php echo $photo_utilisateur ?>" alt="Profile">
            <div class="info">
                <h3 class="nom"><?= htmlspecialchars($nom_utilisateur) . ' ' . htmlspecialchars($prenom_utilisateur) ?></h3>
                <h5 class="fonction"><?= ucfirst($user_type) ?></h5>
            </div>
        </div>

        <section id="consultations">
    <h4>Liste des consultations</h4>
    <?php
    // Requête pour récupérer les rendez-vous en attente avec les informations des patients
    $stmt = $connexion->prepare("
        SELECT rdv.id_rdv, rdv.date_rdv, patient.nom_patient, patient.prenom_patient 
        FROM rdv 
        INNER JOIN patient ON rdv.id_patient = patient.id_patient
        WHERE rdv.statut = 'en attente'
    ");
    $stmt->execute();
    $consultations = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($consultations) {
        foreach ($consultations as $consultation) {
            echo "<div class='card-patient'>
                <div class='infos_pat'>
                    <img src='../IMC/img/pp1.avif' width='80px' height='80px' alt='Profile'>
                    <div class='info_pat'>
                        <h3 class='nom_pat'>{$consultation['nom_patient']} {$consultation['prenom_patient']}</h3>
                        <h5 class='age_pat'> {$consultation['date_rdv']}</h5>
                    </div>
                </div>
                <div class='button-container'>
                    <form method='POST'>
                        <button type='submit' name='reject' value='{$consultation['id_rdv']}'>Rejeter</button>
                        <button type='submit' name='accept' value='{$consultation['id_rdv']}'>Accepter</button>
                    </form>
                </div>
            </div>";
        }
    } else {
        echo "<p>Aucun rendez-vous en attente.</p>";
    }
    ?>
</section>


</body>


</html>