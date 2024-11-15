<?php include("C:/wamp64/www/Ivoire_Medical_Center/IMC/config/db_connect.php"); 

/* traitement suppression */
if (isset($_GET['action']) && isset($_GET['id']) && $_GET['action'] == 'supprimer') {
    $id_patient = $_GET['id'];
    $req = $bdd->prepare("DELETE FROM patient WHERE id_patient = ?");
    $req->execute([$id_patient]);

    header("Location: ?page=patient");
    exit();
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Document</title>
    <link rel="stylesheet" href="/Ivoire_Medical_Center/IMC/admin_cm/assets/css/infirmier/patient.css">

</head>

<body>
    <section id="list_patient">
        <h4>Liste des patients</h4>
        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nom complet</th>
                    <th>Age</th>
                    <th>Sexe</th>
                    <th>Adresse Mail</th>
                    <th>Téléphone</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <?php
            $rq = $bdd->prepare("SELECT * FROM patient");
            $rq->execute();
            $lignes = $rq->fetchAll();
            if ($lignes) {
                foreach ($lignes as $ligne) { ?>
                    <tbody>
                        <tr style="text-align:center;">
                            <td><?php echo $ligne["id_patient"]; ?></td>
                            <td><?php echo $ligne["nom_patient"] . " " . $ligne["prenom_patient"]; ?></td>
                            <td><?php echo $ligne["age_patient"]; ?></td>
                            <td><?php echo $ligne["sexe_patient"]; ?></td>
                            <td><?php echo $ligne["adresse_patient"]; ?></td>
                            <td><?php echo $ligne["tel_patient"]; ?></td>
                            <td style="display:flex; gap: 5px;  justify-content:center; padding: 20px;">
                                <a href="?page=patient&id=<?php echo $ligne["id_patient"]; ?>&action=afficher">Dossier medical</a>
                                <a href="?page=patient&id=<?php echo $ligne["id_patient"]; ?>&action=supprimer">Supprimer</a>
                            </td>
                        </tr>
                    </tbody>
            <?php }
            } ?>

        </table>
    </section>
</body>

</html>