
<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "techzone";

try {
    // Maak PDO connectie
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);

    // Zet foutmodus op exceptions (belangrijk!)
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $melding = "Database connectie succesvol!";

} catch (PDOException $e) {
    $melding = "Database connectie mislukt!";
}

// Check of dit bestand rechtstreeks is geopend
if (basename($_SERVER['PHP_SELF']) == 'connect.php') {
    echo $melding;
}
?>
