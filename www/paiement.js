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
        else if (method === 'Wave') {
            buttons[2].classList.add('active');
        }
        else if (method === 'Orange Money') {
            buttons[3].classList.add('active');
        }

        if (method === 'Wave' || method === 'Orange Money') {
            document.getElementById('phone-number-fields').style.display = 'block';
            document.getElementById('carte-details').style.display = 'none';
        } else {
            document.getElementById('phone-number-fields').style.display = 'none';
            document.getElementById('carte-details').style.display = 'block'
        }

    }

    function validateForm() {
        var selectedMethod = document.getElementById('methode_paiement').value;
        var forfait = document.getElementById('forfait').value;
        var montantTotal = document.getElementById('montant_total').value;
        
        // Vérifie que le forfait est sélectionné
        if (!forfait || montantTotal == 0) {
            alert("Veuillez choisir un forfait.");
            return false;
        }
    
        // Vérifie selon la méthode de paiement
        if (selectedMethod === 'card' || selectedMethod === 'paypal') {
            var nom = document.getElementsByName('nom')[0].value;
            var adresse = document.getElementsByName('adresse')[0].value;
            var numeroCarte = document.getElementsByName('numero_carte')[0].value;
            var dateExpiration = document.getElementsByName('date')[0].value;
            var cvv = document.getElementsByName('cvv')[0].value;
    
            if (!nom|| !numeroCarte || !dateExpiration || !cvv) {
                alert("Veuillez remplir tous les champs requis pour Visa/Mastercard ou PayPal.");
                return false;
            }
        } else if (selectedMethod === 'Wave' || selectedMethod === 'Orange Money') {
            var telephone = document.getElementById('numero_tel').value;
    
            if (!telephone) {
                alert("Veuillez entrer un numéro de téléphone pour Wave ou Orange Money.");
                return false;
            }
        } else {
            alert("Veuillez choisir une méthode de paiement.");
            return false;
        }
    
        return true;
    }
    
    
    

   /* function showPaymentModal(details) {
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
    }*/
    