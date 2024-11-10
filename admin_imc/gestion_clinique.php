<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/gsClinique.css">
</head>

<body>

    <form action="" method="POST">


        <h1>MENU DE GESTION DES CLINIQUES</h1>

        <h4>Informations générales</h4>

        <div class="infos">
            <div class="nom_clinique">
                <label for="nom_clinique">Nom de la clinique: </label>
                <input type="text" id="nom_clinique" name="nom_clinique">
            </div>

            <div class="adresse_clinique">
                <label for="adresse">Situation géographique: </label>
                <input type="text" id="adresse" name="adresse">
            </div>
        </div>

        <div class="contacts">
            <div class="mail">
                <label for="mail">Adresse mail: </label>
                <input type="mail" id="mail" name="adresse">
            </div>

            <div class="tel">
                <label for="tel">Téléphone: </label>
                <input type="text" id="tel" name="tel">
            </div>
        </div>




        <div class="description_clinique">
            <label for="">Description:</label>
            <textarea name="desc" id="desc" placeholder="Une brève description de la clinique..."></textarea>
        </div>




        <div class="btn-container">
            <input type="submit" value="Enregistrer cette clinique">
        </div>
    </form>



    <section id="list">
        <h4>Liste des cliniques enregistrées</h4>
        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nom</th>
                    <th>Contact</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
            <tr style="text-align:center;">
                    <td>1</td>
                    <td>Gomez</td>
                    <td>0707019478</td>
                    <td>Supprimer</td>
                </tr>

            </tbody>

        </table>
    </section>


</body>

</html>