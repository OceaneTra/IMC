const calendarGrid = document.getElementById("calendrier-grid");
const monthYearDisplay = document.getElementById("month-year");
const summary = document.getElementById("summary");
const timeModal = document.getElementById("timeModal");
const selectDateHeader = document.querySelector(".fade-in"); // Sélectionne l'élément <h1>
const appointmentSummaryHeader = document.getElementById("appointment-summary-title"); // Sélectionne le <h3> du récapitulatif
let selectedDate = null;
let currentDate = new Date();

function renderCalendar() {
    const year = currentDate.getFullYear();
    const month = currentDate.getMonth();
    const firstDay = new Date(year, month, 1).getDay();
    const daysInMonth = new Date(year, month + 1, 0).getDate();

    monthYearDisplay.textContent = currentDate.toLocaleDateString("fr-FR", {
        month: "long",
        year: "numeric"
    });

    calendarGrid.innerHTML = "";  // Réinitialise le calendrier

    // Remplir les cases vides avant le premier jour du mois
    for (let i = 0; i < firstDay; i++) {
        const emptyCell = document.createElement("div");
        emptyCell.classList.add("empty-cell");
        calendarGrid.appendChild(emptyCell);
    }

    // Remplir les cases avec les jours du mois
    for (let day = 1; day <= daysInMonth; day++) {
        const dayCell = document.createElement("div");
        dayCell.classList.add("day-cell");
        dayCell.textContent = day;

        dayCell.addEventListener("click", () => {
            selectedDate = `${day}/${month + 1}/${year}`;
            openModal();
        });

        calendarGrid.appendChild(dayCell);
    }
}

function prevMonth() {
    currentDate.setMonth(currentDate.getMonth() - 1);
    renderCalendar();
}

function nextMonth() {
    currentDate.setMonth(currentDate.getMonth() + 1);
    renderCalendar();
}

function openModal() {
    timeModal.style.display = "flex";
}

function closeModal() {
    timeModal.style.display = "none";
}

function confirmAppointment() {
    const time = document.getElementById("appointment-time").value;
    if (time) {
        summary.textContent = `Votre rendez-vous est programmé le ${selectedDate} à ${time}`;
        
        // Afficher le récapitulatif et masquer l'en-tête
        appointmentSummaryHeader.style.display = "block"; // Affiche le titre "Recapitulatif de rendez-vous"
        summary.style.display = "block"; // Affiche le recapitulatif
        selectDateHeader.style.display = "none"; // Cache le <h1> de sélection de la date

        closeModal();
    } else {
        alert("Veuillez sélectionner une heure.");
    }
}

renderCalendar();  // Affiche le mois en cours au chargement

