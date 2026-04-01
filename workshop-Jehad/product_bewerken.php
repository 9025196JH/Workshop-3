<?php
include 'connect_pdo.php';
// functie: product bewerken
// auteur: Bashar Al Aboud
$product_id = isset($_GET['product_id']) ? (int)$_GET['product_id'] : 0;

if ($product_id <= 0) {
    echo "Ongeldig product-ID.";
    exit;
}
// ophalen van product gegevens
$stmt = $pdo->prepare("SELECT * FROM producten WHERE product_id = ?");
$stmt->execute([$product_id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {
    echo "Product niet gevonden.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $naam         = trim($_POST['naam']);
    $categorie    = $_POST['categorie'];
    $prijs        = $_POST['prijs'];
    $voorraad     = (int)$_POST['voorraad'];
    $foto         = trim($_POST['foto']);
    // product updaten in database
    $stmt = $pdo->prepare("UPDATE producten SET naam=?, categorie=?, prijs=?, voorraad=?, foto=? WHERE product_id=?");
    $stmt->execute([$naam, $categorie, $prijs, $voorraad, $foto, $product_id]);

    header("Location: producten.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <title>Product bewerken - TechZone</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <nav>
        <div class="menu">
            <a class="logo" href="homepage.php">TechZone</a>
            <a href="homepage.php">Home</a>
            <a href="producten.php">Producten</a>
            <a href="over.php">Over ons</a>
            <a href="contact.php">Contact</a>
            <a href="crud_gebruikers.php">Gebruikers beheren</a>
            <a href="klacht.php">Klacht indienen</a>
        </div>
        <div class="right-section">
            <div class="search-container">
                <input type="text" placeholder="Zoeken...">
                <span class="search-icon">🔍</span>
            </div>
            <a href="favoriet.php" class="icon">❤️</a>
            <a href="winkelmand.php" class="icon">🛒</a>
            <a href="login.php" class="icon">👤</a>
        </div>
    </nav>

    <main style="padding: 20px;">

        <h2>Product bewerken</h2>

        <form method="POST">

            <label>Naam:</label><br>
            <input type="text" name="naam" value="<?php echo htmlspecialchars($product['naam']); ?>" required><br><br>

            <label>Categorie:</label><br>
            <select name="categorie">
                <option value="Laptops" <?php echo $product['categorie'] === 'Laptops' ? 'selected' : ''; ?>>Laptops</option>
                <option value="Smartphones" <?php echo $product['categorie'] === 'Smartphones' ? 'selected' : ''; ?>>Smartphones</option>
                <option value="Tablets" <?php echo $product['categorie'] === 'Tablets' ? 'selected' : ''; ?>>Tablets</option>
            </select><br><br>

            <label>Prijs:</label><br>
            <input type="number" name="prijs" step="0.01" value="<?php echo $product['prijs']; ?>" required><br><br>

            <label>Voorraad:</label><br>
            <input type="number" name="voorraad" value="<?php echo $product['voorraad']; ?>" required><br><br>

            <label>Foto (URL):</label><br>
            <input type="text" name="foto" value="<?php echo htmlspecialchars($product['foto'] ?? ''); ?>"><br><br>

            <button type="submit">Opslaan</button>
        </form>

        <p><a href="producten.php">Terug naar producten</a></p>

    </main>

    <footer class="footer">
        <p>© 2026 Techzone. Alle rechten voorbehouden.</p>
    </footer>

</body>

</html>