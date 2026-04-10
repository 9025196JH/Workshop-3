<?php
// Auteur: Bashar en Bashar
// Functie: Producten pagina
session_start();
include_once 'functions.php';

$categorie = isset($_GET['categorie']) ? trim($_GET['categorie']) : '';
$zoekterm  = isset($_GET['q'])         ? trim($_GET['q'])         : '';

$producten = searchProducten($zoekterm, $categorie);

// Initialiseer winkelmandje als het niet bestaat
if (!isset($_SESSION['winkelmandje'])) {
    $_SESSION['winkelmandje'] = [];
}

// Initialiseer favorieten als het niet bestaat
if (!isset($_SESSION['favorieten'])) {
    $_SESSION['favorieten'] = [];
}
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
                            <div class="product-actions">
                                <?php
                                $isFavoriet = in_array($p['product_id'], $_SESSION['favorieten']);
                                $btnTekst = $isFavoriet ? '💔 Verwijderen' : '❤ Toevoegen';
                                $btnClass = $isFavoriet ? 'favoriet-btn actief' : 'favoriet-btn';
                                ?>
                                <button class="<?php echo $btnClass; ?>" onclick="toggleFavoriet(<?php echo $p['product_id']; ?>, this)"><?php echo $btnTekst; ?></button>
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
            document.getElementById('aantal').value = '1'; // Reset naar 1
            document.getElementById('overlay').style.display = 'block';
            document.getElementById('mandPopup').style.display = 'block';
        }

        function sluitMandPopup() {
            document.getElementById('overlay').style.display = 'none';
            document.getElementById('mandPopup').style.display = 'none';
            huidigProductId = null;
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
                if (data.success) {
                    if (data.action === 'toegevoegd') {
                        button.textContent = '💔 Verwijderen';
                        button.classList.add('actief');
                    } else {
                        button.textContent = '❤ Toevoegen';
                        button.classList.remove('actief');
                    }
                } else {
                    alert('Er ging iets mis: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Er ging iets mis.');
            });
        }

        function voegToeAanMand() {
            const aantalInput = document.getElementById('aantal');
            const aantal = parseInt(aantalInput.value);
            
            // Valideer aantal
            if (isNaN(aantal) || aantal < 1 || aantal > 10) {
                alert('Voer een aantal in tussen 1 en 10.');
                return;
            }
            
            // Verstuur naar server
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
    </script>

    <?php include 'footer.php'; ?>

</body>

</html>
