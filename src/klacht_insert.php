<?php
// Auteur: Bashar Al Aboud
// Functie: (CRUD) Bijvoorbeeld een reactie toevoegen op een klacht van een klant
include_once 'functions.php';

$producten = getData('producten');

if (isset($_POST['btn_ins'])) {
    if (insertKlacht($_POST)) {
        echo "<script>alert('Klacht is toegevoegd'); location.replace('crud_klachten.php');</script>";
    } else {
        echo "<script>alert('Fout bij toevoegen');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Klacht Toevoegen</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'nav.php'; ?>

    <h1>Nieuwe Klacht Toevoegen</h1>

    <form method="post">

        <label class="admin-label">Product:</label>
        <select name="product_id" required>
            <option value="">-- Kies een product --</option>
            <?php foreach($producten as $p): ?>
                <option value="<?php echo $p['product_id']; ?>">
                    <?php echo $p['naam']; ?>
                </option>
            <?php endforeach; ?>
        </select><br>

        <label class="admin-label">Naam:</label>
        <input type="text" name="naam" required><br>

        <label class="admin-label">Email:</label>
        <input type="email" name="email" required><br>

        <label class="admin-label">Beschrijving:</label>
        <textarea name="beschrijving" required></textarea><br>

        <input type="submit" name="btn_ins" value="Insert">
    </form>

    <br>
    <a href="crud_klachten.php">Terug naar overzicht</a>

    <?php include 'footer.php'; ?>
</body>
</html>
