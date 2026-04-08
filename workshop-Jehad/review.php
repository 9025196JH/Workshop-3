<?php
// Auteur: Bashar
// Functie: Review formulier en verwerking
include_once 'functions.php';
$producten = getData('producten');
$melding = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (insertReview($_POST)) {
        $melding = 'ok|Bedankt voor uw review!';
    } else {
        $melding = 'error|Er is een fout opgetreden.';
    }
}
?>
<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <title>Review - TechZone</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php include 'nav.php'; ?>
    <div class="pagina-midden">
        <h1>Review achterlaten</h1>
        <?php if ($melding !== ''): ?>
            <?php [$type, $tekst] = explode('|', $melding, 2); ?>
            <p class="melding melding-<?php echo $type; ?>"><?php echo htmlspecialchars($tekst); ?></p>
        <?php endif; ?>

        <form method="POST" class="midden-form">
            <label for="product_id">Welk product heeft u gekocht?</label>
            <select id="product_id" name="product_id" required>
                <option value="">-- Kies een product --</option>
                <?php foreach ($producten as $p): ?>
                    <option value="<?php echo $p['product_id']; ?>"><?php echo $p['naam']; ?></option>
                <?php endforeach; ?>
            </select>

            <label for="naam">Naam:</label>
            <input type="text" id="naam" name="naam" required>

            <label for="beoordeling">Beoordeling:</label>
            <select id="beoordeling" name="beoordeling" required>
                <option value="1">1 - Slecht</option>
                <option value="2">2 - Matig</option>
                <option value="3">3 - Goed</option>
                <option value="4">4 - Zeer goed</option>
                <option value="5">5 - Uitstekend</option>
            </select>

            <label for="opmerking">Opmerking:</label>
            <textarea id="opmerking" name="opmerking" rows="5" required></textarea>

            <button type="submit" class="klant-btn">Versturen</button>
        </form>
    </div>
    <?php include 'footer.php'; ?>
</body>

</html>