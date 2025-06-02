<?php
$host = 'localhost';
$db = 'fi37_issa_fpadw';
$user = 'lu';
$pass = '12345';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES  => false,
];

try{
    $pdo = new PDO($dsn, $user, $pass);
} catch (PDOException $e){
    echo json_encode(['error' => $e->getMessage()]);
    exit;
}



?>