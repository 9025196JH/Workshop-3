
<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "techzone";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    $melding = "Database connectie mislukt!";
} else {
    $melding = "Database connectie succesvol!";
}

// Check of dit bestand rechtstreeks is geopend
if (basename($_SERVER['PHP_SELF']) == 'connect.php') {
    echo $melding;
}
?>