<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <title>CRUD Klachten - TechZone</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <?php
    // Auteur: Bashar
    // Functie: Klacht beheren
    include 'functions.php';
    include 'nav.php';

    echo "<h1>Klachten beheren</h1>";


    $result = getData("klachten");

    printTabel($result, 'klacht_id', 'klacht_update.php', 'klacht_delete.php', ['inloggen_id']);

    include 'footer.php';
    ?>

</body>

</html>