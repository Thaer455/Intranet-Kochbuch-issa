
<form action="index.php" method="POST">
    <input type="text" name="name">
    <input type="submit">
</form>


<?php
 
echo "Name: {$_GET['name']}<br>"; // Ausgabe: Max
echo "Alter: {$_GET['age']}<br>";  // Ausgabe: 30
 echo"Farbe: {$_GET['color']}<br>";

 var_dump($_GET);
echo "<br><br>";
 
 
var_dump($_POST);
 
 
 echo "Name aus Formular: {$_POST['name']}<br>"; // Ausgabe: Der eingegebene Name
?>