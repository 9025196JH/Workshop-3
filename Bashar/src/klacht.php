<?php
// Auteur: Bashar Al Aboud
// Functie: klacht indienen als klant

include_once 'functions.php';

$melding = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $naam         = trim($_POST['naam']         ?? '');
    $email        = trim($_POST['email']        ?? '');
    $beschrijving = trim($_POST['beschrijving'] ?? '');

    if ($naam === '' || $email === '' || $beschrijving === '') {
        $melding = 'error|Vul alle verplichte velden in.';
    } else {
        if (insertKlacht($_POST) == true) {
            $melding = 'ok|Uw klacht is succesvol ingediend!';
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

            <label for="naam">Naam:</label>
            <input type="text" id="naam" name="naam" placeholder="Vul uw naam hier in!" required>

            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" placeholder="uw@email.com" required>

            <label for="beschrijving">Beschrijving:</label>
            <textarea id="beschrijving" name="beschrijving" placeholder="Beschrijf uw klacht hier" rows="5" required></textarea>

            <button type="submit" class="klant-btn">Klacht Indienen</button>

        </form>

    </div>

    <?php include 'footer.php'; ?>

</body>

</html>