<?php include("C:/wamp64/www/Ivoire_Medical_Center/IMC/config/db_connect.php"); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Document</title>
    <link rel="stylesheet" href="/Ivoire_Medical_Center/IMC/admin_cm/assets/css/medecin/staffsMedecins.css">
</head>


<body>

    <div class="search">
        <?php if (isset($_POST['rechercher']) && !empty($_POST['rechercher'])) {
            $recherche = htmlspecialchars($_POST['rechercher']);
            $sql = $bdd->prepare("SELECT * FROM medecin WHERE nom_medecin LIKE ? OR specialite LIKE ? ORDER BY nom_medecin ASC ");
            $sql->execute(["%$recherche%"]);
            $all_medecins = $sql->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $sql = $bdd->query("SELECT * FROM medecin ORDER BY nom_medecin ASC ");
            $all_medecins = $sql->fetchAll(PDO::FETCH_ASSOC);
        }




        ?>


        <i class="fa-solid fa-magnifying-glass"></i>
        <input type="text" name="rechercher" placeholder="Rechercher un medecin...">
        <input type="submit" value="Recherche">


    </div>

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