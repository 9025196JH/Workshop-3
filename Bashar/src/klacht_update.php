<?php
// Auteur: Bashar Al Aboud
// Functie: bestaande klacht wijzigen

include_once 'functions.php';

if (isset($_POST['btn_upd'])) {
    if (updateKlacht($_POST) == true) {
        echo "<script>alert('Klacht is gewijzigd')</script>";
        echo "<script>location.replace('crud_klachten.php');</script>";
    } else {
        echo "<script>alert('Klacht is NIET gewijzigd')</script>";
    }
}

if (!isset($_GET['id'])) {
    header("Location: crud_klachten.php");
    exit();
}

$klacht = getKlacht($_GET['id']);
?>

<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <title>Klacht Wijzigen - TechZone</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <?php include 'nav.php'; ?>

    <h1>Klacht Wijzigen</h1>

    <form method="POST" action="klacht_update.php?id=<?php echo $klacht['klacht_id']; ?>">
        <input type="hidden" name="klacht_id" value="<?php echo $klacht['klacht_id']; ?>">

        <label>Naam:</label>
        <input type="text" name="naam" value="<?php echo htmlspecialchars($klacht['naam']); ?>" required><br>

        <label>Email:</label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($klacht['email']); ?>" required><br>

        <label>Beschrijving:</label>
        <textarea name="beschrijving" required><?php echo htmlspecialchars($klacht['beschrijving']); ?></textarea><br>

        <button type="submit" name="btn_upd">Opslaan</button>
    </form>

    <br>
    <a href="crud_klachten.php">Terug naar overzicht</a>
    <?php include 'footer.php'; ?>
</body>

</html>