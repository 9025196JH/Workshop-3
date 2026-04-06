
<?php
require_once('func.php');

// Als er op de wijzig-knop is gedrukt
if (isset($_POST['btn_wzg'])) {

    if (updateRecord($_POST) == true) {
        echo "<script>alert('Leverancier is gewijzigd')</script>";
    } else {
        echo "<script>alert('Leverancier is NIET gewijzigd')</script>";
    }
}

// Check of ID bestaat
if (isset($_GET['id'])) {
    
    $id = $_GET['id'];
    $row = getRecord($id);
?>
<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>Wijzig Leverancier</title>
</head>
<body>

  <h2>Wijzig Leverancier</h2>

  <form method="post">

    <!-- Alleen verborgen ID -->
    <input type="hidden" name="leverancier_id" value="<?php echo $row['leverancier_id']; ?>">

    <label for="naam">Naam:</label>
    <input type="text" id="naam" name="naam" required value="<?php echo $row['naam']; ?>"><br>

    <label for="bedrijfsnaam">Bedrijfsnaam:</label>
    <input type="text" id="bedrijfsnaam" name="bedrijfsnaam" required value="<?php echo $row['bedrijfsnaam']; ?>"><br>

    <label for="telefoonnummer">Telefoonnummer:</label>
    <input type="text" id="telefoonnummer" name="telefoonnummer" required value="<?php echo $row['telefoonnummer']; ?>"><br>

    <input type="submit" name="btn_wzg" value="Wijzig">
  </form>

  <br><br>
  <a href='crud_leverancier.php'>Home</a>

</body>
</html>

<?php
} else {
    echo "Geen id opgegeven<br>";
}
?>
