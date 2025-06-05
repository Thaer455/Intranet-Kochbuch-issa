<?php
/**
 * API-Endpunkt zum Abrufen eines Benutzers anhand seiner ID.
 *
 * Unterstützt Preflight OPTIONS-Anfragen für CORS.
 * Erwartet eine GET-Anfrage mit der Benutzer-ID als URL-Parameter 'id'.
 * Gibt die Benutzer-ID und den Namen als JSON zurück, falls gefunden.
 * Gibt Fehlercodes und Fehlermeldungen als JSON bei ungültiger ID, nicht gefundenem Benutzer oder Datenbankfehlern aus.
 * 
 * Beispiel:
 *  GET /api/users/get_user.php?id=123
 * 
 * Antwort bei Erfolg:
 *  { "id": 123, "name": "Max Mustermann" }
 * 
 * Antwort bei Fehler:
 *  { "error": "Benutzer nicht gefunden" }
 */

 // Preflight
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// DB-Verbindung
require_once __DIR__ . '/../../config/database.php';

// ID aus der URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id === 0) {
    http_response_code(400);
    echo json_encode(["error" => "Ungültige Benutzer-ID"]);
    exit();
}

try {
    $stmt = $pdo->prepare("SELECT id, name FROM users WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        echo json_encode($user);
    } else {
        http_response_code(404);
        echo json_encode(["error" => "Benutzer nicht gefunden"]);
    }
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["error" => "Datenbankfehler: " . $e->getMessage()]);
}
?>
