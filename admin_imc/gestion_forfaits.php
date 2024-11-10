<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/forfait_style.css">
</head>

<body>

    <form action="" method="POST">


        <h1>MENU DE GESTION DES FORFAITS</h1>

        <h4>Informations générales</h4>

        <div class="description_forfait">
            <label for="">Description:</label>
            <textarea name="desc" id="desc" placeholder="Une brève description du forfait..."></textarea>
        </div>

        <div class="prix_forfait">
            <label for="prix_forfait">Prix du forfait: </label>
            <input type="text" id="prix_forfait" name="prix_forfait">
        </div>

        <div class="listbox">

            <div class="type_forfait">
                <label for="type_forfait">Type du forfait: </label>
                <select id="type_forfait" name="type_forfait">
                    <option value="basic_plan"> Plan basic</option>
                    <option value="business_plan"> Plan business</option>
                    <option value="entreprise_plan"> Plan entreprise</option>
                </select>
            </div>

            <div class="statut_forfait">
                <label for="statut_forfait">Statut: </label>
                <select id="statut_forfait" name="statut_forfait">
                    <option value="actif">Actif</option>
                    <option value="inactif">Inactif</option>
                </select>
            </div>

        </div>

        <div class="fonctionnalites">
            <label for="">Fonctionnalités: <span>*une fonctionnalié par ligne </span></label>
            <textarea name="desc" id="desc" placeholder="Lister les avantages offerts par ce forfait..."></textarea>
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