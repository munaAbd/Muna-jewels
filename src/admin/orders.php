<?php
require_once('../database/db_connect.php');
// Hämta alla ordrar med kund- och produktinformation
$sql = "
SELECT
orders.id AS order_id,
orders.order_date,
orders.status,
orders.total_amount,
customers.first_name,
customers.last_name,
customers.email,

products.name AS product_name,
order_items.quantity,
order_items.price
FROM orders
JOIN customers ON orders.customer_id = customers.id
JOIN order_items ON orders.id = order_items.order_id
JOIN products ON order_items.product_id = products.id
ORDER BY orders.order_date DESC
";
$stmt = $pdo->query($sql);
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="sv">
<head>
<meta charset="UTF-8">
<title>Admin - Ordrar</title>
</head>
<body>
<h1>Alla ordrar</h1>
<table border="1" cellpadding="6">
<thead>
<tr>
<th>Order ID</th>
<th>Datum</th>
<th>Status</th>
<th>Kund</th>
<th>Produkt</th>
<th>Antal</th>
<th>Belopp</th>
<th>Total</th>
<th>Uppdatera</th>
<th>Radera</th>
</tr>
</thead>
<tbody>
<?php foreach ($orders as $order): ?>
<tr>
<td><?= $order['order_id'] ?></td>
<td><?= $order['order_date'] ?></td>
<td><?= $order['status'] ?></td>
<td><?= $order['first_name'] . ' ' . $order['last_name'] ?></td>
<td><?= $order['product_name'] ?></td>
<td><?= $order['quantity'] ?></td>
<td><?= number_format($order['price'], 2) ?> kr</td>
<td><?= number_format($order['total_amount'], 2) ?> kr</td>
<td>
<form method="POST" action="update_order.php">
<input type="hidden" name="order_id" value="<?= $order['order_id'] ?>">
<select name="status">
<option <?= $order['status'] === 'Ordered' ? 'selected' : '' ?>>Ordered</option>
<option <?= $order['status'] === 'Packed' ? 'selected' : '' ?>>Packed</option>

<option <?= $order['status'] === 'Shipped' ? 'selected' : '' ?>>Shipped</option>
<option <?= $order['status'] === 'Paid' ? 'selected' : '' ?>>Paid</option>
</select>
<button type="submit">Uppdatera</button>
</form>
</td>
<td>
<form method="POST" action="delete_order.php" onsubmit="return confirm('Är du säker

på att du vill radera ordern?');">

<input type="hidden" name="order_id" value="<?= $order['order_id'] ?>">
<button type="submit">Radera</button>
</form>
</td>
</tr>
<?php endforeach ?>
</tbody>
</table>
</body>
</html>