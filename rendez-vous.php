<?php
include __DIR__ . '/www/config/db_connect.php';

// Code de suppression du rendez-vous
if (isset($_POST['delete_rdv'])) {
    $id_rdv = $_POST['id_rdv'];
    try {
        $delete_query = $connexion->prepare("DELETE FROM rendezvous WHERE id_rdv = :id");
        $delete_query->execute(['id' => $id_rdv]);
        header("Location: secretaire_dashboard.php?page=rendez-vous");
        exit();
    } catch (PDOException $e) {
        echo "Erreur lors de la suppression : " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Rendez-vous</title>
    <link rel="stylesheet" href="css/rdv.css">
</head>

<body>
    <section id="list_rdv">
        <h4>Liste des Rendez-vous</h4>
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Heure</th>
                    <th>Patient</th>
                    
                </tr>
            </thead>

            <?php
            // Récupérer les rendez-vous et les afficher
            $rq_rdv = $connexion->prepare("SELECT r.id_rdv, r.date_rdv, r.heure_rdv, p.nom_patient, p.prenom_patient 
                                           FROM rdv r
                                           JOIN patient p ON r.id_patient = p.id_patient
                                           ORDER BY r.date_rdv, r.heure_rdv");
            $rq_rdv->execute();
            $rdvs = $rq_rdv->fetchAll();
            if ($rdvs) {
                foreach ($rdvs as $rdv) { ?>
                    <tr>
                        <td><?php echo date('d/m/Y', strtotime($rdv["date_rdv"])); ?></td>
                        <td><?php echo date('H:i', strtotime($rdv["heure_rdv"])); ?></td>
                        <td><?php echo $rdv["nom_patient"] . " " . $rdv["prenom_patient"]; ?></td>
                       
                    </tr>
                <?php }
            } ?>
        </table>
    </section>
</body>

</html>
