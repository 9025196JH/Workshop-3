<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <title>Klachten Beheren</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php
    include 'functions.php';
    include 'nav.php';

    echo "<h1>Klachten beheren</h1>";
    echo "<a href='klacht_insert.php' class='insert-knop'>Nieuwe klacht toevoegen</a><br><br>";

    $result = getData("klachten");
    printTabel($result, 'klacht_id', 'klacht_update.php', 'klacht_delete.php', ['inloggen_id']);

    include 'footer.php';
    ?>
</body>

</html>