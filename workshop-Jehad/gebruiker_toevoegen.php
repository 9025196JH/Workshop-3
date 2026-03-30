
<?php include 'connect.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Gebruiker toevoegen</title>
</head>
<body>

<h1>Nieuwe gebruiker toevoegen</h1>

<form method="post">
    Naam: <input type="text" name="naam" required><br><br>
    Email: <input type="email" name="email" required><br><br>
    Wachtwoord: <input type="text" name="wachtwoord" required><br><br>

    <button type="submit" name="opslaan">Opslaan</button>
</form>

<p><a href="gebruikers.php">Terug naar gebruikers</a></p>

<?php
if (isset($_POST['opslaan'])) {

    $naam = $_POST['naam'];
    $email = $_POST['email'];
    $wachtwoord = $_POST['wachtwoord'];

    $sql = "INSERT INTO gebruikers (naam, email, wachtwoord)
            VALUES ('$naam', '$email', '$wachtwoord')";

    if ($conn->query($sql)) {
        echo " Gebruiker toegevoegd!";
    } else {
        echo " Fout bij opslaan: " . htmlspecialchars($conn->error);
    }
}
?>

</body>
</html>
