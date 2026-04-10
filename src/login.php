<?php
session_start();
require_once('functions.php');

// Als er al ingelogd is, redirect naar home
if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$error = '';

// Als het formulier is verzonden
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $wachtwoord = $_POST['wachtwoord'] ?? '';
    
    if (empty($email) || empty($wachtwoord)) {
        $error = 'Email en wachtwoord zijn verplicht.';
    } else {
        // Controleer login in database
        $result = checkLogin($email, $wachtwoord);
        if ($result) {
            $_SESSION['user_id'] = $result['inloggen_id'];
            $_SESSION['user_naam'] = $result['naam'];
            $_SESSION['user_email'] = $result['email'];
            header("Location: index.php");
            exit();
        } else {
            $error = 'Email of wachtwoord onjuist.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inloggen - TechZone</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'nav.php'; ?>
    
    <div class="login-container">
        <h2>Inloggen</h2>
        
        <?php if (!empty($error)): ?>
            <div class="error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        
        <form method="POST">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            
            <div class="form-group">
                <label for="wachtwoord">Wachtwoord:</label>
                <input type="password" id="wachtwoord" name="wachtwoord" required>
            </div>
            
            <button type="submit" class="btn-login">Inloggen</button>
        </form>
    </div>
    
    <?php include 'footer.php'; ?>
</body>
</html>
