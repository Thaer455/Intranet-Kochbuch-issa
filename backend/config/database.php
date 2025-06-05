<?php
/**
 * Verbindungsaufbau zur MariaDB-Datenbank mittels PDO.
 * 
 * @var string $host     Hostname des Datenbankservers
 * @var string $db       Name der Datenbank
 * @var string $user     Benutzername für die Datenbankverbindung
 * @var string $pass     Passwort für die Datenbankverbindung
 * @var string $charset  Zeichensatz für die Verbindung
 * @var string $dsn      Data Source Name für PDO-Verbindung
 * @var array  $options  Optionen für die PDO-Verbindung
 * @var PDO    $pdo      PDO-Instanz für die Datenbankverbindung
 * 
 * @throws PDOException bei Verbindungsfehlern
 */

// Datenbankverbindungsdaten
$host = 'localhost';
$db = 'fi37_issa_fpadw';
$user = 'lu';
$pass = '12345';
$charset = 'utf8mb4';

// DSN (Data Source Name) für PDO
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

// PDO-Optionen
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES  => false,
];

try {
    // Verbindung zur Datenbank herstellen
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    // Fehlermeldung als JSON ausgeben und Skript beenden
    echo json_encode(['error' => $e->getMessage()]);
    exit;
}
?>
