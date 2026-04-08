<?php
if (session_status() === PHP_SESSION_NONE) session_start();
if (isset($_GET['mode'])) $_SESSION['project_mode'] = $_GET['mode'];
$m = isset($_SESSION['project_mode']) ? $_SESSION['project_mode'] : 'klant';
$nm = ($m == 'klant') ? 'admin' : 'klant';
?>
<nav>
    <div class="menu">
        <a class="logo" href="?mode=<?php echo $nm; ?>">TechZone</a>
        <a href="index.php">Home</a>

        <?php if ($m == 'klant'): ?>
            <div class="dropdown">
                <a href="producten.php">Producten ▾</a>
                <div class="dropdown-content">
                    <a href="producten.php?categorie=Smartphones">Smartphones</a>
                    <a href="producten.php?categorie=Laptops">Laptops</a>
                    <a href="producten.php?categorie=Tablets">Tablets</a>
                    <a href="producten.php">Alles</a>
                </div>
            </div>
            <a href="over.php">Over ons</a>
            <a href="contact.php">Contact</a>
            <a href="klacht.php">Klacht indienen</a>
            <a href="review.php">Review</a>
        <?php else: ?>
            <a href="crud_producten.php">Producten beheren</a>
            <a href="over.php">Over ons</a>
            <a href="contact.php">Contact</a>
            <a href="crud_klachten.php">Klachten beheren</a>
            <a href="crud_reviews.php">Reviews beheren</a>
        <?php endif; ?>

        <a href="crud_leverancier.php">Leveranciers beheren</a>
    </div>

    <div class="right-section">
        <form action="producten.php" method="GET" class="search-container">
            <input type="text" name="q" placeholder="Zoeken...">
            <button type="submit" style="background:none; border:none; cursor:pointer;">🔍</button>
        </form>
        <span class="icon">❤️</span><span class="icon">🛒</span>
        
        <?php if (isset($_SESSION['user_id'])): ?>
            <div class="dropdown" style="display: inline-block;">
                <span class="icon" style="cursor: pointer;">👤</span>
                <div class="dropdown-content">
                    <a href="#">Hallo, <?php echo htmlspecialchars($_SESSION['user_naam']); ?></a>
                    <a href="logout.php">Uitloggen</a>
                </div>
            </div>
        <?php else: ?>
            <a href="login.php" style="text-decoration: none; font-size: 20px;">👤</a>
        <?php endif; ?>
    </div>
</nav>