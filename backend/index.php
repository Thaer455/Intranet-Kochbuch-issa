<?php
require_once __DIR__ . '/vendor/autoload.php';

/**
 * Handle CORS Preflight requests.
 * 
 * @return void
 */
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

/**
 * Basis-Pfad der API (anpassen je nach Server-Setup).
 * 
 * @var string
 */
$basePath = '/Intranet-Kochbuch-issa/backend';

/**
 * Voller Pfad der aktuellen Anfrage.
 * 
 * @var string
 */
$fullPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

/**
 * Pfad relativ zum Basis-Pfad, der die Route angibt.
 * 
 * @var string
 */
$request = substr($fullPath, strlen($basePath));

/**
 * Routing für Requests mit ID (z.B. /api/recipe/123).
 */
if (preg_match('#^/api/recipe/(\d+)$#', $request, $matches)) {
    $_GET['id'] = $matches[1];

    switch ($_SERVER['REQUEST_METHOD']) {
        case 'GET':
            require_once __DIR__ . "/controllers/recipe/read.php";
            break;
        case 'PUT':
            require_once __DIR__ . "/controllers/recipe/update.php";
            break;
        case 'DELETE':
            require_once __DIR__ . "/controllers/recipe/delete.php";
            break;
        default:
            http_response_code(405);
            echo json_encode(['error' => 'Methode nicht erlaubt']);
            break;
    }
    exit();
}

/**
 * Routing für Requests ohne ID.
 */
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
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                require_once __DIR__ . '/controllers/recipe/read.php';
                break;
            case 'POST':
                require_once __DIR__ . '/controllers/recipe/create.php';
                break;
            default:
                http_response_code(405);
                echo json_encode(['error' => 'Methode nicht erlaubt']);
                break;
        }
        break;

    default:
        http_response_code(404);
        echo json_encode(['error' => 'Route nicht gefunden']);
        break;
}
