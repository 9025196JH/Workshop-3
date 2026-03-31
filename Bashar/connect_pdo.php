<?php
// functie: database verbinding met PDO
// auteur: Bashar Al Aboud

$pdo = new PDO("mysql:host=localhost;dbname=techzone", "root", "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
