<?php
require_once __DIR__ . '/vendor/autoload.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// OPTIONS-Anfrage sofort beantworten
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

$request = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch ($request) {
    // Authentifizierung
    case '/api/auth/register':
        require_once __DIR__ . '/controllers/auth/register.php';
        break;

    case '/api/auth/login':
        require_once __DIR__ . '/controllers/auth/login.php';
        break;


    case '/api/user/profile':
        require_once __DIR__ . '/controllers/user/profile.php';
        break;

    // Rezepte
    case '/api/recipes':
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            require_once __DIR__ . '/controllers/recipe/read.php';
        } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
            require_once __DIR__ . '/controllers/recipe/create.php';
        } else {
            http_response_code(405);
            echo json_encode(['error' => 'Methode nicht erlaubt']);
        }
        break;

    // Rezept-ID mit Zahl erkennen
    case preg_match('#^/api/recipes/(\d+)$#', $request, $matches) ? true : false:
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
        break;

    // Fallback
    default:
        header("HTTP/1.1 404 Not Found");
        echo json_encode(['error' => 'Route nicht gefunden']);
}
