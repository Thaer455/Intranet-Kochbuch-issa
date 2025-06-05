<?php
/**
 * API-Endpunkt zum Erstellen eines neuen Rezepts.
 * 
 * Erwartet JSON-Input mit folgenden Feldern:
 * - title (string): Titel des Rezepts
 * - ingredients (array|string): Zutaten (Array oder JSON-String)
 * - instructions (array|string): Anweisungen (Array oder JSON-String)
 * - time (int|string): Zubereitungszeit
 * - difficulty (string): Schwierigkeit
 * - image (string|null): optional, Bild-URL oder Pfad
 * 
 * Authentifiziert den Nutzer mittels Middleware.
 * Wandelt Arrays in JSON um, wenn nötig.
 * Speichert das Rezept in der Datenbank mit der zugehörigen User-ID.
 * 
 * @return void
 */

require_once __DIR__ . '/../../middleware/auth_middleware.php';
$user_id = authenticate();

$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['title'], $data['ingredients'], $data['instructions'], $data['time'], $data['difficulty'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Fehlende Rezeptdaten']);
    exit;
}

// Falls ingredients oder instructions als Array kommen, in JSON umwandeln
$ingredients = is_array($data['ingredients']) ? json_encode($data['ingredients']) : $data['ingredients'];
$instructions = is_array($data['instructions']) ? json_encode($data['instructions']) : $data['instructions'];

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../models/Recipe.php';

$recipe = new Recipe($pdo);
$result = $recipe->create([
    'title' => $data['title'],
    'ingredients' => $ingredients,
    'instructions' => $instructions,
    'time' => $data['time'],
    'difficulty' => $data['difficulty'],
    'image' => $data['image'] ?? null,
    'user_id' => $user_id
]);

if ($result) {
    echo json_encode(['message' => 'Rezept erfolgreich erstellt']);
} else {
    http_response_code(500);
    echo json_encode(['error' => 'Fehler beim Erstellen']);
}
?>
