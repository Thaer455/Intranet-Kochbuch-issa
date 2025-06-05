<?php


// Preflight-Check (OPTIONS)
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

header("Content-Type: application/json");

// JSON-Daten laden
$data = json_decode(file_get_contents('php://input'), true);

// Eingabedaten prüfen
if (!$data || !isset($data['email']) || !isset($data['password']) || !isset($data['name'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Name, E-Mail oder Passwort fehlt']);
    exit;
}

$email = trim($data['email']);
$password = $data['password'];
$name = trim($data['name']);

// E-Mail validieren
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo json_encode(['error' => 'Ungültige E-Mail-Adresse']);
    exit;
}

// Passwortregeln prüfen
if (
    strlen($password) < 8 ||
    !preg_match('/[A-Z]/', $password) ||
    !preg_match('/[0-9]/', $password) ||
    !preg_match('/[!@$%?]/', $password)
) {
    http_response_code(400);
    echo json_encode([
        'error' => 'Passwort muss mindestens 8 Zeichen enthalten, einen Großbuchstaben, eine Zahl und ein Sonderzeichen (!@$%?)'
    ]);
    exit;
}

// Passwort hashen
$password_hash = password_hash($password, PASSWORD_DEFAULT);

// Datenbankverbindung und User-Modell laden
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../models/User.php';

// Nutzer erstellen
$userModel = new User($pdo);
$userModel->setEmail($email);
$userModel->setPasswordHash($password_hash);
$userModel->setName($name);

try {
    $success = $userModel->create();
    if ($success) {
        http_response_code(201); // Erfolgreich registriert
        echo json_encode(['message' => 'Erfolgreich registriert']);
    } else {
        http_response_code(500);
        echo json_encode(['error' => 'Fehler bei der Registrierung']);
    }
} catch (Exception $e) {
    http_response_code(400);
    echo json_encode(['error' => $e->getMessage()]);
}
