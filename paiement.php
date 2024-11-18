<?php
include __DIR__ . '/www/config/db_connect.php';

if(isset($_POST['paie'])){
    $forfait = htmlspecialchars($_POST['forfait']);
    $montant_total = htmlspecialchars($_POST['montant_total']);
    $nom_carte = htmlspecialchars($_POST['nom_carte']);
    $numero_carte = htmlspecialchars($_POST['numero_carte']);
    $date_expiration = htmlspecialchars($_POST['date']);
    $cvv = htmlspecialchars($_POST['cvv']);
    $methode_paiement = htmlspecialchars($_POST['methode_paiement']);

    if (!empty($forfait) && !empty($montant_total) && !empty($nom_carte) && !empty($numero_carte) && !empty($date_expiration) && !empty($cvv) && !empty($methode_paiement)) {
        $sql = "INSERT INTO paiements (nom_carte, numero_carte, date_expiration, cvv, methode_paiement,montant,forfait) 
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $connexion->prepare($sql);

        if ($stmt->execute([$nom_carte, $numero_carte, $date_expiration, $cvv, $methode_paiement, $montant_total, $forfait])) {
            // Générer un numéro de facture unique
            $numero_facture = 'FAC-' . date('Ymd') . '-' . rand(1000, 9999);
            
            echo "<script>
            window.onload = function() {
                showPaymentModal({
                    message: 'Votre paiement a été effectué avec succès !',
                    numero_facture: '$numero_facture',
                    date: '" . date('d/m/Y') . "',
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
    <link rel="stylesheet" href="css/paiement.css">
    <link
    href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet"/>
    <title>Page de paiement des forfaits</title>
    <style>
        @media print {
            body * {
                visibility: hidden;
            }
            #invoice-print, #invoice-print * {
                visibility: visible;
            }
            #invoice-print {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
            }
            .no-print {
                display: none !important;
            }
        }
        
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            width: 90%;
            max-width: 500px;
        }

        #invoice-print {
            background-color: white;
            padding: 20px;
            margin: 20px 0;
            border: 1px solid #ddd;
            border-radius: 8px;
        }

        .invoice-buttons {
            display: flex;
            gap: 10px;
            margin-top: 20px;
            justify-content: center;
        }

        .invoice-buttons button {
            padding: 12px 20px;
            font-size: 1rem;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            color: white;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-print {
            background-color: #4CAF50;
        }

        .btn-download {
            background-color: #2196F3;
        }

        .btn-close {
            background-color: #f04c23;
        }

        .invoice-buttons button:hover {
            opacity: 0.9;
        }
    </style>
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
                <button class="active" onclick="selectPaymentMethod('card')"><div class="visa-mastercard"><img src="img/visa.png" alt=""><img src="img/mastercard.webp" alt=""></div><!--<i class="ri-visa-line" style="font-size: 50px;"></i><i class="ri-mastercard-fill" style="font-size: 50px;"></i>--></button>
                <button onclick="selectPaymentMethod('paypal')"><img src="img/paypal.png" style="width: 60px;" alt=""><!--<i class="ri-paypal-fill" style="font-size: 50px;"></i>--></button>
                <button onclick="selectPaymentMethod('Wave')"><img src="img/wave.png" style="width: 120px;" alt=""><!--<i class="ri-paypal-fill" style="font-size: 50px;"></i>--></button>
                <button onclick="selectPaymentMethod('Orange Money')"><img src="img/orange.png" style="width: 100px;" alt=""><!--<i class="ri-paypal-fill" style="font-size: 50px;"></i>--></button>
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
        <div id="payment-modal" class="modal">
        <div class="modal-content">
            <h3>Paiement Réussi</h3>
            <p id="payment-message"></p>
            
            <div id="invoice-print">
                <div style="text-align: center; margin-bottom: 20px;">
                    <h2>FACTURE</h2>
                    <p><strong>N° : </strong><span id="invoice-number"></span></p>
                    <p><strong>Date : </strong><span id="invoice-date"></span></p>
                </div>
                
                <div style="margin-bottom: 20px;">
                    <h4>Détails du paiement</h4>
                    <p><strong>Nom de la carte :</strong> <span id="invoice-name"></span></p>
                    <p><strong>Numéro de carte :</strong> <span id="invoice-card-number"></span></p>
                    <p><strong>Forfait choisi :</strong> <span id="invoice-plan"></span></p>
                    <p><strong>Montant payé :</strong> <span id="invoice-amount"></span> FCFA</p>
                    <p><strong>Méthode de paiement :</strong> <span id="invoice-method"></span></p>
                </div>
            </div>

            <div class="invoice-buttons no-print">
                <button class="btn-print" onclick="printInvoice()">
                    <i class="ri-printer-line"></i> Imprimer
                </button>
                <button class="btn-download" onclick="downloadInvoice()">
                    <i class="ri-download-line"></i> Télécharger
                </button>
                <button class="btn-close" onclick="closeModal()">
                    <i class="ri-close-line"></i> Fermer
                </button>
            </div>
        </div>
    </div>
    <script>
    function showPaymentModal(data) {
        document.getElementById('payment-modal').style.display = 'flex';
        document.getElementById('payment-message').textContent = data.message;
        document.getElementById('invoice-number').textContent = data.numero_facture;
        document.getElementById('invoice-date').textContent = data.date;
        document.getElementById('invoice-name').textContent = data.nom_carte;
        document.getElementById('invoice-card-number').textContent = data.numero_carte;
        document.getElementById('invoice-plan').textContent = data.forfait;
        document.getElementById('invoice-amount').textContent = data.montant_total;
        document.getElementById('invoice-method').textContent = data.methode_paiement;
    }

    function closeModal() {
        document.getElementById('payment-modal').style.display = 'none';
    }

    function printInvoice() {
        window.print();
    }

    function downloadInvoice() {
        const invoice = document.getElementById('invoice-print');
        const html = `
            <html>
                <head>
                    <title>Facture</title>
                    <style>
                        body { font-family: Arial, sans-serif; padding: 20px; }
                        h2 { text-align: center; color: #333; }
                        .invoice-content { max-width: 800px; margin: 0 auto; }
                    </style>
                </head>
                <body>
                    <div class="invoice-content">
                        ${invoice.innerHTML}
                    </div>
                </body>
            </html>
        `;
        
        const blob = new Blob([html], { type: 'text/html' });
        const a = document.createElement('a');
        a.href = URL.createObjectURL(blob);
        a.download = `facture_${document.getElementById('invoice-number').textContent}.html`;
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
        URL.revokeObjectURL(a.href);
    }
    </script>
    <script src="paiement.js"></script>
</body>
</html>
