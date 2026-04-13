<?php
// Auteur: Bashar
// Functie: Bijvoorbeeld een reactie op een klacht bewerken
include_once 'functions.php';
$producten = getData('producten');

if (isset($_POST['btn_upd'])) {
    if (updateKlacht($_POST)) {
        echo "<script>alert('Klacht is succesvol bewerkt'); location.replace('crud_klachten.php');</script>";
    } else {
        echo "<script>alert('Fout bij bewerken');</script>";
    }
}

if (isset($_GET['id'])) {
    $klacht = getKlacht($_GET['id']);
} else {
    header("Location: crud_klachten.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Klacht Beantwoorden</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'nav.php'; ?>

    <h1>Klacht Bewerken</h1>

    <form method="post">
        <input type="hidden" name="klacht_id" value="<?php echo $klacht['klacht_id']; ?>">

        <label class="admin-label">Product:</label>
        <select name="product_id" required>
            <?php foreach ($producten as $p): ?>
                <option value="<?php echo $p['product_id']; ?>" <?php if ($p['product_id'] == $klacht['product_id']) echo 'selected'; ?>>
                    <?php echo $p['naam']; ?>
                </option>
            <?php endforeach; ?>
        </select><br>

        <label class="admin-label">Naam:</label>
        <input type="text" name="naam" value="<?php echo $klacht['naam']; ?>" required><br>

        <label class="admin-label">Email:</label>
        <input type="email" name="email" value="<?php echo $klacht['email']; ?>" required><br>

        <label class="admin-label">Klacht:</label>
        <textarea name="beschrijving" required><?php echo $klacht['beschrijving']; ?></textarea><br>

        <label class="admin-label" style="background-color: #ffeb3b;">Admin Antwoord:</label>
        <textarea name="admin_antwoord" placeholder="Schrijf hier uw reactie naar de klant..."><?php echo $klacht['admin_antwoord']; ?></textarea><br>

        <input type="submit" name="btn_upd" value="Opslaan">
    </form>

    <br>
    <a href="crud_klachten.php">Terug naar overzicht</a>
    <?php include 'footer.php'; ?>
</body>
</html>
