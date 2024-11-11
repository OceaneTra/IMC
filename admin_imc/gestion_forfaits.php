<?php include("C:/wamp64/www/Ivoire_Medical_Center/IMC/config/db_connect.php");



/*traitement ajout */

if (isset($_POST['enregistrer'])) {
    $description_forfait = $_POST['desc'];
    $prix_forfait = $_POST['prix_forfait'];
    $type_forfait = $_POST['type_forfait'];
    $statut_forfait = $_POST['statut_forfait'];
    $fonctionnalites = $_POST['fonctionnalites'];

    $requete = $bdd->prepare("INSERT INTO forfaits (description_forfait, prix_forfait, type_forfait, statut_forfait, fonctionnalites) VALUES (?,?,?,?,?)");
    $requete->execute([$description_forfait, $prix_forfait, $type_forfait, $statut_forfait, $fonctionnalites]);

    header("Location: index.php?page=gsForfaits");
    exit();
}

/* traitement modification */
if (isset($_GET['action']) && isset($_GET['id']) && $_GET['action'] == 'modifier') {
    $id_forfait = $_GET['id'];

    if (isset($_POST['desc'], $_POST['prix_forfait'], $_POST['type_forfait'], $_POST['statut_forfait'], $_POST['fonctionnalites'])) {
        $description_forfait = $_POST['desc'];
        $prix_forfait = $_POST['prix_forfait'];
        $type_forfait = $_POST['type_forfait'];
        $statut_forfait = $_POST['statut_forfait'];
        $fonctionnalites = $_POST['fonctionnalites'];


        $req = $bdd->prepare("UPDATE forfaits SET
        description_forfait = ?,
        prix_forfait = ?,
        type_forfait= ?,
        statut_forfait= ?,
        fonctionnalites = ?
        WHERE id_forfait = ? ");

        $req->execute([$description_forfait, $prix_forfait, $type_forfait, $statut_forfait, $fonctionnalites, $id_forfait]);

        header("Location: index.php?page=gsForfaits");
        exit();
    }
}


/* recuperation des données pour les afficher dans le formulaire */
if (isset($_GET['id']) && isset($_GET['action']) && $_GET['action'] == 'modifier') {
    $rq = $bdd->prepare("SELECT * FROM forfaits WHERE id_forfait = ? ");
    $rq->execute([$_GET['id']]);
    $lignes = $rq->fetch();
}



/* traitement suppression */
if (isset($_GET['action']) && isset($_GET['id']) && $_GET['action'] == 'supprimer') {
    $id_forfait = $_GET['id'];
    $req = $bdd->prepare("DELETE FROM forfaits WHERE id_forfait = ?");
    $req->execute([$id_forfait]);

    header("Location: index.php?page=gsForfaits");
    exit();
}


?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/Ivoire_Medical_Center/IMC/admin_imc/assets/css/forfait_style.css">
</head>

<body>

    <form action="" method="POST">


        <h1>MENU DE GESTION DES FORFAITS</h1>

        <h4>Informations générales</h4>

        <div class="description_forfait">
            <label for="">Description:</label>
            <textarea name="desc" id="desc" placeholder="Une brève description du forfait..." required><?php if (isset($lignes['description_forfait'])) {
                                                                                                            echo htmlspecialchars($lignes['description_forfait']);
                                                                                                        } ?></textarea>
        </div>

        <div class="prix_forfait">
            <label for="prix_forfait">Prix du forfait: </label>
            <input type="text" id="prix_forfait" name="prix_forfait" value="<?php if (isset($lignes['prix_forfait'])) {
                                                                                echo htmlspecialchars($lignes['prix_forfait']);
                                                                            } ?>" required>
        </div>

        <div class="listbox">

            <div class="type_forfait">
                <label for="type_forfait">Type du forfait: </label>
                <select id="type_forfait" name="type_forfait" required>
                    <option value="plan basic" <?php if (isset($lignes['type_forfait']) && $lignes['type_forfait'] == 'plan basic ') echo 'selected'; ?>> Plan basic</option>
                    <option value="plan business" <?php if (isset($lignes['type_forfait']) && $lignes['type_forfait'] == 'plan business ') echo 'selected'; ?>> Plan business</option>
                    <option value="plan entreprise" <?php if (isset($lignes['type_forfait']) && $lignes['type_forfait'] == 'plan entreprise') echo 'selected'; ?>> Plan entreprise</option>
                </select>
            </div>

            <div class="statut_forfait">
                <label for="statut_forfait">Statut: </label>
                <select id="statut_forfait" name="statut_forfait" required>
                    <option value="actif" <?php if (isset($lignes['statut_forfait']) && $lignes['statut_forfait'] == 'actif') echo 'selected'; ?>>Actif</option>
                    <option value="inactif" <?php if (isset($lignes['statut_forfait']) && $lignes['statut_forfait'] == 'inactif') echo 'selected'; ?>>Inactif</option>
                </select>
            </div>

        </div>

        <div class="fonctionnalites">
            <label for="">Fonctionnalités: <span>*une fonctionnalié par ligne </span></label>
            <textarea name="fonctionnalites" id="fonctionnalites" placeholder="Lister les avantages offerts par ce forfait..." required><?php if (isset($lignes['fonctionnalites'])) {
                                                                                                                                            echo htmlspecialchars($lignes['fonctionnalites']);
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
                    <th>Id</th>
                    <th>Description du forfait</th>
                    <th>prix du forfait</th>
                    <th>type de forfait</th>
                    <th>statut</th>
                    <th>Liste des fonctionnalités</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <?php
            $rq = $bdd->prepare("SELECT * FROM forfaits");
            $rq->execute();
            $lignes = $rq->fetchAll();

            if ($lignes) {
                foreach ($lignes as $ligne) { ?>


                    <tbody>
                        <tr style="text-align:center;">
                            <td><?php echo $ligne["id_forfait"]; ?></td>
                            <td><?php echo $ligne["description_forfait"]; ?></td>
                            <td><?php echo $ligne["prix_forfait"]; ?></td>
                            <td><?php echo $ligne["type_forfait"]; ?></td>
                            <td><?php echo $ligne["statut_forfait"]; ?></td>
                            <td style="text-align:left"><?php echo nl2br($ligne["fonctionnalites"]);  ?></td>
                            <td style="display:flex;flex-direction:column; gap: 5px; height:100%; width:100%; justify-content:center; padding: 20px;">
                                <a href="?page=gsForfaits&id=<?php echo $ligne["id_forfait"]; ?>&action=modifier">Modifier</a>
                                <a href="?page=gsForfaits&id=<?php echo $ligne["id_forfait"]; ?>&action=supprimer">Supprimer</a>
                            </td>
                        </tr>
                    </tbody>
            <?php }
            } ?>


        </table>
    </section>


</body>

</html>