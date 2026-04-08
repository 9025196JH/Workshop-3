<?php
include_once 'functions.php';

$categorie = isset($_GET['categorie']) ? trim($_GET['categorie']) : '';
$zoekterm  = isset($_GET['q'])         ? trim($_GET['q'])         : '';

$producten = searchProducten($zoekterm, $categorie);
?>
<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <title>TechZone - Producten</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <?php include 'nav.php'; ?>

    <div class="container">
        <h1>Onze Producten</h1>

        <div style="margin-bottom: 20px;">
            <a href="producten.php">Alles</a> |
            <a href="producten.php?categorie=Smartphones">Smartphones</a> |
            <a href="producten.php?categorie=Laptops">Laptops</a> |
            <a href="producten.php?categorie=Tablets">Tablets</a>
        </div>

        <?php if (empty($producten)): ?>
            <p>Geen producten gevonden.</p>
        <?php else: ?>
            <div class="product-grid">
                <?php foreach ($producten as $p): ?>
                    <div class="product-kaart">
                        <div class="product-foto-bak">
                            <?php
                            $img_url = !empty($p['foto']) ? htmlspecialchars($p['foto']) : 'https://placehold.co/400x400?text=TechZone';
                            ?>
                            <img src="<?php echo $img_url; ?>" alt="Product Image">
                        </div>
                        <div class="product-info">
                            <h3><?php echo htmlspecialchars($p['naam']); ?></h3>
                            <p class="product-price">€ <?php echo number_format($p['prijs'], 2, ',', '.'); ?></p>
                            <button class="favoriet-btn">❤ Toevoegen</button>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

    <?php include 'footer.php'; ?>

</body>

</html>