<?php
// CORS Header
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// Preflight
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// DB-Verbindung
require_once __DIR__ . '/../../config/database.php';

// ID aus der URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id === 0) {
    http_response_code(400);
    echo json_encode(["error" => "Ungültige Benutzer-ID"]);
    exit();
}

try {
    $stmt = $pdo->prepare("SELECT id, name FROM users WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        echo json_encode($user);
    } else {
        http_response_code(404);
        echo json_encode(["error" => "Benutzer nicht gefunden"]);
    }
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["error" => "Datenbankfehler: " . $e->getMessage()]);
}
