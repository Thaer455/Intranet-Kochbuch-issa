<?php
/**
 * API-Endpunkt zum Abrufen von Rezeptdaten.
 * 
 * Wenn ein "id"-Parameter per GET gesetzt ist, wird das entsprechende Rezept zurückgegeben.
 * Andernfalls werden alle Rezepte als Array zurückgegeben.
 * Antwort erfolgt im JSON-Format.
 * 
 * @return void
 */

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

require_once __DIR__ . '/../../config/database.php';

try {
    if (isset($_GET['id'])) {
        $id = intval($_GET['id']);
        $stmt = $pdo->prepare("SELECT * FROM recipe WHERE id = ?");
        $stmt->execute([$id]);
        $recipe = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($recipe) {
            echo json_encode($recipe);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Rezept nicht gefunden']);
        }
    } else {
        $stmt = $pdo->query("SELECT * FROM recipe");
        $recipes = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($recipes);
    }
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["error" => "Datenbankfehler: " . $e->getMessage()]);
}
?>
