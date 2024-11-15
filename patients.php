<?php


include __DIR__ . '/www/config/db_connect.php';


// Ajout du code de suppression
if (isset($_POST['delete_patient'])) {
    $id_patient = $_POST['id_patient'];
    try {
        $delete_query = $connexion->prepare("DELETE FROM patient WHERE id_patient = :id");
        $delete_query->execute(['id' => $id_patient]);
        header("Location: secretaire_dashboard.php?page=patients");
        exit();
    } catch (PDOException $e) {
        echo "Erreur lors de la suppression : " . $e->getMessage();
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
    <link rel="stylesheet" href="css/patient.css">

</head>

<body>
    <section id="list_patient">
        <h4>Liste des patients</h4>
        <table>
            <thead>
                <tr>     
                    <th>Nom complet</th>
                    <th>Âge</th>
                    <th>Sexe</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <?php
            $rq_patient = $connexion->prepare("SELECT id_patient, nom_patient, prenom_patient,age_patient, sexe_patient, adresse_patient, tel_patient FROM patient ORDER BY nom_patient");
            $rq_patient->execute();
            $patients = $rq_patient->fetchAll();
            if ($patients) {
                foreach ($patients as $patient) { ?>
                    <tr>      
                        <td><?php echo $patient["nom_patient"] . " " . $patient["prenom_patient"]; ?></td>
                        <td><?php echo $patient["age_patient"]; ?></td>
                        <td><?php echo $patient["sexe_patient"]; ?></td>
                        <td><?php echo $patient["adresse_patient"]; ?></td>
                        <td><?php echo $patient["tel_patient"]; ?></td>
                        <td>
                            <form method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce patient ?');">
                                <input type="hidden" name="id_patient" value="<?php echo $patient["id_patient"]; ?>">
                                <button type="submit" name="delete_patient" class="action-btn delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php }
            } ?>
            </tbody>
        </table>
    </section>
</body>

</html>