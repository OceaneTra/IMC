<?php 

include __DIR__ . '/www/config/db_connect.php';



/* traitement suppression */
if (isset($_GET['action']) && isset($_GET['id']) && $_GET['action'] == 'supprimer') {
    $id_patient = $_GET['id'];
    $req = $connexion->prepare("DELETE FROM patient WHERE id_patient = ?");
    $req->execute([$id_patient]);

    header("Location: ?page=patient");
    exit();
}


// Affichage des données dans le dossier medical
if (isset($_GET['id']) && isset($_GET['action']) && $_GET['action'] == 'afficher') {
    $requete = $connexion->prepare("SELECT * FROM patient 
    JOIN dm ON patient.id_patient = dm.id_patient
    JOIN rdv ON patient.id_patient = rdv.id_patient
    JOIN medecin ON dm.id_medecin = medecin.id_medecin
    WHERE patient.id_patient = ?");
    $requete->execute([$_GET['id']]);
    $donnees = $requete->fetch();
}

// traitement de modification
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['modifier']) && isset($_GET['id'])) {
    $id_patient = $_GET['id'];
    if (isset($_POST['nom_patient']) && isset($_POST['prenom_patient']) && isset($_POST['date_naissance']) && isset($_POST['age']) && isset($_POST['sexe']) && isset($_POST['groupe_sanguin']) && isset($_POST['antecedents']) && isset($_POST['date_rdv']) && isset($_POST['type_consultation']) && isset($_POST['traitements']) && isset($_POST['note_medecin'])) {

        $nom = $_POST['nom_patient'];
        $prenom = $_POST['prenom_patient'];
        $dateNaissance = $_POST['date_naissance'];
        $age = $_POST['age'];
        $sexe = $_POST['sexe'];
        $groupe_sanguin = $_POST['groupe_sanguin'];
        $antecedents = $_POST['antecedents'];

        $date_rdv = $_POST['date_rdv'];
        $type_consultation = $_POST['type_consultation'];
        $note_medecin = $_POST['note_medecin'];
        $traitements = $_POST['traitements'];

        // Mise à jour des informations du patient
        $tablePatient = $connexion->prepare("UPDATE patient SET 
        nom_patient = ?, 
        prenom_patient = ?, 
        date_de_naissance = ?, 
        age_patient = ?, 
        sexe_patient = ?, 
        groupe_sanguin = ? 
        WHERE id_patient = ?");
        $tablePatient->execute([$nom, $prenom, $dateNaissance, $age, $sexe, $groupe_sanguin, $id_patient]);

        // Mise à jour du rendez-vous
        $tableRdv = $connexion->prepare("UPDATE rdv SET 
        date_rdv = ?, 
        type_consultation = ? 
        WHERE id_patient = ?");
        $tableRdv->execute([$date_rdv, $type_consultation, $id_patient]);

        // Mise à jour du dossier médical
        $tableDm = $connexion->prepare("UPDATE dm SET 
        antecedents = ?,
        note_medecin = ?, 
        traitements = ?
        WHERE id_patient = ?");
        $tableDm->execute([$antecedents, $note_medecin, $traitements, $id_patient]);

        // Redirection après modification
        header("Location: ?page=patient");
        exit();
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
    <link rel="stylesheet" href="css/style_patients.css">

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
            $rq = $connexion->prepare("SELECT * FROM patient");
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
                                <a href="?page=patient&id=<?php echo $ligne['id_patient']; ?>&action=afficher" onclick="openModal(); return false;">Dossier médical</a>

                                <a href="?page=patient&id=<?php echo $ligne["id_patient"]; ?>&action=supprimer">Supprimer</a>
                            </td>
                        </tr>
                    </tbody>
            <?php }
            } ?>

        </table>
    </section>


    <div id="dossier_medical">
        <span class="close-btn" onclick="closeModal()"><i class="fa-solid fa-xmark fa-2x"></i></span>
        <form action="" method="post">
            <h2>DOSSIER MEDICAL</h2>

            <h3>Informations sur le document</h3>

            <div class="infos_dm">

                <div class="num_dm">
                    <label for="num_dossier">Dossier N°:</label>
                    <input type="text" name="num_dossier" value="<?php if (isset($donnees['id_dm'])) {
                                                                        echo htmlspecialchars($donnees['id_dm']);
                                                                    }  ?>" disabled>
                </div>

                <div class="date_creation">
                    <label for="date_creation">Date de création </label>
                    <input type="datetime" name="date_creation" value="<?php if (isset($donnees['date_creation_dm'])) {
                                                                            echo htmlspecialchars($donnees['date_creation_dm']);
                                                                        }  ?>" disabled>
                </div>


            </div>




            <h3>Informations personnelles du patient</h3>
            <div class="infos_patient">

                <div class="nom_patient">
                    <label for="nom_patient">Nom patient</label>
                    <input type="text" name="nom_patient" value="<?php if (isset($donnees['nom_patient'])) {
                                                                        echo htmlspecialchars($donnees['nom_patient']);
                                                                    }  ?>">
                </div>

                <div class="prenom_patient">
                    <label for="prenom_patient">Prénom(s) patient</label>
                    <input type="text" name="prenom_patient" value="<?php if (isset($donnees['prenom_patient'])) {
                                                                        echo htmlspecialchars($donnees['prenom_patient']);
                                                                    }  ?>">
                </div>

                <div class="date_naissance">
                    <label for="date_naissance">Date de naissance</label>
                    <input type="date" name="date_naissance" value="<?php if (isset($donnees['date_de_naissance'])) {
                                                                        echo htmlspecialchars($donnees['date_de_naissance']);
                                                                    }  ?>">
                </div>


                <div class="age">
                    <label for="age">Age</label>
                    <input type="text" name="age" value="<?php if (isset($donnees['age_patient'])) {
                                                                echo htmlspecialchars($donnees['age_patient']);
                                                            }  ?>">
                </div>



                <div class="sexe">
                    <label for="sexe">Sexe: </label>
                    <label for="masculin">Masculin</label>
                    <input type="radio" id="masculin" name="sexe" value="Masculin" <?php if (isset($donnees['sexe_patient']) && $donnees['sexe_patient'] == 'Masculin') echo 'checked'; ?>>
                    <label for="feminin">Feminin</label>
                    <input type="radio" id="feminin" name="sexe" value="Feminin" <?php if (isset($donnees['sexe_patient']) && $donnees['sexe_patient'] == 'Feminin') echo 'checked'; ?>>
                </div>

                <div class="groupe_sanguin">
                    <label for="groupe_sanguin">Groupe sanguin: </label>
                    <select id="groupe_sanguin" name="groupe_sanguin" required>
                        <option value="A+" <?php if (isset($donnees['groupe_sanguin']) && $donnees['groupe_sanguin'] == 'A+') echo 'selected'; ?>>A+</option>
                        <option value="A-" <?php if (isset($donnees['groupe_sanguin']) && $donnees['groupe_sanguin'] == 'A-') echo 'selected'; ?>>A-</option>
                        <option value="B+" <?php if (isset($donnees['groupe_sanguin']) && $donnees['groupe_sanguin'] == 'B+') echo 'selected'; ?>>B+</option>
                        <option value="B-" <?php if (isset($donnees['groupe_sanguin']) && $donnees['groupe_sanguin'] == 'B-') echo 'selected'; ?>>B-</option>
                        <option value="AB+" <?php if (isset($donnees['groupe_sanguin']) && $donnees['groupe_sanguin'] == 'AB+') echo 'selected'; ?>>AB+</option>
                        <option value="AB-" <?php if (isset($donnees['groupe_sanguin']) && $donnees['groupe_sanguin'] == 'AB-') echo 'selected'; ?>>AB-</option>
                        <option value="O+" <?php if (isset($donnees['groupe_sanguin']) && $donnees['groupe_sanguin'] == 'O+') echo 'selected'; ?>>O+</option>
                        <option value="O-" <?php if (isset($donnees['groupe_sanguin']) && $donnees['groupe_sanguin'] == 'O-') echo 'selected'; ?>>O-</option>
                    </select>
                </div>

                <div class="antecedents_medicaux">
                    <label for="antecedents">Antécédents médicaux: </label>
                    <textarea name="antecedents" id="antecedents"><?php if (isset($donnees['antecedents'])) {
                                                                        echo htmlspecialchars($donnees['antecedents']);
                                                                    }  ?></textarea>
                </div>


            </div>



            <h3>Informations complémentaires</h3>
            <table class="antecedents">
                <thead>
                    <tr>
                        <th style="text-align:center;">Date & Heure du rendez-vous</th>
                        <th style="text-align:center;">Type de consultation</th>
                        <th style="text-align:center;">Medecin traitant</th>
                        <th style="text-align:center;">Traitement</th>
                        <th style="text-align:center;">Notes supplémentaires du medecin</th>
                    </tr>
                </thead>

                <tbody>
                    <td><input type="text" style="border: none; font-size:15px; text-align:center;" name="date_rdv" value="<?php if (isset($donnees['date_rdv'])) echo htmlspecialchars($donnees['date_rdv']); ?>"></td>
                    <td><input type="text" style="border: none; font-size:15px; text-align:center;" name="type_consultation" value="<?php if (isset($donnees['type_consultation'])) echo htmlspecialchars($donnees['type_consultation']); ?>"></td>
                    <td><input type="text" style="border: none; font-size:15px; text-align:center;" name="nom_medecin" value="<?php if (isset($donnees['nom_medecin'])) echo htmlspecialchars($donnees['nom_medecin']); ?>"></td>
                    <td><input type="text" style="border: none; font-size:15px; text-align:center;" name="traitements" value="<?php if (isset($donnees['traitements'])) echo htmlspecialchars($donnees['traitements']); ?>"></td>
                    <td><input type="text" style="border: none; font-size:15px; text-align:center;" name="note_medecin" value="<?php if (isset($donnees['note_medecin'])) echo htmlspecialchars($donnees['note_medecin']); ?>"></td>
                </tbody>


            </table>


            <input type="submit" name="modifier" value="Enregistrer les modifications">
        </form>
    </div>


    <script>
        function openModal() {
            document.getElementById('dossier_medical').style.display = "flex";
            window.location.href = `?page=patient&id=${patientId}&action=afficher`;
        }

        function closeModal() {
            document.getElementById('dossier_medical').style.display = "none";
        }


        // Si vous êtes sur la page avec action=afficher, ouvrir automatiquement le modal
        <?php if (isset($_GET['action']) && $_GET['action'] == 'afficher'): ?>
            window.onload = function() {
                openModal();
            }
        <?php endif; ?>
    </script>


</body>

</html>