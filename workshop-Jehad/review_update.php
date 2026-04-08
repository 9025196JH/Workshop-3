<?php
// Auteur: Bashar
// Functie: Review bewerken en beantwoorden in database
include_once 'functions.php';

if (isset($_POST['btn_upd'])) {
    if (updateReview($_POST)) {
        echo "<script>alert('Review is succesvol bewerkt'); location.replace('crud_reviews.php');</script>";
    } else {
        echo "<script>alert('Fout bij bewerken');</script>";
    }
}

if (isset($_GET['id'])) {
    $review = getReview($_GET['id']);
} else {
    header("Location: crud_reviews.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <title>Review Beantwoorden</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php include 'nav.php'; ?>

    <h1>Review Bewerken / Beantwoorden</h1>

    <form method="post">
        <input type="hidden" name="review_id" value="<?php echo $review['review_id']; ?>">

        <label class="admin-label">Naam:</label>
        <input type="text" name="naam" value="<?php echo $review['naam']; ?>" required><br>

        <label class="admin-label">Beoordeling:</label>
        <select name="beoordeling" required>
            <?php for ($i = 1; $i <= 5; $i++): ?>
                <option value="<?php echo $i; ?>" <?php if ($review['beoordeling'] == $i) echo 'selected'; ?>>
                    <?php echo $i; ?>
                </option>
            <?php endfor; ?>
        </select><br>

        <label class="admin-label">Opmerking:</label>
        <textarea name="opmerking" required><?php echo $review['opmerking']; ?></textarea><br>

        <label class="admin-label" style="background-color: #ffeb3b;">Admin Antwoord:</label>
        <textarea name="admin_antwoord" placeholder="Bedank de klant voor de review..."><?php echo $review['admin_antwoord']; ?></textarea><br>

        <input type="submit" name="btn_upd" value="Opslaan">
    </form>

    <br>
    <a href="crud_reviews.php">Terug naar overzicht</a>
    <?php include 'footer.php'; ?>
</body>

</html>