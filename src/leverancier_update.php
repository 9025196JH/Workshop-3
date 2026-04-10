<?php
include 'functions.php';
if (isset($_POST['btn_upd'])) {
    if (updateLeverancier($_POST)) {
        echo "<script>alert('Gewijzigd!'); location.replace('crud_leverancier.php');</script>";
    }
}
$row = getLeverancier($_GET['id']);
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php include 'nav.php'; ?>
    <h1>Leverancier Wijzigen</h1>
    <form method="post">
        <input type="hidden" name="leverancier_id" value="<?php echo $row['leverancier_id']; ?>">
        <label class="admin-label">Naam:</label><input type="text" name="naam" value="<?php echo $row['naam']; ?>"><br>
        <label class="admin-label">Bedrijf:</label><input type="text" name="bedrijfsnaam" value="<?php echo $row['bedrijfsnaam']; ?>"><br>
        <label class="admin-label">Telefoon:</label><input type="text" name="telefoonnummer" value="<?php echo $row['telefoonnummer']; ?>"><br>
        <input type="submit" name="btn_upd" value="Wijzigen">
    </form>
    <?php include 'footer.php'; ?>
</body>

</html>