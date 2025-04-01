<?php
$apiUrl = "https://swapi.info/api/people/1/";
 
// Daten mit file_get_contents() abrufen
$jsonData = file_get_contents($apiUrl);
 
// Überprüfen, ob die Anfrage erfolgreich war
if ($jsonData === false) {
    die("Fehler beim Abrufen der Daten.");
}
 
// JSON-Daten in eine lokale Datei schreiben
$file = "luke_skywalker.json";
if (file_put_contents($file, $jsonData) === false) {
    die("Fehler beim Speichern der Daten.");
}
 
echo "Daten von Luke Skywalker wurden erfolgreich in '$file' gespeichert.";
?>
 
 