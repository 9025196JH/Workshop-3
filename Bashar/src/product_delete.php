<?php
include_once 'functions.php';
if (isset($_GET['id'])) {
    if (deleteProduct($_GET['id'])) {
        echo "<script>alert('Product is verwijderd'); location.replace('crud_producten.php');</script>";
    } else {
        echo "<script>alert('Fout bij verwijderen'); location.replace('crud_producten.php');</script>";
    }
}
