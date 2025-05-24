<?php
// controllers/auth/register.php

header("Content-Type: application/json");

$data = json_decode(file_get_contents('php://input'), true);

if (!$data || !isset($data['email']) || !isset($data['password'])) {
    http_response_code(400);
    echo json_encode(['error' => 'E-Mail oder Passwort fehlt']);
    exit;
}

if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo json_encode(['error' => 'Ungültige E-Mail-Adresse']);
    exit;
}

if (strlen($data['password']) < 8 ||
    !preg_match('/[A-Z]/', $data['password']) ||
    !preg_match('/[0-9]/', $data['password']) ||
    !preg_match('/[!@$%?]/', $data['password'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Passwort muss mindestens 8 Zeichen enthalten, einen Großbuchstaben, eine Zahl und ein Sonderzeichen (!@$%?)']);
    exit;
}

require_once '../../config/database.php';
require_once '../../models/User.php';

$email = $data['email'];
$password = password_hash($data['password'], PASSWORD_DEFAULT);
$name = $data['name'] ?? '';

$user = new User($pdo);
if ($user->create(['email' => $email, 'password_hash' => $password, 'name' => $name])) {
    echo json_encode(['message' => 'Registrierung erfolgreich']);
} else {
    http_response_code(500);
    echo json_encode(['error' => 'Registrierung fehlgeschlagen']);
}
?>