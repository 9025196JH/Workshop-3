
<?php include 'connect.php'; ?>
// functie: gebruiker verwijderen
// atheur: Jehad Abo Haijaa

<?php
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id <= 0) {
    echo "Ongeldig gebruikers-ID.";
    exit;
}

$sql = "DELETE FROM gebruikers WHERE inloggen_id = $id";

if ($conn->query($sql)) {
    echo " Gebruiker verwijderd!";
} else {
    echo " Fout bij verwijderen: " . htmlspecialchars($conn->error);
}

echo '<p><a href="crud_gebruikers.php">Terug naar gebruikers</a></p>';
?>

