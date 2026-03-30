<?php
include 'connect.php';

// Zoekfunctie
$zoek = '';
if (isset($_GET['zoek'])) {
    $zoek = $_GET['zoek'];
}

// Filterfunctie
$categorie = '';
if (isset($_GET['categorie'])) {
    $categorie = $_GET['categorie'];
}

// Query opbouwen
$producten = [];
if ($zoek != '' && $categorie != '') {
    $stmt = $conn->prepare("SELECT * FROM producten WHERE naam LIKE ? AND categorie = ?");
    $searchTerm = '%' . $zoek . '%';
    $stmt->bind_param("ss", $searchTerm, $categorie);
    $stmt->execute();
    $result = $stmt->get_result();
    $producten = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
} elseif ($zoek != '') {
    $stmt = $conn->prepare("SELECT * FROM producten WHERE naam LIKE ?");
    $searchTerm = '%' . $zoek . '%';
    $stmt->bind_param("s", $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();
    $producten = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
} elseif ($categorie != '') {
    $stmt = $conn->prepare("SELECT * FROM producten WHERE categorie = ?");
    $stmt->bind_param("s", $categorie);
    $stmt->execute();
    $result = $stmt->get_result();
    $producten = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
} else {
    $result = $conn->query("SELECT * FROM producten");
    $producten = $result->fetch_all(MYSQLI_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Producten - TechZone</title>
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
    <!-- Producten tonen -->
    <div class="producten-grid">
        <?php foreach ($producten as $product): ?>
        <div class="product-kaart">
            <img src="fotos/<?php echo htmlspecialchars($product['foto']); ?>" alt="<?php echo htmlspecialchars($product['naam']); ?>">
            <h2><?php echo htmlspecialchars($product['naam']); ?></h2>
            <p><?php echo htmlspecialchars($product['beschrijving']); ?></p>
            <p><strong>€<?php echo number_format($product['prijs'], 2, ',', '.'); ?></strong></p>
            <p>Categorie: <?php echo htmlspecialchars($product['categorie']); ?></p>
            <a href="product_bewerken.php?id=<?php echo $product['product_id']; ?>">Bewerken</a>
            <a href="product_verwijderen.php?id=<?php echo $product['product_id']; ?>" 
               onclick="return confirm('Weet je het zeker?')">Verwijderen</a>
        </div>
        <?php endforeach; ?>
    </div>

    <a href="product_toevoegen.php">+ Nieuw product toevoegen</a>
</main>

<?php include 'footer.php'; ?>

</body>
</html>