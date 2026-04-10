<?php
// Auteur: Bashar
// Functie: (CRUD) klacht verwijderen
include_once 'functions.php';

if (isset($_GET['id'])) {
    if (deleteKlacht($_GET['id']) == true) {
        echo "<script>alert('Klacht is verwijderd')</script>";
        echo "<script>location.replace('crud_klachten.php');</script>";
    } else {
        echo "<script>alert('Klacht is NIET verwijderd')</script>";
    }
}
