<?php
include 'connect.php';
// functie: product verwijderen
// auteur: Bashar Al Aboud
if (isset($_GET['product_id'])) {
    $product_id = (int)$_GET['product_id'];
    // verwijderen van product via id
    $stmt = $pdo->prepare("DELETE FROM producten WHERE product_id = ?");
    $stmt->execute([$product_id]);
}

header("Location: producten.php");
exit;
