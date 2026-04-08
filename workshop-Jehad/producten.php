<?php
// Auteur: Bashar
// Functie: Producten pagina
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

        <?php if (empty($producten)): ?>
            <p>Geen producten gevonden.</p>
        <?php else: ?>
            <div class="product-grid">
                <?php foreach ($producten as $p): ?>
                    <div class="product-kaart">
                        <div class="product-foto-bak">
                            <?php
                            $img_path = trim($p['foto'] ?? '');


                            if (empty($img_path)) {

                                if ($p['categorie'] == 'Smartphones') {
                                    $img_display = "https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?w=400";
                                } elseif ($p['categorie'] == 'Laptops') {
                                    $img_display = "https://images.unsplash.com/photo-1496181133206-80ce9b88a853?w=400";
                                } else {
                                    $img_display = "https://placehold.co/400x400?text=TechZone";
                                }
                            } else {

                                $img_display = $img_path;
                            }
                            ?>
                            <img src="<?php echo $img_display; ?>" alt="Product Foto">
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