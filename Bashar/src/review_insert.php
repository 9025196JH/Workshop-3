<?php
// Auteur: Bashar Al Aboud
// Functie: nieuwe review toevoegen

include_once 'functions.php';

if (isset($_POST['btn_ins'])) {
    if (insertReview($_POST) == true) {
        echo "<script>alert('Review is toegevoegd')</script>";
        echo "<script>location.replace('crud_reviews.php');</script>";
    } else {
        echo "<script>alert('Review is NIET toegevoegd')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <title>Review Toevoegen - TechZone</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <?php include 'nav.php'; ?>

    <h1>Nieuwe Review Toevoegen</h1>

    <form method="POST">
        <label>Naam:</label>
        <input type="text" name="naam" required><br>

        <label>Beoordeling:</label>
        <select name="beoordeling">
            <option value="1">1 - Slecht</option>
            <option value="2">2 - Matig</option>
            <option value="3">3 - Goed</option>
            <option value="4">4 - Zeer goed</option>
            <option value="5">5 - Uitstekend</option>
        </select><br>

        <label>Opmerking:</label>
        <textarea name="opmerking" required></textarea><br>

        <button type="submit" name="btn_ins">Insert</button>
    </form>

    <br>
    <a href="crud_reviews.php">Terug naar overzicht</a>
    <?php include 'footer.php'; ?>
</body>

</html>