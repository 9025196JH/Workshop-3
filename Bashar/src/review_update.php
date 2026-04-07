<?php
// Auteur: Bashar Al Aboud
// Functie: bestaande review wijzigen

include_once 'functions.php';

if (isset($_POST['btn_upd'])) {
    if (updateReview($_POST) == true) {
        echo "<script>alert('Review is gewijzigd')</script>";
        echo "<script>location.replace('crud_reviews.php');</script>";
    } else {
        echo "<script>alert('Review is NIET gewijzigd')</script>";
    }
}

if (!isset($_GET['id'])) {
    header("Location: crud_reviews.php");
    exit();
}

$review = getReview($_GET['id']);
?>

<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <title>Review Wijzigen - TechZone</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <?php include 'nav.php'; ?>

    <h1>Review Wijzigen</h1>

    <form method="POST" action="review_update.php?id=<?php echo $review['review_id']; ?>">
        <input type="hidden" name="review_id" value="<?php echo $review['review_id']; ?>">

        <label>Naam:</label>
        <input type="text" name="naam" value="<?php echo htmlspecialchars($review['naam']); ?>" required><br>

        <label>Beoordeling:</label>
        <select name="beoordeling">
            <?php for ($i = 1; $i <= 5; $i++): ?>
                <option value="<?php echo $i; ?>" <?php echo $review['beoordeling'] == $i ? 'selected' : ''; ?>>
                    <?php echo $i; ?>
                </option>
            <?php endfor; ?>
        </select><br>

        <label>Opmerking:</label>
        <textarea name="opmerking" required><?php echo htmlspecialchars($review['opmerking']); ?></textarea><br>

        <button type="submit" name="btn_upd">Opslaan</button>
    </form>

    <br>
    <a href="crud_reviews.php">Terug naar overzicht</a>
    <?php include 'footer.php'; ?>
</body>

</html>