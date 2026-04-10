<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <title>CRUD Reviews - TechZone</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <?php
    // Auteur: Bashar
    // Functie: Review beheren
    include 'functions.php';
    include 'nav.php';

    echo "<h1>Reviews beheren</h1>";


    $result = getData("reviews");
    printTabel($result, 'review_id', 'review_update.php', 'review_delete.php', []);

    include 'footer.php';
    ?>
</body>

</html>