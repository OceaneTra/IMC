<?php include("C:/wamp64/www/Ivoire_Medical_Center/IMC/config/db_connect.php"); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Document</title>
    <link rel="stylesheet" href="/Ivoire_Medical_Center/IMC/admin_cm/assets/css/infirmier/staffMedecin.css">
</head>

<body>

    <section id="list_medecin">
        <h4>Liste des medecins</h4>
        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nom complet</th>
                    <th>Adresse mail</th>
                    <th>Spécialité</th>
                    <th>Téléphone</th>
                </tr>
            </thead>

            <?php
            $rq = $bdd->prepare("SELECT * FROM medecin");
            $rq->execute();
            $lignes = $rq->fetchAll();
            if ($lignes) {
                foreach ($lignes as $ligne) { ?>
                    <tbody>
                        <tr style="text-align:center;">
                            <td><?php echo $ligne["id_medecin"]; ?></td>
                            <td><?php echo $ligne["nom_medecin"] . " " . $ligne["prenom_medecin"]; ?></td>
                            <td><?php echo $ligne["email_medecin"]; ?></td>
                            <td><?php echo $ligne["specialite"]; ?></td>
                            <td><?php echo $ligne["tel_medecin"]; ?></td>
                        </tr>
                    </tbody>
            <?php }
            } ?>

        </table>
    </section>

</body>

</html>