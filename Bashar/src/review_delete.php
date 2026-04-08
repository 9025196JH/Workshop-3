<?php
// Auteur: Bashar Al Aboud
// Functie: review verwijderen

include_once 'functions.php';

if (isset($_GET['id'])) {
    if (deleteReview($_GET['id']) == true) {
        echo "<script>alert('Review is verwijderd')</script>";
        echo "<script>location.replace('crud_reviews.php');</script>";
    } else {
        echo "<script>alert('Review is NIET verwijderd')</script>";
    }
}
