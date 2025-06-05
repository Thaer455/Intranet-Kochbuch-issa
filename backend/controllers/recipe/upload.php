<?php
/**
 * Einfaches PHP-Skript zum Hochladen von Bildern.
 * 
 * Erwartet eine POST-Anfrage mit einer Datei im Feld 'image'.
 * Erlaubt nur Bilddateien der Typen JPEG, PNG und GIF.
 * Speichert die Datei im Verzeichnis "uploads" (relativ zum Skript).
 * Gibt nach erfolgreichem Upload den relativen Pfad zum Bild als JSON zurück.
 * Bei Fehlern werden entsprechende HTTP-Statuscodes und Fehlermeldungen im JSON-Format ausgegeben.
 * 
 * Usage:
 *  - POST /upload.php mit multipart/form-data und dem Feld 'image'
 * 
 * Antwort-Beispiele:
 *  - Erfolg: { "imageUrl": "/uploads/uniquefilename.jpg" }
 *  - Fehler: { "error": "Fehlermeldung" }
 */

$targetDir = __DIR__ . "/uploads/"; 

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
    $file = $_FILES['image'];
    
    // Einfacher Check: Nur Bilder erlauben
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
    if (!in_array($file['type'], $allowedTypes)) {
        http_response_code(400);
        echo json_encode(['error' => 'Nur JPEG, PNG und GIF erlaubt']);
        exit;
    }

    $fileName = uniqid() . "-" . basename($file['name']);
    $targetFile = $targetDir . $fileName;

    if (move_uploaded_file($file['tmp_name'], $targetFile)) {
        // Bild erfolgreich hochgeladen - Pfad zurückgeben
        $imageUrl = "/uploads/" . $fileName;  // URL zum Bild (relativ zum Webroot)
        echo json_encode(['imageUrl' => $imageUrl]);
    } else {
        http_response_code(500);
        echo json_encode(['error' => 'Fehler beim Speichern der Datei']);
    }
} else {
    http_response_code(400);
    echo json_encode(['error' => 'Keine Datei hochgeladen']);
}
?>
