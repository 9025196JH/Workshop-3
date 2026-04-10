<?php
// auteur: Jehad
//functie: favoerite
session_start();
include_once 'functions.php';

// Initialiseer favorieten als het niet bestaat
if (!isset($_SESSION['favorieten'])) {
    $_SESSION['favorieten'] = [];
}

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = intval($_POST['product_id'] ?? 0);
    
    if ($product_id > 0) {
        $key = array_search($product_id, $_SESSION['favorieten']);
        
        if ($key !== false) {
            // Verwijder uit favorieten
            unset($_SESSION['favorieten'][$key]);
            $_SESSION['favorieten'] = array_values($_SESSION['favorieten']); // Herindexeer array
            echo json_encode(['success' => true, 'action' => 'verwijderd', 'message' => 'Product verwijderd uit favorieten']);
        } else {
            // Voeg toe aan favorieten
            $_SESSION['favorieten'][] = $product_id;
            echo json_encode(['success' => true, 'action' => 'toegevoegd', 'message' => 'Product toegevoegd aan favorieten']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Ongeldige product ID']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Ongeldige request methode']);
}
?>
