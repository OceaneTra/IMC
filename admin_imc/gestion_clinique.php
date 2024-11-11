<?php include("C:/wamp64/www/Ivoire_Medical_Center/IMC/config/db_connect.php");



/*traitement ajout */

if (isset($_POST['enregistrer'])) {
    $nom_clinique = $_POST['nom_clinique'];
    $situation_geo = $_POST['adresse_geo'];
    $adresse_mail = $_POST['mail'];
    $telephone = $_POST['tel'];
    $description = $_POST['desc'];

    $requete = $bdd->prepare("INSERT INTO centre_medical (nom_cm, description_cm, localisation_cm, tel_cm, email_cm) VALUES (?,?,?,?,?)");
    $requete->execute([$nom_clinique, $description, $situation_geo, $telephone, $adresse_mail]);

    header("Location: index.php?page=gsClinique");
    exit();
}

/* traitement modification */
if (isset($_GET['action']) && isset($_GET['id']) && $_GET['action'] == 'modifier') {
    $id_clinique = $_GET['id'];

    if (isset($_POST['nom_clinique'], $_POST['adresse_geo'], $_POST['mail'], $_POST['tel'], $_POST['desc'])) {
        $nom_clinique =  $_POST['nom_clinique'];
        $situation_geo = $_POST['adresse_geo'];
        $adresse_mail =  $_POST['mail'];
        $telephone =     $_POST['tel'];
        $description =   $_POST['desc'];


        $req = $bdd->prepare("UPDATE centre_medical SET
        nom_cm = ?,
        description_cm = ?,
        localisation_cm = ?,
        tel_cm = ?,
        email_cm = ?
        WHERE id_centre_medical = ? ");

        $req->execute([$nom_clinique, $situation_geo, $adresse_mail, $telephone, $description, $id_clinique]);

        header("Location: index.php?page=gsClinique");
        exit();
    }
}


/* recuperation des données pour les afficher dans le formulaire */ 
if (isset($_GET['id']) && isset($_GET['action']) && $_GET['action'] == 'modifier') {
    $rq = $bdd->prepare("SELECT * FROM centre_medical WHERE id_centre_medical = ? ");
    $rq->execute([$_GET['id']]);
    $lignes = $rq->fetch();
}



/* traitement suppression */
if (isset($_GET['action']) && isset($_GET['id']) && $_GET['action'] == 'supprimer') {
    $id_clinique = $_GET['id'];
    $req = $bdd->prepare("DELETE FROM centre_medical WHERE id_centre_medical = ?");
    $req->execute([$id_clinique]);

    header("Location: index.php?page=gsClinique");
    exit();
}


?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/Ivoire_Medical_Center/IMC/admin_imc/assets/css/gsClinique.css">
</head>

<body>

    <form action="" method="POST">


        <h1>MENU DE GESTION DES CLINIQUES</h1>

        <h4>Informations générales</h4>


        <div class="infos">
            <div class="nom_clinique">
                <label for="nom_clinique">Nom de la clinique: </label>
                <input type="text" id="nom_clinique" name="nom_clinique" value="<?php if (isset($lignes['nom_cm'])) {
                                                                                    echo htmlspecialchars($lignes['nom_cm']);
                                                                                } ?>" required>
            </div>

            <div class="adresse_clinique">
                <label for="adresse">Situation géographique: </label>
                <input type="text" id="adresse" name="adresse_geo" value="<?php if (isset($lignes['localisation_cm'])) {
                                                                                echo htmlspecialchars($lignes['localisation_cm']);
                                                                            } ?>" required>
            </div>
        </div>

        <div class="contacts">
            <div class="mail">
                <label for="mail">Adresse mail: </label>
                <input type="mail" id="mail" name="mail" value="<?php if (isset($lignes['email_cm'])) {
                                                                    echo htmlspecialchars($lignes['email_cm']);
                                                                } ?>" required>
            </div>

            <div class="tel">
                <label for="tel">Téléphone: </label>
                <input type="text" id="tel" name="tel" value="<?php if (isset($lignes['tel_cm'])) {
                                                                    echo htmlspecialchars($lignes['tel_cm']);
                                                                } ?>" required>
            </div>
        </div>




        <div class="description_clinique">
            <label for="">Description:</label>
            <textarea name="desc" id="desc" placeholder="Une brève description de la clinique..." required><?php if (isset($lignes['description_cm'])) {
                                                                                                                echo htmlspecialchars($lignes['description_cm']);
                                                                                                            } ?></textarea>
        </div>






        <div class="btn-container">
            <input type="submit" name="enregistrer" value="Enregistrer cette clinique">
        </div>


    </form>


    <section id="list">
        <h4>Liste des cliniques enregistrées</h4>
        <table>
            <thead>
                <tr>
                    <th width="10%">Id</th>
                    <th width="20%">Nom</th>
                    <th width="20%">Téléphone</th>
                    <th width = "10%">Actions</th>
                </tr>
            </thead>

            <?php
            $rq = $bdd->prepare("SELECT id_centre_medical, nom_cm, tel_cm FROM centre_medical");
            $rq->execute();
            $lignes = $rq->fetchAll();
            if ($lignes) {
                foreach ($lignes as $ligne) { ?>
                    <tbody>
                        <tr style="text-align:center;">
                            <td><?php echo $ligne["id_centre_medical"]; ?></td>
                            <td><?php echo $ligne["nom_cm"]; ?></td>
                            <td><?php echo $ligne["tel_cm"]; ?></td>
                            <td style="display:flex;flex-direction:column; gap: 5px; height:100%; width:100%; justify-content:center; padding: 20px;">
                                <a href="?page=gsClinique&id=<?php echo $ligne["id_centre_medical"]; ?>&action=modifier">Modifier</a>
                                <a href="?page=gsClinique&id=<?php echo $ligne["id_centre_medical"]; ?>&action=supprimer">Supprimer</a>
                            </td>
                        </tr>
                    </tbody>
            <?php }
            } ?>

        </table>
    </section>


</body>

</html>