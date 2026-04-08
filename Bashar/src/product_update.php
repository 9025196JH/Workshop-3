<?php
// Auteur: Bashar Al Aboud
// Functie: bestaand product wijzigen

include_once 'functions.php';

if (isset($_POST['btn_upd'])) {
    if (updateProduct($_POST) == true) {
        echo "<script>alert('Product is gewijzigd')</script>";
        echo "<script>location.replace('crud_producten.php');</script>";
    } else {
        echo "<script>alert('Product is NIET gewijzigd')</script>";
    }
}

if (!isset($_GET['id'])) {
    header("Location: crud_producten.php");
    exit();
}

$product = getProduct($_GET['id']);
?>

<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <title>Product Wijzigen - TechZone</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <?php include 'nav.php'; ?>

    <h1>Product Wijzigen</h1>

    <form method="POST" action="product_update.php?id=<?php echo $product['product_id']; ?>">
        <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">

        <label>Naam:</label>
        <input type="text" name="naam" value="<?php echo htmlspecialchars($product['naam']); ?>" required><br>

        <label>Categorie:</label>
        <select name="categorie">
            <option value="Laptops" <?php echo $product['categorie'] === 'Laptops'     ? 'selected' : ''; ?>>Laptops</option>
            <option value="Smartphones" <?php echo $product['categorie'] === 'Smartphones' ? 'selected' : ''; ?>>Smartphones</option>
            <option value="Tablets" <?php echo $product['categorie'] === 'Tablets'     ? 'selected' : ''; ?>>Tablets</option>
        </select><br>

        <label>Prijs:</label>
        <input type="number" name="prijs" step="0.01" value="<?php echo $product['prijs']; ?>" required><br>

        <label class="admin-label">Foto URL:</label>
        <input type="text" name="foto" value="<?php echo $product['foto']; ?>"><br>

        <label>Voorraad:</label>
        <input type="number" name="voorraad" value="<?php echo $product['voorraad']; ?>" required><br>

        <button type="submit" name="btn_upd">Opslaan</button>
    </form>

    <br>
    <a href="crud_producten.php">Terug naar overzicht</a>
    <?php include 'footer.php'; ?>
</body>

</html>