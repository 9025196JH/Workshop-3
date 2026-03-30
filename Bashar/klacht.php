<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'connect.php';

$melding = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Debug stap 1: bevestig POST ontvangst
    // echo 'POST ontvangen'; exit;

    $product_id = isset($_POST['product_id']) ? (int)$_POST['product_id'] : 0;
    $naam = isset($_POST['naam']) ? trim($_POST['naam']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $beschrijving = isset($_POST['beschrijving']) ? trim($_POST['beschrijving']) : '';
    $datum = date('Y-m-d');

    if ($product_id <= 0 || $naam === '' || $email === '' || $beschrijving === '') {
        $melding = 'Vul alle verplichte velden in.';
    } else {
        $stmt = $conn->prepare("INSERT INTO klachten (product_id, naam, email, beschrijving, datum) VALUES (?, ?, ?, ?, ?)");
        if (!$stmt) {
            $melding = 'Prepare failed: ' . $conn->error;
        } else {
            $stmt->bind_param('issss', $product_id, $naam, $email, $beschrijving, $datum);
            if (!$stmt->execute()) {
                $melding = 'Execute failed: ' . $stmt->error;
            } else {
                $melding = 'Uw klacht is succesvol ingediend!';
            }
            $stmt->close();
        }
    }
}

// Producten ophalen voor dropdown
$result = $conn->query('SELECT product_id, naam FROM producten');
if (!$result) {
    $producten = [];
    $melding = 'Kan producten niet ophalen: ' . $conn->error;
} else {
    $producten = $result->fetch_all(MYSQLI_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <title>Klacht indienen - TechZone</title>
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
        <h1>Klacht indienen</h1>

        <?php if ($melding !== ''): ?>
            <p style="color: <?php echo (strpos($melding, 'succes') !== false ? 'green' : 'red'); ?>; font-weight: bold;">
                <?php echo htmlspecialchars($melding); ?>
            </p>
        <?php endif; ?>

        <form method="POST" action="klacht.php">
            <label>Product:</label>
            <select name="product_id">
                <?php foreach ($producten as $product): ?>
                    <option value="<?php echo $product['product_id']; ?>">
                        <?php echo htmlspecialchars($product['naam']); ?>
                    </option>
                <?php endforeach; ?>
            </select><br>

            <label>Uw naam:</label>
            <input type="text" name="naam" required><br>

            <label>Uw e-mailadres:</label>
            <input type="email" name="email" required><br>

            <label>Beschrijving van de klacht:</label>
            <textarea name="beschrijving" required></textarea><br>

            <button type="submit">Klacht indienen</button>
        </form>
    </main>

    <?php include 'footer.php'; ?>

</body>

</html>