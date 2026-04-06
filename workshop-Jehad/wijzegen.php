
<?php
// functie: update Brouwer
// auteur: Vul hier je naam in

require_once('functions.php');

// Test of er op de wijzig-knop is gedrukt 
if(isset($_POST['btn_wzg'])){

    // test of update gelukt is
    if(updateRecord($_POST) == true){
        echo "<script>alert('Gebruiker is gewijzigd')</script>";
    } else {
        echo '<script>alert("Gebruiker is NIET gewijzigd")</script>';
    }
}

// Test of id is meegegeven in de URL
if(isset($_GET['id'])){  
    // Haal alle info van de betreffende id $_GET['id']
    $id = $_GET['id'];
    $row = getRecord($id);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>Wijzig Brouwer</title>
</head>
<body>
  <h2>Wijzig Brouwer</h2>
  <form method="post">
    
    <input type="hidden" name="leverancier_id" value="<?php echo $row['inloggen_id']; ?>"><br>

    <label for="leverancier_id">leverancier_id</label>
    <input type="text" id="leverancier_id" name="leverancier_id" required value="<?php echo $row['leverancier_id']; ?>"><br>

    <label for="naam">Naam:</label>
    <input type="text" id="naam" name="naam" required value="<?php echo $row['naam']; ?>"><br>

    <label for="bedrijfsnaam">Bedrijfs:</label>
    <input type="text" id="bedrijfsnaam" name="bedrijfsnaam" required value="<?php echo $row['bedrijfsnaam']; ?>"><br>

    <label for="wachtwoord">Telefoonnummer:</label>
    <input type="text" id="telefoonnummer" name="telefoonnummer" required value="<?php echo $row['telefoonnummer']; ?>"><br>

    <input type="submit" name="btn_wzg" value="Wijzig">
  </form>
  <br><br>
  <a href='crud_gebruikers.php'>Home</a>
</body>
</html>

<?php
} else {
    echo "Geen id opgegeven<br>";
}
?>
