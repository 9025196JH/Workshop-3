<?php
// auteur: Jehad
//functie: winkelmandje
session_start();
include_once 'functions.php';

// Initialiseer winkelmandje als het niet bestaat
if (!isset($_SESSION['winkelmandje'])) {
    $_SESSION['winkelmandje'] = [];
}

// Als bestellen is aangeklikt
if (isset($_POST['bestellen'])) {
    // Leeg mandje na bestelling
    $_SESSION['winkelmandje'] = [];
    $besteld = true;
}

// Als verwijderen is aangeklikt
if (isset($_POST['verwijder'])) {
    $product_id = $_POST['product_id'];
    if (isset($_SESSION['winkelmandje'][$product_id])) {
        unset($_SESSION['winkelmandje'][$product_id]);
    }
}

$mandje = $_SESSION['winkelmandje'];
$totaal = 0;
foreach ($mandje as $item) {
    $totaal += $item['prijs'] * $item['aantal'];
}
?>
<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <title>TechZone - Winkelmandje</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <?php include 'nav.php'; ?>

    <div class="mandje-container">
        <h1>Winkelmandje</h1>

        <?php if (isset($besteld)): ?>
            <div class="bedankt">
                <h2>Dank u wel voor uw bestelling!</h2>
                <p>Uw bestelling is succesvol geplaatst.</p>
                <a href="producten.php">Verder winkelen</a>
            </div>
        <?php elseif (empty($mandje)): ?>
            <div class="leeg-mandje">
                <h2>Uw mandje is leeg</h2>
                <p><a href="producten.php">Bekijk onze producten</a></p>
            </div>
        <?php else: ?>
            <?php foreach ($mandje as $product_id => $item): ?>
                <div class="mandje-item">
                    <div>
                        <h4><?php echo htmlspecialchars($item['naam']); ?></h4>
                        <p>Aantal: <?php echo $item['aantal']; ?> x €<?php echo number_format($item['prijs'], 2, ',', '.'); ?></p>
                    </div>
                    <div>
                        <strong>€<?php echo number_format($item['prijs'] * $item['aantal'], 2, ',', '.'); ?></strong>
                        <form method="post" style="display: inline;">
                            <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                            <button type="submit" name="verwijder" class="verwijder-btn">Verwijder</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>

            <div class="mandje-totaal">
                Totaal: €<?php echo number_format($totaal, 2, ',', '.'); ?>
            </div>

            <form method="post">
                <button type="submit" name="bestellen" class="bestel-btn">Bestellen</button>
            </form>
        <?php endif; ?>
    </div>

    <?php include 'footer.php'; ?>

</body>

</html>