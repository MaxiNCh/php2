<?php 
session_start();

require('link.php');
require_once './vendor/autoload.php';

global $link;

$id = (int) $_GET['productId'];
$select = "SELECT * FROM products WHERE id = '$id'";
$selectResult = mysqli_query($link, $select);
$product = mysqli_fetch_assoc($selectResult);
$product['url'] = $DIR . $product['name'];

$isCartEmpty = !isset($_SESSION['cart'][$id]);
$qty = null;
$subTotal = null;

if (!$isCartEmpty) {
	$qty = $_SESSION['cart'][$id];
	$subTotal = $qty * $product['price'];
}

$loader = new \Twig\Loader\FilesystemLoader('./templates/');
$twig = new \Twig\Environment($loader);
echo $twig->render('product.html.twig', [
	'id' => $id,
	'selectResult' => $selectResult,
	'product' => $product,
	'isCartEmpty' => $isCartEmpty,
	'qty' => $qty,
	'subTotal' => $subTotal,
]);

mysqli_close($link);
?>