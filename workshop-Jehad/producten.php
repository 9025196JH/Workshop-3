<?php
include 'connect.php';
// functie: producten overzicht tonen
// auteur: Bashar Al Aboud
$categorie = isset($_GET['categorie']) ? $_GET['categorie'] : '';
// ophalen van producten (met of zonder categorie filter)
if ($categorie !== '') {
    $stmt = $pdo->prepare("SELECT * FROM producten WHERE categorie = ?");
    $stmt->execute([$categorie]);
} else {
    $stmt = $pdo->query("SELECT * FROM producten");
}

$producten = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <title>Producten - TechZone</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <nav>
        <div class="menu">
            <a class="logo" href="homepage.php">TechZone</a>
            <a href="homepage.php">Home</a>

            <div class="dropdown">
                <a href="producten.php">Producten</a>
                <div class="dropdown-menu">
                    <a href="producten.php?categorie=Laptops">Laptops</a>
                    <a href="producten.php?categorie=Smartphones">Smartphones</a>
                    <a href="producten.php?categorie=Tablets">Tablets</a>
                </div>
            </div>

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

        <h1>Producten</h1>

        <table border="1" cellpadding="10">
            <tr>
                <th>product_id</th>
                <th>naam</th>
                <th>categorie</th>
                <th>prijs</th>
                <th>voorraad</th>
                <th>foto</th>
                <th>acties</th>
            </tr>

            <?php foreach ($producten as $row): ?>
                <tr>
                    <td><?php echo $row['product_id']; ?></td>
                    <td><?php echo htmlspecialchars($row['naam'] ?? ''); ?></td>
                    <td><?php echo htmlspecialchars($row['categorie'] ?? ''); ?></td>
                    <td>€<?php echo $row['prijs'] ?? '0.00'; ?></td>
                    <td><?php echo $row['voorraad'] ?? 0; ?></td>
                    <td>
                        <?php if (!empty($row['foto'])): ?>
                            <img src="<?php echo htmlspecialchars($row['foto']); ?>" width="50">
                        <?php else: ?>
                            Geen foto
                        <?php endif; ?>
                    </td>

                    <td>
                        <a href="product_bewerken.php?product_id=<?php echo $row['product_id']; ?>">Bewerken</a> |
                        <a href="product_verwijderen.php?product_id=<?php echo $row['product_id']; ?>" onclick="return confirm('Weet je het zeker?')">Verwijderen</a> |
                        <a href="klacht.php?product_id=<?php echo $row['product_id']; ?>">Klacht indienen</a> |
                        <a href="review.php?product_id=<?php echo $row['product_id']; ?>">Review</a>
                    </td>
                </tr>
            <?php endforeach; ?>

            <?php if (empty($producten)): ?>
                <tr>
                    <td colspan="7">Geen producten gevonden.</td>
                </tr>
            <?php endif; ?>

        </table>

        <br>
        <a href="product_toevoegen.php">+ Nieuw product toevoegen</a>

    </main>

    <footer class="footer">
        <p>© 2026 Techzone. Alle rechten voorbehouden.</p>
    </footer>

</body>

</html>