<?php
/**
 * API-Endpunkt zum Aktualisieren eines Rezepts.
 * 
 * Überprüft die Authentifizierung des Nutzers.
 * Prüft, ob die Rezept-ID per GET übergeben wurde und ob das Rezept dem Nutzer gehört.
 * Erwartet JSON-Daten mit title, ingredients und instructions im Request-Body.
 * Aktualisiert das Rezept in der Datenbank.
 * Gibt eine Erfolgsmeldung oder Fehler zurück.
 * 
 * @return void
 */

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

require_once '../../middleware/auth_middleware.php';
$user_id = authenticate();

$data = json_decode(file_get_contents('php://input'), true);

if (!isset($_GET['id']) || empty($_GET['id'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Rezept-ID fehlt']);
    exit;
}

$recipeId = $_GET['id'];

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../models/Recipe.php';

$recipe = new Recipe($pdo);
$existingRecipe = $recipe->getById($recipeId);

if (!$existingRecipe || $existingRecipe['user_id'] !== $user_id) {
    http_response_code(403);
    echo json_encode(['error' => 'Du hast keine Berechtigung']);
    exit;
}

if (!isset($data['title'], $data['ingredients'], $data['instructions'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Fehlende Daten']);
    exit;
}

$ingredients = $data['ingredients'];
if (is_array($ingredients)) {
    $ingredients = json_encode($ingredients);
}

$updateData = [
    'title' => $data['title'],
    'ingredients' => $ingredients,
    'instructions' => $data['instructions'],
    'image' => $data['image'] ?? null
];

$result = $recipe->update($recipeId, $updateData);

if ($result) {
    echo json_encode(['message' => 'Rezept erfolgreich aktualisiert']);
} else {
    http_response_code(500);
    echo json_encode(['error' => 'Fehler beim Speichern']);
}
?>
