<?php
// JSON-Daten aus dem POST-Body lesen
$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData, true);
 
if ($data) {
    echo "Name: " . $data['name'] . "\n";
    echo "Email: " . $data['email'] . "\n";
} else {
    echo "Fehler beim Verarbeiten der JSON-Daten.";
}
?>