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
            <!-----?page=patient&id=<?php // echo $ligne["id_patient"]; 
                                    ?>&action=afficher ----->
        </table>
    </section>


    <div id="dossier_medical">
        <span class="close-btn" onclick="closeModal()">&times;</span>
        <form action="" method="post">
            <h2>DOSSIER MEDICAL</h2>
            <div class="num_dossier">
                <label for="num_dossier">Dossier N°:</label>
                <input type="text" name="num_dossier">
            </div>

            <div class="date_creation">
                <label for="date_creation">Date de création </label>
                <input type="datetime" name="date_creation">
            </div>

            <div class="infos_patient">

                <div class="nom_patient">
                    <label for="nom_patient">Nom patient</label>
                    <input type="text" name="nom_patient">
                </div>

                <div class="age">
                    <label for="age">Age</label>
                    <input type="text" name="age">
                </div>

                <div class="date_naissance">
                    <label for="date_naissance">Date de naissance</label>
                    <input type="date" name="date_naissance">
                </div>


                <div class="sexe">
                    <label for="sexe">Sexe: </label>
                    <label for="masculin">Masculin</label>
                    <input type="radio" id="masculin" name="sexe" value="M">
                    <label for="feminin">Feminin</label>
                    <input type="radio" id="feminin" name="sexe" value="F">
                </div>

                <div class="groupe_sanguin">
                    <label for="groupe_sanguin">Groupe sanguin: </label>
                    <select id="groupe_sanguin" name="groupe_sanguin" required>
                        <option value="A+">A+</option>
                        <option value="A-">A-</option>
                        <option value="B+">B+</option>
                        <option value="B-">B-</option>
                        <option value="AB+">AB+</option>
                        <option value="AB-">AB-</option>
                        <option value="O+">O+</option>
                        <option value="O-">O-</option>
                    </select>
                </div>


            </div>

            <div class="nom_medecin">
                <label for="nom_medecin">Medecin traitant:</label>
                <input type="text" name="nom_medecin">
            </div>

            <div class="diagnostique">
                <label for="diagnostique">Diagnostique: </label>
                <input type="text" name="nom_medecin">
            </div>

            <div class="traitement">
                <label for="traitement">Traitement: </label>
                <textarea name="traitement" id="traitement"></textarea>
            </div>

            <div class="notes_medecin">
                <label for="notes_medecin">Notes supplémentaire: </label>
                <textarea name="notes_medecin" id="notes_medecin"></textarea>
            </div>



            <table class="antecedents">
                <thead>
                    <th>Date & Heure du rendez-vous</th>
                    <th>Type de consultation</th>
                    <th>Nom de l'examen effectué</th>
                    <th>Date de l'examen</th>
                </thead>
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