<?php
$apiUrl = "https://swapi.info/api/people/1/";
 
// Daten mit file_get_contents() abrufen
$jsonData = file_get_contents($apiUrl);
 
// Überprüfen, ob die Anfrage erfolgreich war
if ($jsonData === false) {
    die("Fehler beim Abrufen der Daten.");
}
 
// JSON-Daten in ein PHP-Array umwandeln
$data = json_decode($jsonData, true);
 
// Überprüfen, ob die Dekodierung erfolgreich war
if ($data === null) {
    die("Fehler beim Dekodieren der JSON-Daten.");
}
 
// Daten anzeigen
echo "<h1>Star Wars Charakter: " . htmlspecialchars($data['name']) . "</h1>";
echo "<p>Höhe: " . htmlspecialchars($data['height']) . " cm</p>";
echo "<p>Gewicht: " . htmlspecialchars($data['mass']) . " kg</p>";
echo "<p>Haarfarbe: " . htmlspecialchars($data['hair_color']) . "</p>";
?>