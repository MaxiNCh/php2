<?php 

require('../link.php');
require_once('../vendor/autoload.php');

try {
  $products = [];
  
  $pageNum = isset($_POST["page"]) ? (((int) $_POST["page"]) > 0 ? (int) $_POST["page"] : 1) : 1;
  $start = ($pageNum - 1) * ROWS_NUM;

  $fetchedProducts = $pdo->prepare("SELECT * FROM products ORDER BY counter_clicks DESC LIMIT $start, ". ROWS_NUM);
  $fetchedProducts->execute();

  while ($product = $fetchedProducts->fetch(PDO::FETCH_ASSOC)) {
    $product['url'] = $DIR . $product['name']; 
    $products[] = $product;
  }

  $loader = new \Twig\Loader\FilesystemLoader('../templates/');
  $twig = new \Twig\Environment($loader);
  echo $twig->render('productCard.html.twig', [
    'products' => $products,
  ]);

} catch (PDOException $e) {
  echo "Ошибка соединения с БД. " . $e->getMessage();  
} 

?>