
<?php include 'connect.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Techzone - Home</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<nav>
    <div class="menu">
        <a href="index.php">Home</a>
        <a href="producten.php">Producten</a>
        <a href="over.php">Over ons</a>
        <a href="contact.php">Contact</a>
    </div>

    <div class="right-section">

        <!-- Zoekbalk met vergrootglas -->
        <div class="search-container">
            <input type="text" placeholder="Zoeken...">
            <span class="search-icon">🔍</span>
        </div>

        <!-- Favorieten -->
        <span class="icon">❤️</span>

        <!-- Winkelmandje -->
        <span class="icon">🛒</span>

        <!-- Inloggen poppetje -->
        <a href="login.php" class="icon">👤</a>

    </div>
</nav>

<h1 class="welcome">Welkom bij Techzone!</h1>

</body>
</html>
