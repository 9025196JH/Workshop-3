<?php
include 'connect_pdo.php';
// functie: klacht bewerken
// auteur: Bashar Al Aboud
$klacht_id = isset($_GET['klacht_id']) ? (int)$_GET['klacht_id'] : 0;

if ($klacht_id <= 0) {
    echo "Ongeldig klacht-ID.";
    exit;
}
// ophalen van klacht op basis van id
$stmt = $pdo->prepare("SELECT * FROM klachten WHERE klacht_id = ?");
$stmt->execute([$klacht_id]);
$klacht = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$klacht) {
    echo "Klacht niet gevonden.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $naam = $_POST['naam'];
    $email = $_POST['email'];
    $beschrijving = $_POST['beschrijving'];

    // update klacht in database
    $stmt = $pdo->prepare("UPDATE klachten SET naam=?, email=?, beschrijving=? WHERE klacht_id=?");
    $stmt->execute([$naam, $email, $beschrijving, $klacht_id]);

    header("Location: klacht.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <title>Bewerk klacht - TechZone</title>
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
            <a href="review.php">Review</a>
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

        <h2>Bewerk klacht</h2>

        <form method="POST">
            <label>Naam:</label><br>
            <input type="text" name="naam" value="<?php echo htmlspecialchars($klacht['naam']); ?>"><br><br>

            <label>Email:</label><br>
            <input type="email" name="email" value="<?php echo htmlspecialchars($klacht['email']); ?>"><br><br>

            <label>Beschrijving:</label><br>
            <textarea name="beschrijving"><?php echo htmlspecialchars($klacht['beschrijving']); ?></textarea><br><br>

            <button type="submit">Opslaan</button>
        </form>

        <p><a href="klacht.php">Terug naar klachten</a></p>

    </main>

    <footer class="footer">
        <p>© 2026 Techzone. Alle rechten voorbehouden.</p>
    </footer>

</body>

</html>