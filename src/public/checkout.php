<?php
require_once('../database/db_connect.php');
// Kontrollera att alla fält är ifyllda
$required = ['first_name', 'last_name', 'email', 'phone', 'address', 'postal_code', 'city', 'product_id',
'quantity'];
foreach ($required as $field) {
if (empty($_POST[$field])) {
die("Fältet '$field' saknas.");
}
}
// Spara kundinfo

$stmt = $pdo->prepare("INSERT INTO customers (first_name, last_name, phone, address,
postal_code, city, email)

VALUES (?, ?, ?, ?, ?, ?, ?)");

$stmt->execute([
$_POST['first_name'],
$_POST['last_name'],
$_POST['phone'],
$_POST['address'],
$_POST['postal_code'],
$_POST['city'],
$_POST['email']
]);
$customer_id = $pdo->lastInsertId();
// Hämta produkt och pris
$product_id = $_POST['product_id'];
$quantity = $_POST['quantity'];
$stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$product_id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$product) {
die("Produkten finns inte.");
}
$total_amount = $product['price'] * $quantity;
// Skapa order
$stmt = $pdo->prepare("INSERT INTO orders (customer_id, status, total_amount)

VALUES (?, 'Ordered', ?)");
$stmt->execute([$customer_id, $total_amount]);
$order_id = $pdo->lastInsertId();
// Lägg till orderrad
$stmt = $pdo->prepare("INSERT INTO order_items (order_id, product_id, quantity, price)

VALUES (?, ?, ?, ?)");

$stmt->execute([$order_id, $product_id, $quantity, $product['price']]);
// Skicka vidare till bekräftelse
header("Location: order_confirmed.php?order_id=$order_id");
exit;
?>