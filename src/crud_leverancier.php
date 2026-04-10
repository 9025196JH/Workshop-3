<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <?php
    // functie: Programma CRUD Leverancier
    // auteur Jehad Abo Haijaa  

    // Initialisatie
    include 'functions.php';
    include 'nav.php';
    echo "<h1>Leveranciers Beheren</h1>";
    echo "<a href='leverancier_insert.php'>Nieuwe leverancier toevoegen</a><br><br>";
    $result = getData(TABEL_LEVERANCIERS);
    printTabel($result, 'leverancier_id', 'leverancier_update.php', 'leverancier_delete.php');
    include 'footer.php';
    ?>

</body>

</html>