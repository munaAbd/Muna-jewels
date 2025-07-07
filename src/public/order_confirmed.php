<!DOCTYPE html>
<html lang="sv">
<head>
<meta charset="UTF-8">
<title>Order bekräftad</title>
</head>
<body>
<h1>Tack för din beställning!</h1>
<p>Din order har tagits emot och hanteras just nu.</p>
<?php if (isset($_GET['order_id'])): ?>

<p>Ditt ordernummer är <strong>#<?= htmlspecialchars($_GET['order_id']) ?></strong>.</p>
<?php endif; ?>
<a href="products_mainpage.php">Tillbaka till produkter</a>
</body>
</html>