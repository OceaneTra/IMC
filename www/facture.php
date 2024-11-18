<?php
session_start();

if (isset($_GET['file'])) {
    $file = $_GET['file'];
    $filePath = __DIR__ . '/' . $file;

    if (file_exists($filePath)) {
        // Forcer le téléchargement ou l'affichage du PDF
        header('Content-Type: application/pdf');
        header('Content-Disposition: inline; filename="' . $file . '"');
        readfile($filePath);
        exit();
    } else {
        echo "Le fichier n'a pas été trouvé.";
    }
} else {
    echo "Aucune facture disponible.";
}
?>


