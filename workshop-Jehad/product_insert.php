<?php
// Auteur: Bashar
// Functie: Product toevoegen aan database
include_once 'functions.php';
$leveren = getLeveren();

if (isset($_POST['btn_ins'])) {
    if (insertProduct($_POST)) {
        echo "<script>alert('Product is toegevoegd'); location.replace('crud_producten.php');</script>";
    } else {
        echo "<script>alert('Fout bij toevoegen');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <title>Product Toevoegen</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php include 'nav.php'; ?>

    <h1>Nieuwe Product Toevoegen</h1>

    <form method="post">
        <label class="admin-label">Naam:</label>
        <input type="text" name="naam" required><br>

        <label class="admin-label">Categorie:</label>
        <select name="categorie" required>
            <option value="Smartphones">Smartphones</option>
            <option value="Laptops">Laptops</option>
            <option value="Tablets">Tablets</option>
        </select><br>

        <label class="admin-label">Prijs:</label>
        <input type="number" name="prijs" step="0.01" required><br>

        <label class="admin-label">Foto:</label>
        <input type="text" name="foto" placeholder="img/product.jpg"><br>

        <label class="admin-label">Voorraad:</label>
        <input type="number" name="voorraad" required><br>

        <input type="submit" name="btn_ins" value="Insert">

        

<label class="admin-label">Leverancier:</label>
<select name="leverancier_id" required>
    <option value="">-- Kies leverancier --</option>
    <?php foreach ($leveren as $lev): ?>
        <option value="<?= htmlspecialchars($lev['leverancier_id']) ?>">
            <?= htmlspecialchars($lev['naam']) ?>
        </option>
    <?php endforeach; ?>
</select><br>


    </form>

    <br>
    <a href="crud_producten.php">Terug naar overzicht</a>

    <?php include 'footer.php'; ?>
</body>

</html>