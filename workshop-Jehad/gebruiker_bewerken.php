
<?php include 'connect.php'; ?>

<?php
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id <= 0) {
    echo "Ongeldig gebruikers-ID.";
    exit;
}

$result = $conn->query("SELECT * FROM gebruikers WHERE inloggen_id = $id");
if (!$result) {
    echo "Fout bij ophalen gebruiker: " . htmlspecialchars($conn->error);
    exit;
}

$gebruiker = $result->fetch_assoc();
if (!$gebruiker) {
    echo "Gebruiker niet gevonden.";
    exit;
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Gebruiker bewerken</title>
</head>
<body>

<h1>Gebruiker bewerken</h1>

<form method="post">
    Naam: <input type="text" name="naam" value="<?= $gebruiker['naam'] ?>"><br><br>
    Email: <input type="email" name="email" value="<?= $gebruiker['email'] ?>"><br><br>
    Wachtwoord: <input type="text" name="wachtwoord" value="<?= $gebruiker['wachtwoord'] ?>"><br><br>
    <button type="submit" name="opslaan">Opslaan</button>
</form>

<?php
if(isset($_POST['opslaan'])) {

    $naam = $_POST['naam'];
    $email = $_POST['email'];
    $wachtwoord = $_POST['wachtwoord'];

    $sql = "UPDATE gebruikers
            SET naam='$naam', email='$email', wachtwoord='$wachtwoord'
            WHERE inloggen_id=$id";

    if ($conn->query($sql)) {
        echo " Wijzigingen opgeslagen!";
    } else {
        echo " Fout bij opslaan: " . htmlspecialchars($conn->error);
    }
}
?>

</body>
</html>
