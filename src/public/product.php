<?php
require_once('../database/db_connect.php');
if (!isset($_GET['id'])) {
die("Ingen produkt vald.");
}
$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");

$stmt->execute([$id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$product) {
die("Produkten hittades inte.");
}
?>
<!DOCTYPE html>
<html lang="sv">
<head>
<meta charset="UTF-8">
<title><?= htmlspecialchars($product['name']) ?> - Muna Jewels</title>
</head>
<body>
<h1><?= htmlspecialchars($product['name']) ?></h1>
<img src="<?= htmlspecialchars($product['image_url']) ?>" alt="<?=
htmlspecialchars($product['name']) ?>" style="max-width:300px;"><br>
<p><?= htmlspecialchars($product['description']) ?></p>
<p><strong>Pris: <?= $product['price'] ?> kr</strong></p>
<h2>Beställ denna produkt</h2>
<form action="checkout.php" method="post">
<input type="hidden" name="product_id" value="<?= $product['id'] ?>">
<label for="quantity">Antal:</label>
<input type="number" name="quantity" id="quantity" value="1" min="1"><br><br>
<h3>Kunduppgifter</h3>
<input type="text" name="first_name" placeholder="Förnamn" required><br>
<input type="text" name="last_name" placeholder="Efternamn" required><br>
<input type="email" name="email" placeholder="E-post" required><br>
<input type="text" name="phone" placeholder="Telefon" required><br>
<input type="text" name="address" placeholder="Adress" required><br>
<input type="text" name="postal_code" placeholder="Postnummer" required><br>
<input type="text" name="city" placeholder="Stad" required><br><br>
<button type="submit">Skicka beställning</button>
</form>
</body>
</html>