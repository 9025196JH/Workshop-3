<?php
// Auteur: Bashar Al Aboud
// Functie: nieuwe klacht toevoegen

include_once 'functions.php';

if (isset($_POST['btn_ins'])) {
    if (insertKlacht($_POST) == true) {
        echo "<script>alert('Klacht is toegevoegd')</script>";
        echo "<script>location.replace('crud_klachten.php');</script>";
    } else {
        echo "<script>alert('Klacht is NIET toegevoegd')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <title>Klacht Toevoegen - TechZone</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <?php include 'nav.php'; ?>

    <h1>Nieuwe Klacht Toevoegen</h1>

    <form method="POST">
        <label>Naam:</label>
        <input type="text" name="naam" required><br>

        <label>Email:</label>
        <input type="email" name="email" required><br>

        <label>Beschrijving:</label>
        <textarea name="beschrijving" required></textarea><br>

        <button type="submit" name="btn_ins">Insert</button>
    </form>

    <br>
    <a href="crud_klachten.php">Terug naar overzicht</a>
    <?php include 'footer.php'; ?>
</body>

</html>