<?php
session_start();

require('link.php');
require_once('vendor/autoload.php');

$total = 0;
$products = [];
$cart = $_SESSION['cart'];
$isCartEmpty = !isset($cart);

if (!$isCartEmpty) {
	// Создаем строку $iDs, в которой содержатся id продуктов, которые содержатся в корзине.
	$iDs = implode(', ', array_keys($_SESSION['cart']));

	$selectResult = mysqli_query($link, "SELECT * FROM products WHERE id IN ($iDs) ORDER BY counter_clicks DESC");
	if ($selectResult) {
		while ($product = mysqli_fetch_assoc($selectResult)) {
			$product['url'] = $DIR . $product['name'];
			$product['qty'] = $cart[$product['id']];
			$product['subTotal'] = $product['price'] * $product['qty'];
			$total += $product['subTotal'];
			$products[] = $product;
		}
	}
mysqli_close($link);
}

$loader = new \Twig\Loader\FilesystemLoader('./templates/');
$twig = new \Twig\Environment($loader);

echo $twig->render('cart.html.twig', [
	'isCartEmpty' => $isCartEmpty,
	'total' => $total,
	'products' => $products
]);
?>
