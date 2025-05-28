<?php
// controllers/user/profile.php

header("Content-Type: application/json");

require_once '../../middleware/auth_middleware.php';
$user_id = authenticate();

require_once '../../config/database.php';
$stmt = $pdo->prepare("SELECT id, name, email, created_at FROM user WHERE id = ?");
$stmt->execute([$user_id]);

$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user) {
    echo json_encode(['success' => true, 'user' => $user]);
} else {
    http_response_code(404);
    echo json_encode(['success' => false, 'error' => 'Benutzer nicht gefunden']);
}
?>