<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
 
    <?php
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
 
        // Simulierte Authentifizierung
        if ($username == 'user' && $password == 'pass') {
            setcookie('eingeloggt', true, time() + 3600); // Cookie für 1 Stunde setzen
            $_SESSION['eingeloggt'] = true;
            echo "Erfolgreich angemeldet.";
        } else {
            echo "Falsche Anmeldedaten.";
        }
    }
    ?>
 
    <?php
        // Cookie-Daten
        var_dump($_COOKIE);
    ?>
 
    <h1>Onlineshop - Startseite</h1>
    <nav>
        <ul>
            <li><a href="index.php">Startseite</a></li>
            <li><a href="produkte.php">Produkte</a></li>
 
            <?php if (isset($_COOKIE['eingeloggt'])) { ?>
 
                <li><a href="warenkorb.php">Warenkorb</a></li>
 
            <?php } ?>
 
        </ul>
    </nav>
 
    <h2>Bitte Einloggen</h2>
 
    <form action="index.php" method="POST">
        <label for="username">Benutzername:</label>
        <input type="text" id="username" name="username">
        <br />
        <label for="password">Passwort:</label>
        <input type="password" id="password" name="password">
        <br />
        <input type="submit" value="Anmelden">
    </form>
</body>
</html>
 
 