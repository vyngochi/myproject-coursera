<?php
$host = 'mainline.proxy.rlwy.net';
$port = '51274';
$db = 'misc';
$user = 'fred';
$pass = 'zap
$pdo = null;

try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "<p style='color:red'>Connection failed: " . htmlentities($e->getMessage()) . "</p>";
    die(); 
}
?>
