<?php
$host = 'localhost';
$db = 'fi37_issa_fpadw';
$user = 'lu';
$pass = '12345';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

try{
    $pdo = new PDO($dsn, $user, $pass);
} catch (PDOException $e){
    echo json_encode(['error' => $e->getMessage()]);
    exit;
}



?>