<?php
include 'functions.php';
$producten = getData("producten");
?>
<!DOCTYPE html>
<html lang="nl">

<head>
    <title>Beheer Producten</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php include 'nav.php'; ?>

    <div class="container">
        <h1>Producten Beheren</h1>
        <a href="product_insert.php" style="background:green; color:white; padding:10px; text-decoration:none;">Nieuw Product Toevoegen</a>
        <br><br>

        <table class="admin-table">
            <tr>
                <th>ID</th>
                <th>Naam</th>
                <th>Categorie</th>
                <th>Prijs</th>
                <th>Acties</th>
            </tr>
            <?php foreach ($producten as $row): ?>
                <tr>
                    <td><?php echo $row['product_id']; ?></td>
                    <td><?php echo $row['naam']; ?></td>
                    <td><?php echo $row['categorie']; ?></td>
                    <td>€ <?php echo $row['prijs']; ?></td>
                    <td>
                        <a href="product_update.php?id=<?php echo $row['product_id']; ?>">Wzg</a> |
                        <a href="product_delete.php?id=<?php echo $row['product_id']; ?>" onclick="return confirm('Zeker weten?')">Verwijder</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>

    <?php include 'footer.php'; ?>
</body>

</html>