<?php
// Setzt ein Cookie mit dem Namen "user" und dem Wert "John Doe", das für 1 Stunde gültig ist
setcookie("user", "John Doe", time() + 3600, "/");

var_dump($_COOKIE);
?>
 

 7333