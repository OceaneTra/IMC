<?php include("C:/wamp64/www/Ivoire_Medical_Center/IMC/config/db_connect.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $type_consultation = $_POST['type_consultation'];
    $date_rdv = $_POST['date_rdv'];
    $heure_rdv = $_POST['heure_rdv'];

    // Rechercher un médecin correspondant
    $sql = $bdd->prepare("SELECT id_medecin FROM medecin WHERE specialite = ?");
    $sql->execute([$type_consultation]);
    $result = $sql->fetch();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $id_medecin = $row['id_medecin'];

        // Ajouter le rendez-vous
        $sql = "INSERT INTO rdv ( date_rdv, heure_rdv, id_patient, type_consultation, id_medecin) 
                  VALUES (?, ?, ?, ?, ?)";
        $sql = $bdd->prepare($sql);
        $sql->execute([$date_rdv, $heure_rdv, $id_patient, $type_consultation, $id_medecin,]);
    }
}





?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prise de Rendez-vous</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h2 {
            text-align: center;
            color: #1A5E63;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 5px;
            font-weight: bold;
        }

        input,
        select,
        button {
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        button {
            background-color: #1A5E63;
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #FFC857;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Prise de Rendez-vous</h2>
        <form action="traitement_rdv.php" method="POST">
            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom" required>

            <label for="prenom">Prénom :</label>
            <input type="text" id="prenom" name="prenom" required>

            <label for="email">Email :</label>
            <input type="email" id="email" name="email" required>

            <label for="dateNaiss">Date de naissance :</label>
            <input type="date" id="dateNaiss" name="dateNaiss" required>

            <label for="age">Age :</label>
            <input type="text" id="age" name="age" required>

            <label for="tel">Téléphone :</label>
            <input type="tel" id="tel" name="tel" required>

            <label for="sexe">Sexe: </label>
            <label for="masculin">Masculin</label>
            <input type="radio" id="masculin" name="sexe" value="Masculin">
            <label for="feminin">Feminin</label>
            <input type="radio" id="feminin" name="sexe" value="Feminin">

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




            <label for="consultation">Type de Consultation :</label>
            <select id="consultation" name="consultation" required>
                <option value="" disabled selected>Choisissez un type</option>
                <option value="générale">Consultation Générale</option>
                <option value="cardiologie">Cardiologie</option>
                <option value="dermatologie">Dermatologie</option>
                <option value="gynécologie">Gynécologie</option>
            </select>

            <label for="date">Date :</label>
            <input type="date" id="date" name="date" required>

            <label for="heure">Heure :</label>
            <input type="time" id="heure" name="heure" required>

            <input name="prendre_rdv" type="submit" value="Prendre un rendez vous">
        </form>
    </div>
</body>

</html>