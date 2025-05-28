<?php
header("Access-Control-Allow-Origin: http://localhost:5173");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['email']) || !isset($data['password'])) {
    http_response_code(400);
    echo json_encode(['error' => 'E-Mail oder Passwort fehlt']);
    exit;
}

require_once '../../config/database.php';
require_once '../../models/User.php';

$userModel = new User($pdo);
$user = $userModel->getByEmail($data['email']);

if ($user && password_verify($data['password'], $user['password_hash'])) {

    $secret_key = "dein_geheimer_schluessel_123!";
    
    $payload = [
        'exp' => strtotime('+1 hour'),
        'data' => [
            'user_id' => $user['id'],
            'email' => $user['email']
        ]
    ];

    $jwt = \Firebase\JWT\JWT::encode($payload, $secret_key, 'HS256');

    echo json_encode([
        'success' => true,
        'token' => $jwt,
        'user' => ['id' => $user['id'], 'name' => $user['name'], 'email' => $user['email']]
    ]);
} else {
    http_response_code(401);
    echo json_encode(['success' => false, 'error' => 'Falsche Anmeldedaten']);
}
?>