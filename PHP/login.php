<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
 
<h1>Login - PHP Skript</h1>
 
<?php
    echo "Aha, Sie wollen sich einloggen mit:";
    echo "<br>";
    echo "E-Mail: {$_POST['user_email']}<br>";
    echo "Passwort: {$_POST['user_password']}<br>";
?>
 
 
<br><br>
<img src="images/katzen.jpg" width="200px" />
 
</body>
</html>