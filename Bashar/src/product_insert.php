<?php
// Auteur: Bashar Al Aboud
// Functie: nieuw product toevoegen

include_once 'functions.php';

if (isset($_POST['btn_ins'])) {
    if (insertProduct($_POST) == true) {
        echo "<script>alert('Product is toegevoegd')</script>";
        echo "<script>location.replace('crud_producten.php');</script>";
    } else {
        echo "<script>alert('Product is NIET toegevoegd')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <title>Product Toevoegen - TechZone</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <?php include 'nav.php'; ?>

    <h1>Nieuw Product Toevoegen</h1>

    <form method="POST">
        <label>Naam:</label>
        <input type="text" name="naam" required><br>

        <label>Categorie:</label>
        <select name="categorie">
            <option value="Laptops">Laptops</option>
            <option value="Smartphones">Smartphones</option>
            <option value="Tablets">Tablets</option>
        </select><br>

        <label>Prijs:</label>
        <input type="number" name="prijs" step="0.01" required><br>

        <label class="admin-label">Foto URL:</label>
        <input type="text" name="foto" placeholder="https://link-naar-foto.jpg"><br>

        <label>Voorraad:</label>
        <input type="number" name="voorraad" required><br>

        <button type="submit" name="btn_ins">Insert</button>
    </form>

    <br>
    <a href="crud_producten.php">Terug naar overzicht</a>
    <?php include 'footer.php'; ?>
</body>

</html>