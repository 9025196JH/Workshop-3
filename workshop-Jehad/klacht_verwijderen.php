<?php
include 'connect.php';
// functie: klacht verwijderen
// auteur: Bashar Al Aboud
if (isset($_GET['klacht_id'])) {
    $klacht_id = (int)$_GET['klacht_id'];
    // verwijderen van klacht via id
    $stmt = $pdo->prepare("DELETE FROM klachten WHERE klacht_id = ?");
    $stmt->execute([$klacht_id]);
}

header("Location: klacht.php");
exit;
