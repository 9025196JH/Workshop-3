<?php
include 'connect.php';

$id = $_GET['id'];
$melding = '';

// Haal product op
$stmt = $conn->prepare("SELECT * FROM producten WHERE product_id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();
$stmt->close();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $naam = $_POST['naam'];
    $beschrijving = $_POST['beschrijving'];
    $prijs = $_POST['prijs'];
    $categorie = $_POST['categorie'];
    $foto = $_POST['foto'];
    $voorraad = $_POST['voorraad'];

    $stmt = $conn->prepare("UPDATE producten SET naam=?, beschrijving=?, prijs=?, 
                           categorie=?, foto=?, voorraad=? WHERE product_id=?");
    $stmt->bind_param("ssdssii", $naam, $beschrijving, $prijs, $categorie, $foto, $voorraad, $id);
    $stmt->execute();
    $stmt->close();

    $melding = 'Product succesvol bijgewerkt!';

    // Ververs de productdata
    $stmt = $conn->prepare("SELECT * FROM producten WHERE product_id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();
    $stmt->close();
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

<div class="top-line">Gratis verzending bij bestellingen boven €100 | Snelle levering in heel Nederland</div>
<nav>
    <div class="navbar-left">
        <a href="index.php" class="logo">TechZone</a>
    </div>

    <div class="menu">
        <a href="index.php">Home</a>
        <a href="producten.php">Producten</a>
        <a href="over.php">Over ons</a>
        <a href="contact.php">Contact</a>
    </div>

    <div class="right-section">
        <div class="search-container">
            <span class="search-icon">🔍</span>
        </div>

        <a href="favoriet.php" class="icon">❤️</a>
        <a href="winkelmand.php" class="icon">🛒</a>
        <a href="login.php" class="icon">👤</a>
    </div>
</nav>

    <main>
        <h1>Product bewerken</h1>

        <?php if ($melding != ''): ?>
            <p style="color: green;"><?php echo $melding; ?></p>
        <?php endif; ?>

        <form method="POST" action="product_bewerken.php?id=<?php echo $id; ?>">
            <label>Naam:</label>
            <input type="text" name="naam" value="<?php echo htmlspecialchars($product['naam']); ?>" required><br>

            <label>Beschrijving:</label>
            <textarea name="beschrijving"><?php echo htmlspecialchars($product['beschrijving']); ?></textarea><br>

            <label>Prijs (€):</label>
            <input type="number" name="prijs" step="0.01" value="<?php echo $product['prijs']; ?>" required><br>

            <label>Categorie:</label>
            <select name="categorie">
                <option value="Smartphone" <?php if ($product['categorie'] == 'Smartphone') echo 'selected'; ?>>Smartphone</option>
                <option value="Laptop" <?php if ($product['categorie'] == 'Laptop') echo 'selected'; ?>>Laptop</option>
                <option value="Tablet" <?php if ($product['categorie'] == 'Tablet') echo 'selected'; ?>>Tablet</option>
            </select><br>

            <label>Foto (bestandsnaam):</label>
            <input type="text" name="foto" value="<?php echo htmlspecialchars($product['foto']); ?>"><br>

            <label>Voorraad:</label>
            <input type="number" name="voorraad" value="<?php echo $product['voorraad']; ?>"><br>

            <button type="submit">Opslaan</button>
            <a href="producten.php">Annuleren</a>
        </form>
    </main>

    <?php include 'footer.php'; ?>

</body>

</html>