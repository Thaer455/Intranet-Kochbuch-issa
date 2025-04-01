<?php
// Datei öffnen (Anfügemodus)
$file = fopen("example.txt", "a") or die("Datei konnte nicht geöffnet werden!");
 
// Daten anhängen
$text = "Zusätzlicher Text.\n";
fwrite($file, $text);
 
// Datei schließen
fclose($file);
 
echo "Daten erfolgreich angehängt!";
?>