<?php if (!isset($pageTitle)) { $pageTitle = 'TechZone'; } ?>
<!doctype html>
<html lang="nl">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo htmlspecialchars($pageTitle); ?></title>
  <link rel="stylesheet" href="assets/css/style.css">
  <script defer src="assets/js/script.js"></script>
</head>
<body>
<div class="topbar">Gratis verzending bij bestellingen boven €50 | Snelle levering in heel Nederland</div>
<header class="site-header">
  <div class="nav-inner">
    <a class="logo" href="index.php">TechZone</a>
    <nav class="main-nav" aria-label="Hoofdnavigatie">
      <a href="index.php">Home</a>
      <div class="dropdown">
        <button class="dropbtn" type="button">Producten <span>▾</span></button>
        <div class="dropdown-menu">
          <a href="products.php?category=smartphones">Smartphones</a>
          <a href="products.php?category=laptops">Laptops</a>
          <a href="products.php?category=tablets">Tablets</a>
        </div>
      </div>
      <a href="about.php">Over Ons</a>
      <a href="contact.php">Contact</a>
    </nav>
    <div class="icon-nav" aria-label="Snelle acties">
      <a href="search.php" title="Zoeken">⌕</a>
      <a href="favorites.php" title="Favorieten">♡</a>
      <a href="cart.php" title="Winkelwagen">🛒</a>
      <a href="login.php" title="Inloggen">👤</a>
    </div>
  </div>
</header>