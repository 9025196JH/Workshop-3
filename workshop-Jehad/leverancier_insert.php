<?php
include 'functions.php';
if (isset($_POST['btn_ins'])) {
    if (insertLeverancier($_POST)) {
        echo "<script>alert('Toegevoegd!'); location.replace('crud_leverancier.php');</script>";
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php include 'nav.php'; ?>
    <h1>Nieuwe Leverancier</h1>
    <form method="post">
        <label class="admin-label">Naam:</label><input type="text" name="naam" required><br>
        <label class="admin-label">Bedrijf:</label><input type="text" name="bedrijfsnaam" required><br>
        <label class="admin-label">Telefoon:</label><input type="text" name="telefoonnummer" required><br>
        <input type="submit" name="btn_ins" value="Insert">
    </form>
     <a href="crud_leverancier.php">Terug naar overzicht</a>
    <?php include 'footer.php'; ?>
</body>

</html>