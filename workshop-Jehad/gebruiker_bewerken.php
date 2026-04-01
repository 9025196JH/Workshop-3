
<?php
include 'connect.php';
// functie: gebruiker bewerken
// atheur: Jehad Abo Haijaa

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id <= 0) {
    echo "Ongeldig gebruikers-ID.";
    exit;
}

// ✅ PDO prepare (veilig!)
$stmt = $conn->prepare("SELECT * FROM gebruikers WHERE inloggen_id = :id");
$stmt->execute([":id" => $id]);

$gebruiker = $stmt->fetch(PDO::FETCH_ASSOC);

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
    Naam: <input type="text" name="naam" value="<?= htmlspecialchars($gebruiker['naam']) ?>"><br><br>
    Email: <input type="email" name="email" value="<?= htmlspecialchars($gebruiker['email']) ?>"><br><br>
    Wachtwoord: <input type="text" name="wachtwoord" value="<?= htmlspecialchars($gebruiker['wachtwoord']) ?>"><br><br>

    <button type="submit" name="opslaan">Opslaan</button>
    <p><a href="crud_gebruikers.php">Terug naar gebruikers</a></p>
</form>

<?php

if (isset($_POST['opslaan'])) {

    $naam = $_POST['naam'];
    $email = $_POST['email'];
    $wachtwoord = $_POST['wachtwoord'];


    $sql = "UPDATE gebruikers
            SET naam = :naam, email = :email, wachtwoord = :wachtwoord
            WHERE inloggen_id = :id";

    $stmt = $conn->prepare($sql);

    if ($stmt->execute([
        ":naam" => $naam,
        ":email" => $email,
        ":wachtwoord" => $wachtwoord,
        ":id" => $id
    ])) {
        echo "<p style='color: green;'>Wijzigingen opgeslagen!</p>";
    } else {
        echo "<p style='color: red;'>Fout bij opslaan.</p>";
    }
}
?>

</body>
</html>
