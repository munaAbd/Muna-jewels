<?php
require_once('../database/db_connect.php');
$orders = [];
$email = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$email = $_POST['email'] ?? '';
if (!empty($email)) {
$sql = "
SELECT
orders.id AS order_id,
orders.order_date,
orders.status,
orders.total_amount,
products.name AS product_name,
order_items.quantity,
order_items.price
FROM orders
JOIN customers ON orders.customer_id = customers.id
JOIN order_items ON orders.id = order_items.order_id
JOIN products ON order_items.product_id = products.id
WHERE customers.email = ?
ORDER BY orders.order_date DESC
";
$stmt = $pdo->prepare($sql);
$stmt->execute([$email]);
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
}
?>
<!DOCTYPE html>
<html lang="sv">
<head>
<meta charset="UTF-8">
<title>Dina ordrar - Muna Jewels</title>
</head>
<body>
<h1>Se dina tidigare beställningar</h1>
<form method="POST">
<label for="email">Din e-postadress:</label>
<input type="email" name="email" id="email" required value="<?= htmlspecialchars($email) ?>">
<button type="submit">Visa ordrar</button>

</form>
<?php if (!empty($orders)): ?>
<h2>Orderhistorik</h2>
<table border="1" cellpadding="6">
<thead>
<tr>
<th>Order ID</th>
<th>Datum</th>
<th>Status</th>
<th>Produkt</th>
<th>Antal</th>
<th>Pris</th>
<th>Ordertotal</th>
</tr>
</thead>
<tbody>
<?php foreach ($orders as $order): ?>
<tr>
<td><?= $order['order_id'] ?></td>
<td><?= $order['order_date'] ?></td>
<td><?= $order['status'] ?></td>
<td><?= $order['product_name'] ?></td>
<td><?= $order['quantity'] ?></td>
<td><?= number_format($order['price'], 2) ?> kr</td>
<td><?= number_format($order['total_amount'], 2) ?> kr</td>
</tr>
<?php endforeach ?>
</tbody>
</table>
<?php elseif ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
<p>Inga ordrar hittades för <strong><?= htmlspecialchars($email) ?></strong>.</p>
<?php endif; ?>
</body>
</html>