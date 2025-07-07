<?php
$host = 'mysql'; // namnet på din container i docker-compose
$db = 'mydatabase';
$user = 'user';
$pass = 'userpassword';
try {
$pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
die("Kunde inte ansluta till databasen: " . $e->getMessage());
}
?>