<?php
// Auteur: Bashar
// Functie: Review toevoegen bijvoorbeeld een reactie toevoegen op een review van een klant
include_once 'functions.php';

if (isset($_POST['btn_ins'])) {
    if (insertReview($_POST)) {
        echo "<script>alert('Review is toegevoegd'); location.replace('crud_reviews.php');</script>";
    } else {
        echo "<script>alert('Fout bij toevoegen');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Review Toevoegen</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'nav.php'; ?>

    <h1>Nieuwe Review Toevoegen</h1>

    <form method="post">
        <label class="admin-label">Naam:</label>
        <input type="text" name="naam" required><br>

        <label class="admin-label">Beoordeling:</label>
        <select name="beoordeling" required>
            <option value="1">1 - Slecht</option>
            <option value="2">2 - Matig</option>
            <option value="3">3 - Goed</option>
            <option value="4">4 - Zeer goed</option>
            <option value="5">5 - Uitstekend</option>
        </select><br>

        <label class="admin-label">Opmerking:</label>
        <textarea name="opmerking" required></textarea><br>

        <input type="submit" name="btn_ins" value="Insert">
    </form>
    <br>
    <a href="crud_reviews.php">Terug naar overzicht</a>
    <?php include 'footer.php'; ?>
</body>
</html>
