<?php

header("Content-Type: application/json");

require_once '../../config/database.php';
require_once '../../models/Recipe.php';

$recipe = new Recipe($pdo);

if (isset($_GET['id'])) {
    $data = $recipe->getById($_GET['id']);
    if ($data) {
        echo json_encode(['success' => true, 'recipe' => $data]);
    } else {
        http_response_code(404);
        echo json_encode(['success' => false, 'error' => 'Rezept nicht gefunden']);
    }
} else {
    $recipes = $recipe->getAll();
    echo json_encode(['success' => true, 'recipes' => $recipes]);
}
?>