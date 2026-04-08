<?php
// auteur: Jehad
//functie: favoerite
session_start();
include_once 'functions.php';

// Initialiseer favorieten als het niet bestaat
if (!isset($_SESSION['favorieten'])) {
    $_SESSION['favorieten'] = [];
}

$favorieten = $_SESSION['favorieten'];
$favoriete_producten = [];

if (!empty($favorieten)) {
    // Haal productgegevens op voor favorieten
    foreach ($favorieten as $product_id) {
        $product = getProduct($product_id);
        if ($product) {
            $favoriete_producten[] = $product;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <title>TechZone - Favorieten</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <?php include 'nav.php'; ?>

    <div class="container">
        <h1>Mijn Favorieten</h1>

        <?php if (empty($favoriete_producten)): ?>
            <p>Je hebt nog geen favoriete producten.</p>
            <p><a href="producten.php">Bekijk onze producten</a></p>
        <?php else: ?>
            <div class="product-grid">
                <?php foreach ($favoriete_producten as $p): ?>
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
                            <div class="product-actions">
                                <button class="favoriet-btn actief" onclick="toggleFavoriet(<?php echo $p['product_id']; ?>, this)">💔 Verwijderen</button>
                                <button class="mand-btn" onclick="toonMandPopup(<?php echo $p['product_id']; ?>, '<?php echo addslashes($p['naam']); ?>')">🛒 Mandje</button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- Winkelmandje popup -->
    <div class="overlay" id="overlay" onclick="sluitMandPopup()"></div>
    <div class="mand-popup" id="mandPopup">
        <h3>Product toevoegen aan mandje</h3>
        <p id="productNaam"></p>
        <label for="aantal">Aantal (1-10):</label>
        <input type="number" id="aantal" min="1" max="10" value="1" required>
        <br>
        <button onclick="voegToeAanMand()">Toevoegen</button>
        <button onclick="sluitMandPopup()">Annuleren</button>
    </div>

    <script>
        let huidigProductId = null;

        function toonMandPopup(productId, productNaam) {
            huidigProductId = productId;
            document.getElementById('productNaam').textContent = productNaam;
            document.getElementById('aantal').value = '1';
            document.getElementById('overlay').style.display = 'block';
            document.getElementById('mandPopup').style.display = 'block';
        }

        function sluitMandPopup() {
            document.getElementById('overlay').style.display = 'none';
            document.getElementById('mandPopup').style.display = 'none';
            huidigProductId = null;
        }

        function voegToeAanMand() {
            const aantalInput = document.getElementById('aantal');
            const aantal = parseInt(aantalInput.value);
            
            if (isNaN(aantal) || aantal < 1 || aantal > 10) {
                alert('Voer een aantal in tussen 1 en 10.');
                return;
            }
            
            fetch('add_to_cart.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'product_id=' + huidigProductId + '&aantal=' + aantal
            })
            .then(response => response.text())
            .then(data => {
                alert('Product toegevoegd aan mandje!');
                sluitMandPopup();
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Er ging iets mis.');
            });
        }

        function toggleFavoriet(productId, button) {
            fetch('toggle_favorite.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'product_id=' + productId
            })
            .then(response => response.json())
            .then(data => {
                if (data.success && data.action === 'verwijderd') {
                    // Verwijder product uit de lijst
                    button.closest('.product-kaart').remove();
                    
                    // Controleer of er nog producten zijn
                    const producten = document.querySelectorAll('.product-kaart');
                    if (producten.length === 0) {
                        location.reload(); // Herlaad pagina om lege staat te tonen
                    }
                    
                    alert('Product verwijderd uit favorieten!');
                } else {
                    alert('Er ging iets mis bij het verwijderen.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Er ging iets mis.');
            });
        }
    </script>

    <?php include 'footer.php'; ?>

</body>

</html>