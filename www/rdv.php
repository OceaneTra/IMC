<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Page de Prise de Rendez-Vous</title>
</head>
<body>
    <section class="container">
        <h1 class="fade-in">VEUILLEZ CHOISIR UNE DATE <br>POUR LE RENDEZ-VOUS</h1>
        
        <!--Le calendrier-->
        <div class="calendrier-container">
            <div class="calendrier-header">
                <button onclick="prevMonth()"><span class="fas fa-chevron-left"></span></button>
                <h2 id="month-year"></h2>
                <button onclick="nextMonth()"><span class="fas fa-chevron-right"></span></button>
            </div>

            <!--Les jours de la semaine-->
            <div class="calendrier-days">
                <div>Dim</div>
                <div>Lun</div>
                <div>Mar</div>
                <div>Mer</div>
                <div>Jeu</div>
                <div>Ven</div>
                <div>Sam</div>
            </div>

            <!--La grille des jours-->
            <div class="calendrier-grid" id="calendrier-grid"></div>
        </div>
          <!--La fenetre modale-->
        <div id="timeModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal()">&times;</span>
                <h3>Choississez une heure pour le rendez-vous</h3>
                <input type="time" id="appointment-time" required>
                <button onclick="confirmAppointment()">Confirmer</button>
            </div>
        </div>

        <div id="appointment-summary">
            <h3 id="appointment-summary-title">Recapitulatif de rendez-vous :</h3>
            <p id="summary"></p>
        </div>
        <script src="rdv.js"></script>
    </section>
</body>
</html>