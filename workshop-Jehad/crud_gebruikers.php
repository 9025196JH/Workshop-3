<?php include 'connect.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Gebruikers CRUD</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h1>Gebruikers overzicht</h1>

<a href="gebruiker_toevoegen.php">+ Nieuwe gebruiker toevoegen</a>
<br><br>

<table border="1" cellpadding="8">
    <tr>
        <th>ID</th>
        <th>Naam</th>
        <th>Email</th>
        <th>Wachtwoord</th>
        <th>Acties</th>
    </tr>

<?php
$result = $conn->query("SELECT * FROM gebruikers");

if (!$result) {
    echo "</table>";
    echo "<p>Fout bij ophalen gebruikers: " . htmlspecialchars($conn->error) . "</p>";
    exit;
}

while($row = $result->fetch_assoc()) {
    echo "<tr>
            <td>{$row['inloggen_id']}</td>
            <td>{$row['naam']}</td>
            <td>{$row['email']}</td>
            <td>{$row['wachtwoord']}</td>
            <td>
                <a href=\"gebruiker_bewerken.php?id={$row['inloggen_id']}\">Bewerken</a> |
                <a href=\"gebruiker_verwijderen.php?id={$row['inloggen_id']}\">Verwijderen</a>
            </td>
          </tr>";
}
?>

</table>

</body>
</html>
