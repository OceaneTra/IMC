<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Document</title>
    <link rel="stylesheet" href="/Ivoire_Medical_Center/IMC/admin_cm/assets/css/medecin/staffsInfirmiers.css">
</head>

<body>

    <div class="search">
        <?php if (isset($_POST['rechercher']) && !empty($_POST['rechercher'])) {
            $recherche = $_POST["rechercher"];
            $sql = $bdd->prepare("SELECT * FROM infirmier WHERE nom_infirmier LIKE ? OR prenom_infirmier LIKE ? ORDER BY nom_infirmier ASC");
            $sql->execute(["%$recherche%", "%$recherche%"]);
            $all_infirmiers = $sql->fetchAll();
        } else {
            $sql = $bdd->prepare("SELECT * FROM infirmier ORDER BY id_infirmier ASC");
            $sql->execute();
            $all_infirmiers = $sql->fetchAll();
        }
        ?>


        <form action="" method="post">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="search" name="rechercher" placeholder="Rechercher un infirmier">
        </form>

    </div>


    <section id="list_infirmier">
        <h4>Liste des infirmiers</h4>
        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nom complet</th>
                    <th>Adresse Mail</th>
                    <th>Téléphone</th>
                </tr>
            </thead>

            <?php
            foreach ($all_infirmiers as $user_infirmier) {
            ?>
                <tr>
                    <td>
                        <?php echo $user_infirmier['id_infirmier']; ?>
                    </td>
                    <td>
                        <?php echo $user_infirmier['nom_infirmier'] . ' ' . $user_infirmier['prenom_infirmier']; ?>
                    </td>
                    <td>
                        <?php echo $user_infirmier['email_infirmier']; ?>
                    </td>
                    <td>
                        <?php echo $user_infirmier['tel_infirmier']; ?>
                    </td>
                </tr>
            <?php } ?>

        </table>
    </section>
</body>

</html>