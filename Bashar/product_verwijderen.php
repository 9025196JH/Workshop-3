<?php
include 'connect.php';

$id = $_GET['id'];

$stmt = $conn->prepare("DELETE FROM producten WHERE product_id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->close();

header('Location: producten.php');
exit;
