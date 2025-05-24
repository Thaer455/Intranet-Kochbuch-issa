<?php
$host = 'localhost';
$db = 'fi37_issa_fpadw';
$user = 'lu';
$pass = '12345';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

try{
    $pdo = new PDW($dsn, $user, $pass);
} catch (PDOExeption $e){
    echo json_encode(['error' => $e->getMessage()]);
    exit;
}



?>