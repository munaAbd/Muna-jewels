<?php
require_once('../database/db_connect.php');
if (isset($_POST['order_id'])) {
$order_id = $_POST['order_id'];
// Radera först order_items som hör till ordern
$stmt = $pdo->prepare("DELETE FROM order_items WHERE order_id = ?");
$stmt->execute([$order_id]);
// Sedan själva ordern
$stmt = $pdo->prepare("DELETE FROM orders WHERE id = ?");
$stmt->execute([$order_id]);
}

header("Location: orders.php");
exit;