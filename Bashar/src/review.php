<?php
// Auteur: Bashar Al Aboud
// Functie: review achterlaten als klant

include_once 'functions.php';

$melding = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $naam        = trim($_POST['naam']         ?? '');
    $beoordeling = (int)($_POST['beoordeling'] ?? 0);
    $opmerking   = trim($_POST['opmerking']    ?? '');

    if ($naam === '' || $opmerking === '' || $beoordeling < 1) {
        $melding = 'error|Vul alle verplichte velden in.';
    } else {
        if (insertReview($_POST) == true) {
            header("Location: review.php?success=1");
            exit;
        } else {
            $melding = 'error|Er is een fout opgetreden. Probeer het opnieuw.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review - TechZone</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <?php include 'nav.php'; ?>

    <div class="pagina-midden">

        <h1>Review achterlaten</h1>

        <?php if (isset($_GET['success'])): ?>
            <p class="melding melding-ok">Review succesvol toegevoegd!</p>
        <?php endif; ?>

        <?php if ($melding !== ''): ?>
            <?php [$type, $tekst] = explode('|', $melding, 2); ?>
            <p class="melding melding-<?php echo $type; ?>"><?php echo htmlspecialchars($tekst); ?></p>
        <?php endif; ?>

        <form method="POST" class="midden-form">

            <label for="naam">Naam:</label>
            <input type="text" id="naam" name="naam" placeholder="Vul uw naam hier in!" required>

            <label for="beoordeling">Beoordeling:</label>
            <select id="beoordeling" name="beoordeling" required>
                <option value="">-- Kies een beoordeling --</option>
                <option value="1">1 - Slecht</option>
                <option value="2">2 - Matig</option>
                <option value="3">3 - Goed</option>
                <option value="4">4 - Zeer goed</option>
                <option value="5">5 - Uitstekend</option>
            </select>

            <label for="opmerking">Opmerking:</label>
            <textarea id="opmerking" name="opmerking" placeholder="Typ uw opmerking hier" rows="5" required></textarea>

            <button type="submit" class="klant-btn">Versturen</button>

        </form>

    </div>

    <?php include 'footer.php'; ?>

</body>

</html>