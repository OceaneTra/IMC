<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start(); // Démarre la session

require_once __DIR__ . '/vendor/autoload.php'; // Inclure mPDF

require 'config/db_connect.php'; 

if (isset($_POST['paie'])) {
    // Récupère les données du formulaire
    $forfait = htmlspecialchars($_POST['forfait']);
    $montant_total = htmlspecialchars($_POST['montant_total']);
    $methode_paiement = htmlspecialchars($_POST['methode_paiement']);

    // Champs spécifiques selon la méthode de paiement
    $nom = isset($_POST['nom']) ? htmlspecialchars($_POST['nom']) : null;
    $adresse = isset($_POST['adresse']) ? htmlspecialchars($_POST['adresse']) : null;
    $numero_carte = isset($_POST['numero_carte']) ? htmlspecialchars($_POST['numero_carte']) : null;
    $date_expiration = isset($_POST['date']) ? htmlspecialchars($_POST['date']) : null;
    $cvv = isset($_POST['cvv']) ? htmlspecialchars($_POST['cvv']) : null;
    $numero_tel = isset($_POST['numero_tel']) ? htmlspecialchars($_POST['numero_tel']) : null;

    // Vérifie les champs obligatoires pour toutes les méthodes de paiement
    if (!empty($forfait) && !empty($montant_total) && !empty($methode_paiement)) {
        // Prépare la requête SQL en fonction de la méthode de paiement
        if ($methode_paiement === 'card' || $methode_paiement === 'paypal') {
            if (!empty($nom) && !empty($adresse) && !empty($numero_carte) && !empty($date_expiration) && !empty($cvv)) {
                $sql = "INSERT INTO paiements (nom, numero_carte, date_expiration, cvv, methode_paiement, montant, forfait,adresse) 
                        VALUES (?, ?, ?, ?, ?, ?, ?,?)";
                $params = [$nom, $numero_carte, $date_expiration, $cvv, $methode_paiement, $montant_total, $forfait, $adresse];
            } else {
                echo "Tous les champs pour Visa/MasterCard ou PayPal doivent être remplis.";
                exit();
            }
        } elseif ($methode_paiement === 'Wave' || $methode_paiement === 'Orange Money') {
            if (!empty($nom) && !empty($numero_tel) && !empty($adresse)) {
                $sql = "INSERT INTO paiement_mobile (nom, methode_paiement, montant, forfait, numero_tel, adresse) 
                        VALUES (?, ?, ?, ?, ?, ?)";
                $params = [$nom, $methode_paiement, $montant_total, $forfait, $numero_tel, $adresse];
            } else {
                echo "Veuillez fournir votre nom et numéro de téléphone pour Wave ou Orange Money.";
                exit();
            }
        } else {
            echo "Méthode de paiement non reconnue.";
            exit();
        }

        
        $stmt = $bdd->prepare($sql);
        if ($stmt->execute($params)) {
            // Stocke les données de la facture dans la session
            $_SESSION['facture'] = [
                'forfait' => $forfait,
                'montant_total' => $montant_total,
                'methode_paiement' => $methode_paiement,
            ];

            if ($methode_paiement === 'card' || $methode_paiement === 'paypal') {
                $_SESSION['facture']['nom'] = $nom;
                $_SESSION['facture']['adresse'] = $adresse;
                $_SESSION['facture']['numero_carte'] = $numero_carte;
                $_SESSION['facture']['date_expiration'] = $date_expiration;
            } elseif ($methode_paiement === 'Wave' || $methode_paiement === 'Orange Money') {
                $_SESSION['facture'] = [
                    'nom' => $nom,
                    'adresse' => $adresse,
                    'numero_tel' => $numero_tel,
                ];
            }

            // Prépare le contenu du PDF
            $html = "
            <style>
                body {
                    font-family: Arial, sans-serif;
                    color: #333;
                }
                h1 {
                    color: #5e8fca;
                    text-align: center;
                }
                .invoice-details {
                    margin-top: 20px;
                }
                .invoice-details p {
                    font-size: 14px;
                }
                .total-amount {
                    font-weight: bold;
                    font-size: 16px;
                    color: #FF5722;
                }
            </style>
            <div style='text-align: center;'>
                <img src='Images/imc.png' alt='Logo' width='150' height='auto' />
            </div>
            <h1>Facture de Paiement</h1>
            <div class='invoice-details'>
                <p><strong>Forfait :</strong> {$forfait}</p>
                <p class='total-amount'><strong>Montant Total :</strong> {$montant_total} FCFA</p>
                <p><strong>Méthode de Paiement :</strong> {$methode_paiement}</p>";

            if ($methode_paiement === 'card' || $methode_paiement === 'paypal') {
                $html .= "
                <p><strong>Nom de l'acheteur :</strong> {$nom}</p>
                 <p><strong>Adresse de l'acheteur :</strong> {$adresse}</p>
                <p><strong>Numéro de Carte :</strong> **** **** **** " . substr($numero_carte, -4) . "</p>
                <p><strong>Date d'Expiration :</strong> {$date_expiration}</p>";
            } elseif ($methode_paiement === 'Wave' || $methode_paiement === 'Orange Money') {
                $html .= "
                <p><strong>Nom de l'acheteur :</strong> {$nom}</p>
                <p><strong>Numéro de Téléphone :</strong> {$numero_tel}</p>
                <p><strong>Adresse :</strong> {$adresse}</p>";
            }
            

            $html .= "
            </div>
            <hr>
            <p style='text-align: center;'>Merci pour votre paiement.</p>";

            // Crée un nouvel objet mPDF
            $mpdf = new \Mpdf\Mpdf();

            try {
                // Ajoute le contenu HTML dans le PDF
                $mpdf->WriteHTML($html);

                // Sauvegarder le PDF dans un fichier
                $fileName = 'facture-' . time() . '.pdf';
                $mpdf->Output(__DIR__ . '/' . $fileName, \Mpdf\Output\Destination::FILE);

                // Rediriger vers la page de la facture PDF
                header("Location: facture.php?file=$fileName");
                exit();
            } catch (\Mpdf\MpdfException $e) {
                echo "Erreur lors de la génération du PDF : " . $e->getMessage();
            }
        } else {
            $errorInfo = $stmt->errorInfo();
            echo "Erreur SQL : " . $errorInfo[2];
        }
    } else {
        echo "Veuillez remplir tous les champs obligatoires.";
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
                <button onclick="selectPaymentMethod('Wave')"><img src="Images/wave.png" style="width: 120px;" alt=""><!--<i class="ri-paypal-fill" style="font-size: 50px;"></i>--></button>
                <button onclick="selectPaymentMethod('Orange Money')"><img src="Images/orange.png" style="width: 100px;" alt=""><!--<i class="ri-paypal-fill" style="font-size: 50px;"></i>--></button>
            </div>

            <form action=""  method="POST"  class="payment-form" onsubmit="return validateForm();">
                 <!-- Champ caché pour le montant total -->
                <input type="hidden" name="montant_total" id="montant_total" value="0">
                <!-- Champ caché pour le type de forfait -->
                <input type="hidden" name="forfait" id="forfait" value="">
                <input type="text" id="nom" name="nom" placeholder="Nom de la clinique" required>
                <input type="text" id="adresse" name="adresse" placeholder="Adresse de la clinique" required>
                <div  id="carte-details" style="display: block;">
                <input type="text" id="numero_carte" name="numero_carte" placeholder="Numero de la carte" required>
                <div style="display: flex; gap: 10px;">
                    <input type="text" id="date" name="date" placeholder="Date d'expiration (MM/YY)" required>
                    <input type="text" id="cvv" name="cvv" placeholder="CVV" required>
                </div>
                </div>
                <div id="phone-number-fields" style="display: none;">
                     <label for="numero_tel">Numéro de téléphone :</label>
                     <input type="text" id="numero_tel" name="numero_tel"><br>
                </div>
                <input type="hidden" name="methode_paiement" id="methode_paiement" value="Visa/Mastercard">
                <button type="submit" name="paie">Effectuer le paiement<i class="ri-arrow-right-line"></i></button>
            </form>
        </div>
        <!-- Boîte de dialogue pour la confirmation -->
             <!--<div id="payment-modal" class="modal" style="display: none;">
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
              </div>-->

       
    </div>
    <script src="paiement.js"></script>
</body>
</html>
