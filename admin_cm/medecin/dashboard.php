<?php include("C:/wamp64/www/Ivoire_Medical_Center/IMC/config/db_connect.php");



//Changement du statut du rdv
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id_rdv = $_POST['id_rdv'];
    $action = $_POST['action'];

    $nouveau_statut = ($action === 'accepter') ? 'accepté' : 'refusé';
    // Mettre à jour le statut
    $stmt = $bdd->prepare("UPDATE rdv SET statut = ? WHERE id_rdv = ?");
    $stmt->execute([$nouveau_statut, $id_rdv]);

    echo "Le statut du rendez-vous a été mis à jour.";
}




?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Document</title>
    <link rel="stylesheet" href="/Ivoire_Medical_Center/IMC/admin_cm/assets/css/medecin/dash.css">
</head>

<body>
    <div class="cards-container">
        <div class="card" style="background: #f4f0fe;">
            <?php
            $sql = $bdd->prepare("SELECT COUNT(*) FROM patient ");
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
            $sql = $bdd->prepare("SELECT COUNT(*) FROM rdv WHERE statut = 'en attente' ");
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
            $sql = $bdd->prepare("SELECT COUNT(*) FROM  rdv WHERE statut = 'accepté' ");
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
            $sql = $bdd->prepare("SELECT COUNT(*) FROM  rdv WHERE statut = 'refusé' ");
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
                    <th>Id</th>
                    <th>Nom complet</th>
                    <th>Age</th>
                    <th>Sexe</th>
                    <th>Adresse Mail</th>
                    <th>Téléphone</th>
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
                            <td><?php echo $ligne["nom_patient"] . " " .  $ligne["prenom_patient"]; ?></td>
                            <td><?php echo $ligne["age_patient"]; ?></td>
                            <td><?php echo $ligne["sexe_patient"]; ?></td>
                            <td><?php echo $ligne["adresse_patient"]; ?></td>
                            <td><?php echo $ligne["tel_patient"]; ?></td>
                        </tr>
                    </tbody>
            <?php }
            } ?>

        </table>
    </section>

    <div id="rightbar">
        <div class="profil">
            <img src="/api/placeholder/45/45" alt="Profile">
            <div class="info">
                <h3 class="nom">John Doe</h3>
                <h5 class="fonction">Administrateur</h5>
            </div>
        </div>

        <div>
            <h2>Liste des consultations</h2>

            <?php
            $sql = $bdd->prepare("SELECT r.id_rdv, r.date_rdv, r.heure_rdv, c.nom_patient, c.prenom_patient 
            FROM rdv r 
            JOIN consultation c ON r.id_patient = c.id_patient 
            WHERE r.statut = 'en attente'");
            $sql->execute();
            $lignes = $sql->fetchAll();

            foreach ($lignes as $ligne) { ?>
                <div class="card-patient">
                    <div class="infos_pat">
                        <img src="/Ivoire_Medical_Center/IMC/admin_cm/assets/images/pp1.avif" width="80px" height="80px" alt="Profile">
                        <div class="info_pat">
                            <h3 class="nom_pat"><?php $ligne['nom_patient']; ?></h3>
                            <h5 class="age_pat"><?php $ligne['age_patient']; ?> </h5>
                        </div>
                    </div>

                    <div class="datetime">
                        <div class="date"><i class="fa-solid fa-calendar-days"></i>10.12.2023</div>
                        <div class="time"><i class="fa-solid fa-clock"></i>10:00 - 11.30</div>
                    </div>

                    <div class="button-container">
                        <?php echo '<button type="submit" name="action" value="refuser">Rejeter</button> '; ?>
                        <?php echo '<button type="submit" name="action" value="accepter">Accepter</button>'; ?>
                    </div>
                </div>
            <?php } ?>


        </div>



    </div>























</body>








</html>