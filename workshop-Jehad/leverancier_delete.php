<?php
include 'functions.php';
if (isset($_GET['id'])) {
    if (deleteLeverancier($_GET['id'])) {
        header("Location: crud_leverancier.php");
    }
}
?>