<?php
require 'config/db_connect.php';


if(isset($_POST['paie'])){
   
    $forfait = htmlspecialchars($_POST['forfait']);
    $montant_total = htmlspecialchars($_POST['montant_total']);
    $nom_carte = htmlspecialchars($_POST['nom_carte']);
    $numero_carte = htmlspecialchars($_POST['numero_carte']);
    $date_expiration = htmlspecialchars($_POST['date']);
    $cvv = htmlspecialchars($_POST['cvv']);
    $methode_paiement = htmlspecialchars($_POST['methode_paiement']);

    if (!empty($forfait) && !empty($montant_total) && !empty($nom_carte) && !empty($numero_carte) && !empty($date_expiration) && !empty($cvv) && !empty($methode_paiement)) {
        // Préparer la requête d'insertion
        $sql = "INSERT INTO paiements (nom_carte, numero_carte, date_expiration, cvv, methode_paiement,montant,forfait) 
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $bdd->prepare($sql);
        


        // Exécuter la requête
        if ($stmt->execute([$nom_carte, $numero_carte, $date_expiration, $cvv, $methode_paiement, $montant_total, $forfait])) {
            echo "<script>
            window.onload = function() {
                showPaymentModal({
                    message: 'Votre paiement a été effectué avec succès !',
                    nom_carte: '$nom_carte',
                    numero_carte: '**** **** **** " . substr($numero_carte, -4) . "',
                    forfait: '$forfait',
                    montant_total: '$montant_total',
                    methode_paiement: '$methode_paiement'
                });
            }
            </script>";
        } else {
            echo "Erreur lors de l'insertion dans la base de données.";
        }
        
        
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="paiement.css">
    <link
    href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet"/>
    <title>Page de paiement des forfaits</title>
</head>
<body>
    <div class="container">
        <!--Section Sommaire-->
        <div class="summary">
            <h3>Choisissez votre forfait</h3>
            <!-- Options de forfaits -->
            <div class="plans">
                <div class="plan-option">
                    <input type="radio" name="plan" id="basic" value="30000" onchange="updateTotal(this)">
                    <label for="basic">Basic Plan - 30 000 FCFA</label>
                </div>
                <div class="plan-option">
                    <input type="radio" name="plan" id="business" value="60000" onchange="updateTotal(this)">
                    <label for="business">Business Plan - 60 000 FCFA</label>
                </div>
                <div class="plan-option">
                    <input type="radio" name="plan" id="enterprise" value="80000" onchange="updateTotal(this)">
                    <label for="enterprise">Entreprise Plan - 80 000 FCFA</label>
                </div>
            </div>
            <!-- Montant Total -->
            <div class="total">
                Montant Total : <span id="total-amount">0</span> FCFA
            </div>
        </div>

        <!--Payment Method Section-->

        <div class="payment-method">
            <h3>Methode de paiement</h3>
           
            <div class="payment-options">
                <button class="active" onclick="selectPaymentMethod('card')"><div class="visa-mastercard"><img src="Images/visa.png" alt=""><img src="Images/mastercard.webp" alt=""></div><!--<i class="ri-visa-line" style="font-size: 50px;"></i><i class="ri-mastercard-fill" style="font-size: 50px;"></i>--></button>
                <button onclick="selectPaymentMethod('paypal')"><img src="Images/paypal.png" style="width: 60px;" alt=""><!--<i class="ri-paypal-fill" style="font-size: 50px;"></i>--></button>
                <button onclick="selectPaymentMethod('wave')"><img src="Images/wave.png" style="width: 120px;" alt=""><!--<i class="ri-paypal-fill" style="font-size: 50px;"></i>--></button>
                <button onclick="selectPaymentMethod('orange')"><img src="Images/orange.png" style="width: 100px;" alt=""><!--<i class="ri-paypal-fill" style="font-size: 50px;"></i>--></button>
            </div>

            <form action=""  method="POST" class="payment-form">
                 <!-- Champ caché pour le montant total -->
                <input type="hidden" name="montant_total" id="montant_total" value="0">
                <!-- Champ caché pour le type de forfait -->
                <input type="hidden" name="forfait" id="forfait" value="">
                <input type="text" name="nom_carte" placeholder="Nom de la carte" required>
                <input type="text" name="numero_carte" placeholder="Numero de la carte" required>
                <div style="display: flex; gap: 10px;">
                    <input type="text" name="date" placeholder="Date d'expiration (MM/YY)" required>
                    <input type="text" name="cvv" placeholder="CVV" required>
                </div>
                <input type="hidden" name="methode_paiement" id="methode_paiement" value="Visa/Mastercard">
                <button type="submit" name="paie">Effectuer le paiement<i class="ri-arrow-right-line"></i></button>
            </form>
        </div>
        <!-- Boîte de dialogue pour la confirmation -->
             <div id="payment-modal" class="modal" style="display: none;">
                   <div class="modal-content">
                       <h3>Paiement Réussi</h3>
                       <p id="payment-message"></p>
                          <div id="invoice">
                           <h4>Facture</h4>
                            <p><strong>Nom de la carte :</strong> <span id="invoice-name"></span></p>
                            <p><strong>Numéro de la carte :</strong> <span id="invoice-card-number"></span></p>
                            <p><strong>Forfait choisi :</strong> <span id="invoice-plan"></span></p>
                            <p><strong>Montant payé :</strong> <span id="invoice-amount"></span> FCFA</p>
                            <p><strong>Méthode de paiement :</strong> <span id="invoice-method"></span></p>
                         </div>
                       <button onclick="closeModal()">Fermer</button>
                    </div>
              </div>

       
    </div>
    <script src="paiement.js"></script>
</body>
</html>
