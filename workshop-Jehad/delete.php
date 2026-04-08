<?php
// auteur: Vul hier je naam in
// functie: verwijder een bier op basis van de id
include 'functions.php';

// Haal bier uit de database
if(isset($_GET['id'])){

    // test of insert gelukt is
    if(deleteRecord($_GET['id']) == true){
        echo '<script>alert("Leverancier ID: ' . $_GET['id'] . ' is verwijderd")</script>';
        echo "<script> location.replace('crud_leverancier.php'); </script>";
    } else {
        echo '<script>alert("Leverancier is NIET verwijderd")</script>';
    }
}
?>