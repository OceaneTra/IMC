<?php 
include __DIR__ . '/www/config/db_connect.php';
 ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Document</title>
    <link rel="stylesheet" href="/css/staffMedecins.css">
</head>


<body>

    <div class="search">
        <?php if (isset($_POST['rechercher']) && !empty($_POST['rechercher'])) {
            $recherche = $_POST["rechercher"];
            $sql = $connexion->prepare("SELECT * FROM medecin WHERE nom_medecin LIKE ? OR specialite LIKE ? OR prenom_medecin LIKE ? ORDER BY nom_medecin ASC");
            $sql->execute(["%$recherche%", "%$recherche%", "%$recherche%"]);
            $all_medecins = $sql->fetchAll();
        } else {
            $sql = $connexion->prepare("SELECT * FROM medecin ORDER BY id_medecin ASC");
            $sql->execute();
            $all_medecins = $sql->fetchAll();
        }
        ?>


        <form action="" method="post">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="search" name="rechercher" placeholder="Rechercher un medecin">
        </form>

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
            foreach ($all_medecins as $user_medecin) {
            ?>
                <tr>
                    <td>
                        <?php echo $user_medecin['id_medecin']; ?>
                    </td>
                    <td>
                        <?php echo $user_medecin['nom_medecin'] . ' ' . $user_medecin['prenom_medecin']; ?>
                    </td>
                    <td>
                        <?php echo $user_medecin['email_medecin']; ?>
                    </td>
                    <td>
                        <?php echo $user_medecin['specialite']; ?>
                    </td>
                    <td>
                        <?php echo $user_medecin['tel_medecin']; ?>
                    </td>
                </tr>
            <?php } ?>

        </table>
    </section>

</body>

</html>