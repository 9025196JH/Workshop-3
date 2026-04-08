<?php
// Auteur: Bashar
// Functie: Product wijzigen in database
include_once 'functions.php';

if (isset($_POST['btn_upd'])) {
    if (updateProduct($_POST)) {
        echo "<script>alert('Product is gewijzigd'); location.replace('crud_producten.php');</script>";
    } else {
        echo "<script>alert('Fout bij wijzigen');</script>";
    }
}

if (isset($_GET['id'])) {
    $product = getProduct($_GET['id']);
} else {
    header("Location: crud_producten.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <title>Product Wijzigen</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php include 'nav.php'; ?>

    <h1>Product Wijzigen</h1>

    <form method="post">
        <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">

        <label class="admin-label">Naam:</label>
        <input type="text" name="naam" value="<?php echo $product['naam']; ?>" required><br>

        <label class="admin-label">Categorie:</label>
        <select name="categorie" required>
            <option value="Smartphones" <?php if ($product['categorie'] == 'Smartphones') echo 'selected'; ?>>Smartphones</option>
            <option value="Laptops" <?php if ($product['categorie'] == 'Laptops') echo 'selected'; ?>>Laptops</option>
            <option value="Tablets" <?php if ($product['categorie'] == 'Tablets') echo 'selected'; ?>>Tablets</option>
        </select><br>

        <label class="admin-label">Prijs:</label>
        <input type="number" name="prijs" step="0.01" value="<?php echo $product['prijs']; ?>" required><br>

        <label class="admin-label">Foto:</label>
        <input type="text" name="foto" value="<?php echo $product['foto']; ?>"><br>

        <label class="admin-label">Voorraad:</label>
        <input type="number" name="voorraad" value="<?php echo $product['voorraad']; ?>" required><br>

        <input type="submit" name="btn_upd" value="Wijzigen">
    </form>

    <br>
    <a href="crud_producten.php">Terug naar overzicht</a>

    <?php include 'footer.php'; ?>
</body>

</html>