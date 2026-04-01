<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'connect.php';

// functie: klacht toevoegen en tonen

$melding = '';
// verwerking van formulier (nieuwe klacht opslaan)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $product_id = isset($_POST['product_id']) ? (int)$_POST['product_id'] : 1;
    $naam = trim($_POST['naam']);
    $email = trim($_POST['email']);
    $beschrijving = trim($_POST['beschrijving']);
    $datum = date('Y-m-d');

    if ($product_id <= 0 || $naam === '' || $email === '' || $beschrijving === '') {
        $melding = 'Vul alle verplichte velden in.';
    } else {
        $stmt = $pdo->prepare("INSERT INTO klachten (product_id, naam, email, beschrijving, datum) VALUES (?, ?, ?, ?, ?)");

        if ($stmt->execute([$product_id, $naam, $email, $beschrijving, $datum])) {
            $melding = 'Uw klacht is succesvol ingediend!';
        } else {
            $melding = 'Fout bij opslaan.';
        }
    }
}
// ophalen van alle klachtenuit database en weergeven in een tabel
$klacht_result = $pdo->query("SELECT * FROM klachten");
?>

<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <title>Klacht indienen - TechZone</title>
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

        <h1>Klacht indienen</h1>

        <?php if ($melding !== ''): ?>
            <p style="color: <?php echo (strpos($melding, 'succes') !== false ? 'green' : 'red'); ?>;">
                <?php echo htmlspecialchars($melding); ?>
            </p>
        <?php endif; ?>

        <form method="POST">
            <?php
            $prod_id = isset($_GET['product_id']) ? (int)$_GET['product_id'] : 1;
            ?>
            <input type="hidden" name="product_id" value="<?php echo $prod_id; ?>">

            <label>Naam:</label><br>
            <input type="text" name="naam" required><br><br>

            <label>Email:</label><br>
            <input type="email" name="email" required><br><br>

            <label>Beschrijving:</label><br>
            <textarea name="beschrijving" required></textarea><br><br>

            <button type="submit">Toevoegen</button>
        </form>

        <hr>

        <h2>Alle klachten</h2>

        <table border="1" cellpadding="10">
            <tr>
                <th>klacht_id</th>
                <th>product_id</th>
                <th>naam</th>
                <th>email</th>
                <th>beschrijving</th>
                <th>datum</th>
                <th>acties</th>
            </tr>

            <?php foreach ($klacht_result as $row): ?>
                <tr>
                    <td><?php echo $row['klacht_id']; ?></td>
                    <td><?php echo $row['product_id']; ?></td>
                    <td><?php echo htmlspecialchars($row['naam']); ?></td>
                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                    <td><?php echo htmlspecialchars($row['beschrijving']); ?></td>
                    <td><?php echo $row['datum']; ?></td>
                    <td>
                        <a href="klacht_bewerken.php?klacht_id=<?php echo $row['klacht_id']; ?>">Bewerken</a> |
                        <a href="klacht_verwijderen.php?klacht_id=<?php echo $row['klacht_id']; ?>" onclick="return confirm('Weet je het zeker?')">Verwijderen</a>
                    </td>
                </tr>
            <?php endforeach; ?>

            <?php if ($klacht_result->rowCount() === 0): ?>
                <tr>
                    <td colspan="7">Geen klachten gevonden.</td>
                </tr>
            <?php endif; ?>

        </table>

    </main>

    <footer class="footer">
        <p>© 2026 Techzone. Alle rechten voorbehouden.</p>
    </footer>

</body>

</html>