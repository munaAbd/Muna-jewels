<?php
require_once('../database/db_connect.php');
$stmt = $pdo->query("SELECT * FROM products");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="sv">
<head>
<meta charset="UTF-8">
<title>Produkter - Muna Jewels</title>
<link rel="stylesheet" href="css/style.css">
<style>
.product {
border: 1px solid #ccc;
border-radius: 8px;

padding: 1rem;
margin: 1rem;
width: 250px;
text-align: center;
float: left;
}
img {
max-width: 100%;
height: auto;
}
.container {
display: flex;
flex-wrap: wrap;
}
</style>
</head>
<body>
<h1>Våra produkter</h1>
<div class="container">
<?php foreach ($products as $product): ?>
<div class="product">
<h2><?= htmlspecialchars($product['name']) ?></h2>
<img src="<?= htmlspecialchars($product['image_url']) ?>" alt="<?=
htmlspecialchars($product['name']) ?>">
<p><?= htmlspecialchars($product['description']) ?></p>
<p><strong><?= $product['price'] ?> kr</strong></p>
<form action="product.php" method="get">
<input type="hidden" name="id" value="<?= $product['id'] ?>">
<button type="submit">Läs mer</button>
</form>
</div>
<?php endforeach; ?>
</div>
<p><a href="order_history.php">Se din orderhistorik</a></p>
</body>
</html>