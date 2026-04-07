<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <title>Reviews Beheren</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php
    include 'functions.php';
    include 'nav.php';
    $result = getData("reviews");

    echo "<h1>Reviews beheren</h1>";
    printTabel($result, 'review_id', 'review_update.php', 'review_delete.php', ['product_id']);

    include 'footer.php';

    ?>
</body>

</html>