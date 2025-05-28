<?php

header("Content-Type: application/json");

require_once '../../middleware/auth_middleware.php';
$user_id = authenticate();

if (!isset($_GET['id'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Rezept-ID fehlt']);
    exit;
}

$recipeId = $_GET['id'];

require_once '../../config/database.php';
require_once '../../models/Recipe.php';

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