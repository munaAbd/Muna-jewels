<?php
require_once('../database/db_connect.php');
if (isset($_POST['order_id'], $_POST['status'])) {
$stmt = $pdo->prepare("UPDATE orders SET status = ? WHERE id = ?");
$stmt->execute([$_POST['status'], $_POST['order_id']]);
}
header("Location: orders.php");
exit;