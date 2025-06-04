<?php
require_once __DIR__ . '/../../vendor/autoload.php';

// CORS Header (Frontend-Adresse anpassen, falls nötig)
header("Access-Control-Allow-Origin: http://localhost:5173");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// Preflight-Request beenden
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

header("Content-Type: application/json");

// JSON-Daten vom Request lesen
$data = json_decode(file_get_contents('php://input'), true);

// Überprüfen ob email und password vorhanden sind
if (!isset($data['email']) || !isset($data['password'])) {
    http_response_code(400);
    echo json_encode(['error' => 'E-Mail oder Passwort fehlt']);
    exit;
}

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../models/User.php';

$userModel = new User($pdo);
$user = $userModel->getByEmail($data['email']);

// Passwort prüfen
if ($user && password_verify($data['password'], $user['password_hash'])) {

    $secret_key = "dein_geheimer_schluessel_123!";

    $payload = [
        'exp' => time() + 3600,  // Ablaufzeit 1 Stunde
        'data' => [
            'user_id' => $user['id'],
            'email' => $user['email']
        ]
    ];

    // JWT erzeugen
    $jwt = \Firebase\JWT\JWT::encode($payload, $secret_key, 'HS256');

    // Antwort mit token UND user_id
    echo json_encode([
        'success' => true,
        'token' => $jwt,
        'user' => [
            'id' => $user['id'],
            'name' => $user['name'],
            'email' => $user['email']
        ]
    ]);
} else {
    http_response_code(401);
    echo json_encode(['success' => false, 'error' => 'Falsche Anmeldedaten']);
}
?>
