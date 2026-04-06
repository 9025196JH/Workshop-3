<?php
// functie: formulier en database insert
// auteur: Jehad

echo "<h1>Nieuwe gebruiker toevoegen</h1>";

require_once('functions.php');
     
// Test of er op de insert-knop is gedrukt 
if(isset($_POST) && isset($_POST['btn_ins'])){
    

    // test of insert gelukt is
    if(insertRecord($_POST) == true){
        echo "<script>alert('Gebruiker is toegevoegd')</script>";
    } else {
        echo "<script>alert('Gebruiker is NIET toegevoegd')</script>";
    }
}
?>
<html>
<body>
    <form method="post">

    <label for="naam">Naam:</label>
    <input type="text" id="naam" name="naam" required><br>

    <label for="bedrijfsnaam">Bedrijfsnaam:</label>
    <input type="text" id="bedrijfsnaam" name="bedrijfsnaam" required><br>

    <label for="telefoonnummer">Telefoonnummer:</label>
    <input type="text" id="telefoonnummer" name="telefoonnummer" required><br>

    <input type="submit" name="btn_ins" value="Insert">
    </form>
    
    <br><br>
    <a href='crud_gebruikers.php'>Home</a>
</body>
</html>