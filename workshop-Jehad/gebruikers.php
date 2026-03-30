
<?php include 'connect.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Gebruikers CRUD</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h1>Gebruikers overzicht</h1>

a href="gebruiker_toevoegen.php">+ Nieuwe gebruiker toevoegen</a>
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
$result = $conn->query("SELECT * FROM inloggen");

while($row = $result->fetch_assoc()) {
    echo "<tr>
            <td>{$row['inloggen_id']}</td>
            <td>{$row['naam']}</td>
            <td>{$row['email']}</td>
            <td>{$row['wachtwoord']}</td>
            <td>
                gebruiker_bewerken.php?id={$row['inloggen_id']}'>Bewerken</a> |
                gebruiker_verwijderen.php?id={$row['inloggen_id']}'>Verwijderen</a>
            </td>
          </tr>";
}
?>
</table>

</body>
</html>
