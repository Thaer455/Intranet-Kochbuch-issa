<?php
// backend/index.php

$request = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch ($request) {
    case '/backend/api/auth/register':
        require_once 'controllers/auth/register.php';
        break;
    case '/backend/api/auth/login':
        require_once 'controllers/auth/login.php';
        break;
    case '/backend/api/recipes':
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            require_once 'controllers/recipe/read.php';
        } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
            require_once 'controllers/recipe/create.php';
        } else {
            http_response_code(405);
            echo json_encode(['error' => 'Methode nicht erlaubt']);
        }
        break;
    case preg_match('/^\/backend\/api\/recipes\/(\d+)$/', $request, $matches) ? true : false:
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            require_once 'controllers/recipe/read.php?id=' . $matches[1];
        } elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {
            require_once 'controllers/recipe/update.php?id=' . $matches[1];
        } elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
            require_once 'controllers/recipe/delete.php?id=' . $matches[1];
        } else {
            http_response_code(405);
            echo json_encode(['error' => 'Methode nicht erlaubt']);
        }
        break;
    default:
        header("HTTP/1.1 404 Not Found");
        echo json_encode(['error' => 'Route nicht gefunden']);
        break;
}
?>