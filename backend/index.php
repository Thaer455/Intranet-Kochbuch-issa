<?php
require_once __DIR__ . '/vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

$basePath = '/Intranet-Kochbuch-issa/backend'; // anpassen, je nachdem, wie dein URL aufgebaut ist
$fullPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$request = substr($fullPath, strlen($basePath));

if (preg_match('#^/api/recipe/(\d+)$#', $request, $matches)) {
    $_GET['id'] = $matches[1];

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        require_once __DIR__ . "/controllers/recipe/read.php";
    } elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {
        require_once __DIR__ . "/controllers/recipe/update.php";
    } elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
        require_once __DIR__ . "/controllers/recipe/delete.php";
    } else {
        http_response_code(405);
        echo json_encode(['error' => 'Methode nicht erlaubt']);
    }
    exit();
}

switch ($request) {
    case '/api/auth/register':
        require_once __DIR__ . '/controllers/auth/register.php';
        break;

    case '/api/auth/login':
        require_once __DIR__ . '/controllers/auth/login.php';
        break;

    case '/api/user/profile':
        require_once __DIR__ . '/controllers/user/profile.php';
        break;

    case '/api/recipe':
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            require_once __DIR__ . '/controllers/recipe/read.php';
        } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
            require_once __DIR__ . '/controllers/recipe/create.php';
        } else {
            http_response_code(405);
            echo json_encode(['error' => 'Methode nicht erlaubt']);
        }
        break;

    default:
        header("HTTP/1.1 404 Not Found");
        echo json_encode(['error' => 'Route nicht gefunden']);
}
