<?php
// Auteur: Bashar
include_once 'functions.php';
$producten = getData('producten');
$melding = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (insertKlacht($_POST)) {
        $melding = 'ok|Uw klacht is succesvol ingediend!';
    } else {
        $melding = 'error|Er is een fout opgetreden.';
    }
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
    <?php include 'nav.php'; ?>
    <div class="pagina-midden">
        <h1>Klacht indienen</h1>
        <?php if ($melding !== ''): ?>
            <?php [$type, $tekst] = explode('|', $melding, 2); ?>
            <p class="melding melding-<?php echo $type; ?>"><?php echo htmlspecialchars($tekst); ?></p>
        <?php endif; ?>

        <form method="POST" class="midden-form">
            <label for="product_id">Over welk product gaat uw klacht?</label>
            <select id="product_id" name="product_id" required>
                <option value="">-- Kies een product --</option>
                <?php foreach ($producten as $p): ?>
                    <option value="<?php echo $p['product_id']; ?>"><?php echo $p['naam']; ?></option>
                <?php endforeach; ?>
            </select>

            <label for="naam">Naam:</label>
            <input type="text" id="naam" name="naam" required>

            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" required>

            <label for="beschrijving">Beschrijving:</label>
            <textarea id="beschrijving" name="beschrijving" rows="5" required></textarea>

            <button type="submit" class="klant-btn">Klacht Indienen</button>
        </form>
    </div>
    <?php include 'footer.php'; ?>
</body>

</html>