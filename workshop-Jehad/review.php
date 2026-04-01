<?php

include 'connect.php';
// functie: review toevoegen en tonen
$melding = '';
// verwerking van review formulier
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $naam        = trim($_POST['naam']);
    $beoordeling = (int)$_POST['beoordeling'];
    $opmerking   = trim($_POST['opmerking']);
    $datum       = date('Y-m-d');
    $product_id  = isset($_POST['product_id']) ? (int)$_POST['product_id'] : 1;

    if ($naam === '' || $opmerking === '') {
        $melding = 'Vul alle verplichte velden in.';
    } else {
        $stmt = $pdo->prepare("INSERT INTO reviews (naam, beoordeling, opmerking, datum, product_id) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$naam, $beoordeling, $opmerking, $datum, $product_id]);

        header("Location: review.php?success=1");
        exit;
    }
}
// ophalen van alle reviews uit database en weergeven in een tabel
$reviews = $pdo->query("SELECT * FROM reviews")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <title>Reviews - TechZone</title>
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

        <h1>Review achterlaten</h1>

        <?php if (isset($_GET['success'])): ?>
            <p style="color: green;">Review succesvol toegevoegd!</p>
        <?php endif; ?>

        <?php if ($melding !== ''): ?>
            <p style="color: <?php echo strpos($melding, 'succes') !== false ? 'green' : 'red'; ?>;">
                <?php echo htmlspecialchars($melding); ?>
            </p>
        <?php endif; ?>

        <form method="POST">
            <?php
            $product_id = isset($_GET['product_id']) ? (int)$_GET['product_id'] : 1;
            ?>
            <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
            <label>Naam:</label><br>
            <input type="text" name="naam" required><br><br>

            <label>Beoordeling:</label><br>
            <select name="beoordeling">
                <option value="1">1 - Slecht</option>
                <option value="2">2 - Matig</option>
                <option value="3">3 - Goed</option>
                <option value="4">4 - Zeer goed</option>
                <option value="5">5 - Uitstekend</option>
            </select><br><br>

            <label>Opmerking:</label><br>
            <textarea name="opmerking" required></textarea><br><br>

            <button type="submit">Versturen</button>
        </form>

        <hr>

        <h2>Alle reviews</h2>

        <table border="1" cellpadding="10">
            <tr>
                <th>naam</th>
                <th>beoordeling</th>
                <th>opmerking</th>
                <th>datum</th>
            </tr>

            <?php if (empty($reviews)): ?>
                <tr>
                    <td colspan="4">Geen reviews gevonden.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($reviews as $row): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['naam']); ?></td>
                        <td><?php echo $row['beoordeling']; ?>/5</td>
                        <td><?php echo htmlspecialchars($row['opmerking']); ?></td>
                        <td><?php echo $row['datum']; ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>

        </table>

    </main>

    <footer class="footer">
        <p>© 2026 Techzone. Alle rechten voorbehouden.</p>
    </footer>

</body>

</html>