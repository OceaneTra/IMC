function updateTotal(element) {
    // Met à jour le montant total
    const totalAmount = document.getElementById('total-amount');
    const hiddenTotal = document.getElementById('montant_total');
    const hiddenPlan = document.getElementById('forfait');

    const selectedPlan = element.nextElementSibling.textContent; // Obtenir le texte du plan
    totalAmount.textContent = element.value; // Affiche la valeur choisie
    hiddenTotal.value = element.value; // Met à jour le champ caché pour le montant
    hiddenPlan.value = selectedPlan.trim(); // Met à jour le champ caché pour le type de forfait
}

 
 
 function selectPaymentMethod(method) {
        // Met à jour la valeur de l'input caché
        document.getElementById('methode_paiement').value = method;

        // Met en surbrillance le bouton sélectionné
        const buttons = document.querySelectorAll('.payment-options button');
        buttons.forEach(button => button.classList.remove('active'));
        if (method === 'card') {
            buttons[0].classList.add('active');
        } else if (method === 'paypal') {
            buttons[1].classList.add('active');
        }
        else if (method === 'wave') {
            buttons[2].classList.add('active');
        }
        else if (method === 'orange') {
            buttons[3].classList.add('active');
        }
    }

    function showPaymentModal(details) {
        // Vérifie si tous les éléments sont présents
        if (!details) {
            console.error('Les détails du paiement sont manquants');
            return;
        }
    
        // Remplir les informations dans la facture
        document.getElementById('payment-message').textContent = details.message || 'Détails non fournis';
        document.getElementById('invoice-name').textContent = details.nom_carte || 'N/A';
        document.getElementById('invoice-card-number').textContent = details.numero_carte || '**** **** **** ****';
        document.getElementById('invoice-plan').textContent = details.forfait || 'N/A';
        document.getElementById('invoice-amount').textContent = details.montant_total || '0';
        document.getElementById('invoice-method').textContent = details.methode_paiement || 'N/A';
        
        // Affiche la boîte modale
        document.getElementById('payment-modal').style.display = 'block';
    }
    
    
    function closeModal() {
        document.getElementById('payment-modal').style.display = 'none';
    }
    