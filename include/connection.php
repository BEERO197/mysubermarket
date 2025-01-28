<?php
$host = 'localhost';
$db = 'ecommerce_db';
$user = 'abeer';
$pass = 'abeer_zakut';

$dsn = "mysql:host=$host;dbname=$db;charset=utf8";
try {
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
echo "Connection ok: " . $e->getMessage();

} catch ("PDOException" $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>