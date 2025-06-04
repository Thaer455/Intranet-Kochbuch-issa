<?php

    // Server-Session wieder aufnehmen oder neu starten
    session_start();

    // Login Funktionalität
    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Simulierte Authentifizierung
        if ($username == 'John' && $password == 'beep') {
            setcookie('eingeloggt', true, time() + 3600); // Cookie für 1 Stunde setzen
            $_SESSION['eingeloggt'] = true;
            $_SESSION['username'] = $username;
            echo "Erfolgreich angemeldet.";
        } else {
            echo "Falsche Anmeldedaten.";
        }
    }

    // Logout Funktionalität
    if (isset($_POST['logout'])) {
        session_unset();
        session_destroy();
        setcookie('eingeloggt', "", time() - 3600);
        setcookie('PHPSESSID', "", time() - 3600);
        echo "Logged out....";
    }

    // Anzeige eingeloggt oder Login-Formular
    if (isset($_SESSION['eingeloggt'])) {
        echo "Sie sind angemeldet als " . $_SESSION['username']; ?>

        <br>
        <form action="index.php" method="POST">
            <button type="submit" name="logout">Abmelden</button>
        </form>
    <?php
    } else { ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Bitte Einloggen</title>
        <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1 {
            color: #333;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            border: 1px solid #ddd;
            padding: 10px;
            margin-bottom: 10px;
            background-color: #f9f9f9;
        }
        button {
            padding: 5px 10px;
            margin: 0 5px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        button[name="increase_quantity"] {
            background-color: #28a745;
            color: white;
        }
        button[name="decrease_quantity"] {
            background-color: #ffc107;
            color: black;
        }
        button[name="remove_product"] {
            background-color: #dc3545;
            color: white;
        }
        button[name="clear_cart"] {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            margin-top: 20px;
        }
        button:hover {
            opacity: 0.8;
        }
    </style>
    </head>
    <body>
        <form action="index.php" method="POST">
            <label for="username">Benutzername:</label>
            <input type="text" id="username" name="username">
            <br />
            <label for="password">Passwort:</label>
            <input type="password" id="password" name="password">
            <br />
            <input type="submit" name="login" value="Anmelden">
        </form>
        
    </body>
    </html>




    <?php
    }
?>

<?php require_once("index.php") ?>
