<?php
include 'connect.php';

$melding = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $naam = $_POST['naam'];
    $beschrijving = $_POST['beschrijving'];
    $prijs = $_POST['prijs'];
    $categorie = $_POST['categorie'];
    $foto = $_POST['foto'];
    $voorraad = $_POST['voorraad'];

    $stmt = $conn->prepare("INSERT INTO producten (naam, beschrijving, prijs, categorie, foto, voorraad) 
                           VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssdssi", $naam, $beschrijving, $prijs, $categorie, $foto, $voorraad);
    $stmt->execute();
    $stmt->close();

    $melding = 'Product succesvol toegevoegd!';
}
?>

<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <title>Product toevoegen - TechZone</title>
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
        <h1>Nieuw product toevoegen</h1>

        <?php if ($melding != ''): ?>
            <p style="color: green;"><?php echo $melding; ?></p>
        <?php endif; ?>

        <form method="POST" action="product_toevoegen.php">
            <label>Naam:</label>
            <input type="text" name="naam" required><br>

            <label>Beschrijving:</label>
            <textarea name="beschrijving"></textarea><br>

            <label>Prijs (€):</label>
            <input type="number" name="prijs" step="0.01" required><br>

            <label>Categorie:</label>
            <select name="categorie">
                <option value="Smartphone">Smartphone</option>
                <option value="Laptop">Laptop</option>
                <option value="Tablet">Tablet</option>
            </select><br>

            <label>Foto (bestandsnaam):</label>
            <input type="text" name="foto" placeholder="foto.jpg"><br>

            <label>Voorraad:</label>
            <input type="number" name="voorraad" value="0"><br>

            <button type="submit">Toevoegen</button>
            <a href="producten.php">Annuleren</a>
        </form>
    </main>

    <?php include 'footer.php'; ?>

</body>

</html>