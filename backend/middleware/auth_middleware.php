<?php
/**
 * Middleware zur Authentifizierung via JWT.
 *
 * Liest den Authorization-Header aus, erwartet ein Bearer-Token.
 * Dekodiert das JWT mit einem geheimen Schlüssel.
 * Gibt die Benutzer-ID zurück, wenn gültig.
 * Gibt Fehler mit HTTP 401 zurück, wenn Token fehlt oder ungültig ist.
 *
 * Benötigt firebase/php-jwt via Composer.
 */

require_once __DIR__ . '/../vendor/autoload.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

function authenticate() {
    $headers = getallheaders();
    $token = $headers['Authorization'] ?? null;

    if (!$token || !str_starts_with($token, 'Bearer ')) {
        http_response_code(401);
        echo json_encode(['error' => 'Kein Token gefunden']);
        exit;
    }

    $jwt = str_replace('Bearer ', '', $token);

    try {
        // Geheimer Schlüssel (sollte sicher in .env oder Konfigurationsdatei liegen)
        $secret_key = "dein_geheimer_schluessel_123!";
        
        // Token dekodieren
        $decoded = JWT::decode($jwt, new Key($secret_key, 'HS256'));

        return $decoded->data->user_id; // Gibt die ID des Nutzers zurück
    } catch (\Exception $e) {
        http_response_code(401);
        echo json_encode(['error' => 'Ungültiger Token', 'message' => $e->getMessage()]);
        exit;
    }
}
?>
