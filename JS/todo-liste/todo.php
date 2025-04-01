<?php
header('Content-Type: application/json'); // Setzt den Antworttyp auf JSON

$file = 'todo.json'; // Datei für die Speicherung der Todos
if (file_exists($file)) {
    $json_data = file_get_contents($file); // Lädt vorhandene Todos
    $todos = json_decode($json_data, true);
} else {
    $todos = []; // Falls keine Datei existiert, wird ein leeres Array verwendet
}

// Fügt einen neuen Eintrag hinzu
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    $todos[] = $input['todo'];
    file_put_contents($file, json_encode($todos)); // Speichert die aktualisierte Liste in die Datei
    echo json_encode(['status' => 'success']);
    exit;
}

// Gibt die aktuelle TODO-Liste zurück
echo json_encode($todos);
?>
