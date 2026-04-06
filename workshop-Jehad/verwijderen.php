<?php
// auteur: Vul hier je naam in
// functie: verwijder een bier op basis van de id
include 'func.php';

// Haal bier uit de database
if(isset($_GET['id'])){

    // test of insert gelukt is
    if(deleteRecord($_GET['id']) == true){
        echo '<script>alert("Gebruiker ID: ' . $_GET['id'] . ' is verwijderd")</script>';
        echo "<script> location.replace('crud_gebruikers.php'); </script>";
    } else {
        echo '<script>alert("Gebruiker is NIET verwijderd")</script>';
    }
}
?>