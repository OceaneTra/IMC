<?php include("C:/wamp64/www/Ivoire_Medical_Center/IMC/config/db_connect.php");



/* traitement suppression */
if (isset($_GET['action']) && isset($_GET['id']) && $_GET['action'] == 'supprimer') {
    $id_patient = $_GET['id'];
    $req = $bdd->prepare("DELETE FROM patient WHERE id_patient = ?");
    $req->execute([$id_patient]);

    header("Location: ?page=patient");
    exit();
}


// Affichage des données dans le dossier medical
if (isset($_GET['id']) && isset($_GET['action']) && $_GET['action'] == 'afficher') {
    $requete = $bdd->prepare("SELECT * FROM PATIENT WHERE id_patient = ?");
    $requete->execute([$_GET['id']]);
    $donnees = $requete->fetch();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Document</title>
    <link rel="stylesheet" href="/Ivoire_Medical_Center/IMC/admin_cm/assets/css/medecin/style_patient.css">

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
                                <a href="javascript:void(0) ?page=patient&id=<?php echo $ligne["id_patient"];
                                                                                ?>" onclick="openModal()">Dossier medical</a>
                                <a href="?page=patient&id=<?php echo $ligne["id_patient"]; ?>&action=supprimer">Supprimer</a>
                            </td>
                        </tr>
                    </tbody>
            <?php }
            } ?>

        </table>
    </section>


    <div id="dossier_medical">
        <span class="close-btn" onclick="closeModal()">&times;</span>
        <form action="" method="post">
            <h2>DOSSIER MEDICAL</h2>

            <h3>Informations sur le document</h3>
            <div class="num_dossier">
                <label for="num_dossier">Dossier N°:</label>
                <input type="text" name="num_dossier" value="<?php if (isset($donnees['id_dm'])) {
                                                                    echo htmlspecialchars($donnees['id_dm']);
                                                                }  ?>">
            </div>

            <div class="date_creation">
                <label for="date_creation">Date de création </label>
                <input type="datetime" name="date_creation" value="<?php if (isset($donnees['date_dm'])) {
                                                                        echo htmlspecialchars($donnees['date_dm']);
                                                                    }  ?>">
            </div>


            <div class="infos_patient">
                <h3>Informations personnelles du patient</h3>

                <div class="nom_patient">
                    <label for="nom_patient">Nom patient</label>
                    <input type="text" name="nom_patient" value="<?php if (isset($donnees['nom_patient']) && isset($donnees['prenom_patient'])) {
                                                                        echo htmlspecialchars($donnees['nom_patient']) . ' ' . htmlspecialchars($donnees['prenom_patient']);
                                                                    }  ?>">
                </div>

                <div class="age">
                    <label for="age">Age</label>
                    <input type="text" name="age" value="<?php if (isset($donnees['age_patient'])) {
                                                                echo htmlspecialchars($donnees['age_patient']);
                                                            }  ?>">
                </div>

                <div class="date_naissance">
                    <label for="date_naissance">Date de naissance</label>
                    <input type="date" name="date_naissance" value="<?php if (isset($donnees['date_de_naissance'])) {
                                                                        echo htmlspecialchars($donnees['date_de_naissance']);
                                                                    }  ?>">
                </div>


                <div class="sexe">
                    <label for="sexe">Sexe: </label>
                    <label for="masculin">Masculin</label>
                    <input type="radio" id="masculin" name="sexe" value="M" <?php if (isset($donnees['sexe_patient']) && $donnees['sexe_patient'] == 'M') echo 'checked'; ?>>
                    <label for="feminin">Feminin</label>
                    <input type="radio" id="feminin" name="sexe" value="F" <?php if (isset($donnees['sexe_patient']) && $donnees['sexe_patient'] == 'F') echo 'checked'; ?>>
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
                        <th>Date & Heure du rendez-vous</th>
                        <th>Type de consultation</th>
                        <th>Medecin traitant</th>
                        <th>Traitement</th>
                        <th>Notes supplémentaires du medecin</th>
                        <th>Statut du rendez-vous</th>
                    </tr>
                </thead>

                <?php
                $rq = $bdd->prepare("SELECT date_rdv, heure_rdv, type_consultation FROM dm WHERE id_patient = ? ");
                $rq->execute([$_GET['id']]);
                $lignes = $rq->fetchAll();
                if ($lignes) {
                    foreach ($lignes as $ligne) { ?>
                        <tbody>
                            <tr style="text-align:center;">
                                <td><?php echo $ligne["date_rdv"] . ' ' . $ligne["heure_rdv"]; ?></td>
                                <td><?php echo $ligne["type_consultation"]; ?></td>
                                <td><?php echo $ligne["id_medecin"]; ?></td>
                                <td><?php echo $ligne["traitement"]; ?></td>
                                <td><?php echo $ligne["notes_medecin"]; ?></td>
                                <td><?php echo $ligne["statut_rdv"]; ?></td>
                            </tr>
                        </tbody>
                <?php }
                } ?>

            </table>

            <input type="submit" name="enregistrer" value="Enregistrer">

        </form>
    </div>


    <script>
        function openModal() {
            document.getElementById('dossier_medical').style.display = "flex";
        }

        function closeModal() {
            document.getElementById('dossier_medical').style.display = "none";
        }
    </script>


</body>

</html>