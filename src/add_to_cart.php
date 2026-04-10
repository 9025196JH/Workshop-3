<?php
// auteur: Jehad
//functie: winkelmandje
session_start();
include_once 'functions.php';

// Initialiseer winkelmandje als het niet bestaat
if (!isset($_SESSION['winkelmandje'])) {
    $_SESSION['winkelmandje'] = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = intval($_POST['product_id'] ?? 0);
    $aantal = intval($_POST['aantal'] ?? 1);
    
    if ($product_id > 0 && $aantal > 0) {
        // Haal productgegevens op
        $product = getProduct($product_id);
        
        if ($product) {
            // Voeg toe aan mandje of update aantal
            if (isset($_SESSION['winkelmandje'][$product_id])) {
                $_SESSION['winkelmandje'][$product_id]['aantal'] += $aantal;
            } else {
                $_SESSION['winkelmandje'][$product_id] = [
                    'naam' => $product['naam'],
                    'prijs' => $product['prijs'],
                    'aantal' => $aantal
                ];
            }
            
            echo 'success';
        } else {
            echo 'error: product niet gevonden';
        }
    } else {
        echo 'error: ongeldige gegevens';
    }
} else {
    echo 'error: ongeldige request';
}
?>