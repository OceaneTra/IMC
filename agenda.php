<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/agendas.css">
</head>

<body>

    <h1>Calendrier Universel</h1>
    <div class="controls">
        <label for="month">Mois :</label>
        <select id="month">
            <!-- Génération dynamique des mois -->
        </select>
        <label for="year">Année :</label>
        <input type="number" id="year" min="1900" max="2100" value="2024">
        <button id="generate">Générer</button>
    </div>
    <ul id="month-days">
        <!-- Jours du mois générés ici -->
    </ul>


    <script>
        // JavaScript pour la génération dynamique du calendrier
        const daysOfWeek = ["Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi"];
        const months = ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"];

        const monthSelect = document.getElementById("month");
        const yearInput = document.getElementById("year");
        const generateButton = document.getElementById("generate");
        const monthDaysContainer = document.getElementById("month-days");

        // Remplir les options du select pour les mois
        months.forEach((month, index) => {
            const option = document.createElement("option");
            option.value = index;
            option.textContent = month;
            monthSelect.appendChild(option);
        });

        // Fonction pour générer les jours d'un mois
        function generateCalendar(year, month) {
            monthDaysContainer.innerHTML = ""; // Réinitialiser le calendrier
            const firstDay = new Date(year, month, 1).getDay();
            const totalDays = new Date(year, month + 1, 0).getDate();

            for (let i = 0; i < totalDays; i++) {
                const day = new Date(year, month, i + 1);
                const dayName = daysOfWeek[day.getDay()];

                const li = document.createElement("li");
                if (day.getDate() === new Date().getDate() && year === new Date().getFullYear() && month === new Date().getMonth()) {
                    li.classList.add("today");
                }

                li.innerHTML = `<time>${day.getDate()}</time>${dayName}`;
                monthDaysContainer.appendChild(li);
            }
        }

        // Initialisation : afficher le mois actuel
        generateCalendar(new Date().getFullYear(), new Date().getMonth());

        // Générer le calendrier quand l'utilisateur clique sur "Générer"
        generateButton.addEventListener("click", () => {
            const year = parseInt(yearInput.value);
            const month = parseInt(monthSelect.value);
            generateCalendar(year, month);
        });
    </script>

</body>

</html>