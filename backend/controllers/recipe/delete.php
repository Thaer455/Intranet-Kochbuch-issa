<?php
/**
 * API-Endpunkt zum Löschen eines Rezepts.
 * 
 * Erwartet eine Rezept-ID als GET-Parameter "id".
 * Überprüft, ob der authentifizierte Nutzer berechtigt ist, das Rezept zu löschen.
 * Antwortet mit Erfolgsmeldung oder Fehlerstatus.
 * 
 * @return void
 */

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

require_once '../../middleware/auth_middleware.php';
$user_id = authenticate();

if (!isset($_GET['id'])) {
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

$result = $recipe->delete($recipeId);

if ($result) {
    echo json_encode(['message' => 'Rezept gelöscht']);
} else {
    http_response_code(500);
    echo json_encode(['error' => 'Fehler beim Löschen']);
}
?>
