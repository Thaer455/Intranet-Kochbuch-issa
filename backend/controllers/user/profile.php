<?php
// CORS-Header setzen
header("Access-Control-Allow-Origin: http://localhost:5173");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

header("Content-Type: application/json");

require_once '../../middleware/auth_middleware.php';
require_once '../../config/database.php';
require_once __DIR__ . '/../../models/User.php';

try {
    $user_id = authenticate();
    $userModel = new User($pdo);

    // === GET: Profildaten laden ===
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $user = $userModel->getById($user_id);

        if ($user) {
            echo json_encode(['success' => true, 'user' => $user]);
        } else {
            http_response_code(404);
            echo json_encode(['success' => false, 'error' => 'Benutzer nicht gefunden']);
        }

    // === PUT: Profildaten aktualisieren ===
    } elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {
        $input = json_decode(file_get_contents("php://input"), true);

        if (!isset($input['name']) || !isset($input['email'])) {
            http_response_code(400);
            echo json_encode(['success' => false, 'error' => 'Name und E-Mail müssen angegeben werden']);
            exit;
        }

        $updated = $userModel->update($user_id, $input['name'], $input['email']);

        if ($updated) {
            $user = $userModel->getById($user_id); // aktualisierte Daten zurückgeben
            echo json_encode(['success' => true, 'user' => $user]);
        } else {
            http_response_code(500);
            echo json_encode(['success' => false, 'error' => 'Profil konnte nicht aktualisiert werden']);
        }

    } else {
        http_response_code(405);
        echo json_encode(['success' => false, 'error' => 'Methode nicht erlaubt']);
    }

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => 'Serverfehler: ' . $e->getMessage()]);
}
