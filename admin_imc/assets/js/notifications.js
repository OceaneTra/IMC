 // Ajout d'interactivité pour les boutons de filtre
 const filterButtons = document.querySelectorAll('.filter-btn');
 filterButtons.forEach(button => {
     button.addEventListener('click', () => {
         filterButtons.forEach(btn => btn.classList.remove('active'));
         button.classList.add('active');
     });
 });

 // Gestion des boutons "Marquer comme lu"
 const markReadButtons = document.querySelectorAll('.mark-read');
 markReadButtons.forEach(button => {
     button.addEventListener('click', (e) => {
         const card = e.target.closest('.notification-card');
         card.classList.remove('unread');
         button.remove();
     });
 });

 // Gestion des boutons de suppression
 const deleteButtons = document.querySelectorAll('.delete-btn');
 deleteButtons.forEach(button => {
     button.addEventListener('click', (e) => {
         const card = e.target.closest('.notification-card');
         card.style.opacity = '0';
         setTimeout(() => card.remove(), 300);
     });
 });