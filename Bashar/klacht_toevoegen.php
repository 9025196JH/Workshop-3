<?php
include 'connect_pdo.php';
// functie: nieuwe klacht toevoegen
// auteur: Bashar Al Aboud
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = (int)$_POST['product_id'];
    $naam = $_POST['naam'];
    $email = $_POST['email'];
    $beschrijving = $_POST['beschrijving'];
    $datum = date('Y-m-d');
    // klacht opslaan in database
    $stmt = $pdo->prepare("INSERT INTO klachten (product_id, naam, email, beschrijving, datum) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$product_id, $naam, $email, $beschrijving, $datum]);

    header("Location: klacht.php");
    exit;
}
