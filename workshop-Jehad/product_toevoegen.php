<?php
include 'connect.php';
// functie: product toevoegen
// auteur: Bashar Al Aboud
$melding = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $naam        = trim($_POST['naam']);
    $beschrijving = trim($_POST['beschrijving']);
    $categorie   = $_POST['categorie'];
    $prijs       = $_POST['prijs'];
    $voorraad    = (int)$_POST['voorraad'];
    $foto        = trim($_POST['foto']);
    // opslaan van nieuw product in database
    $stmt = $pdo->prepare("INSERT INTO producten (naam, beschrijving, categorie, prijs, voorraad, foto) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$naam, $beschrijving, $categorie, $prijs, $voorraad, $foto]);

    $melding = 'Product toegevoegd!';
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

        <h1>Nieuw product toevoegen</h1>

        <?php if ($melding !== ''): ?>
            <p style="color: green;"><?php echo $melding; ?></p>
        <?php endif; ?>

        <form method="POST">

            <label>Naam:</label><br>
            <input type="text" name="naam" required><br><br>

            <label>Beschrijving:</label><br>
            <textarea name="beschrijving"></textarea><br><br>

            <label>Categorie:</label><br>
            <select name="categorie">
                <option value="Laptops">Laptops</option>
                <option value="Smartphones">Smartphones</option>
                <option value="Tablets">Tablets</option>
            </select><br><br>

            <label>Prijs:</label><br>
            <input type="number" name="prijs" step="0.01" required><br><br>

            <label>Voorraad:</label><br>
            <input type="number" name="voorraad" required><br><br>

            <label>Foto (URL):</label><br>
            <input type="text" name="foto"><br><br>

            <button type="submit">Toevoegen</button>
        </form>

        <p><a href="producten.php">Terug naar producten</a></p>

    </main>

    <footer class="footer">
        <p>© 2026 Techzone. Alle rechten voorbehouden.</p>
    </footer>

</body>

</html>