
<?php include 'connect.php'; ?>

<?php
$id = $_GET['id'];

$sql = "DELETE FROM inloggen WHERE inloggen_id = $id";

if ($conn->query($sql)) {
    echo " Gebruiker verwijderd!";
} else {
    echo " Fout bij verwijderen!";
}
?>
