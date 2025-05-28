<?php
// controllers/recipe/create.php

header("Content-Type: application/json");

require_once '../../middleware/auth_middleware.php';
$user_id = authenticate();

$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['title'], $data['ingredients'], $data['instructions'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Fehlende Rezeptdaten']);
    exit;
}

require_once '../../config/database.php';
require_once '../../models/Recipe.php';

$recipe = new Recipe($pdo);
$result = $recipe->create([
    'title' => $data['title'],
    'ingredients' => $data['ingredients'],
    'instructions' => $data['instructions'],
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