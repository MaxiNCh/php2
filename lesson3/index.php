<?php
session_start();

require('link.php');
require('./Functions/SignIn.php');
require_once './vendor/autoload.php';

class MyException extends Exception {

}

try {
  signIn();

  $isLogged = isset($_SESSION['login']);
  $isAdmin = isset($_SESSION['admin']);
  
  $products = [];
  $name = null;
  if ($isLogged) {
  	$name = $_SESSION['name'];
  }

  $dbh = new PDO('mysql:dbname=geekbrains;host=localhost:3306', 'root', 'MyNewPass');
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $selectProducts = 'SELECT * FROM products ORDER BY counter_clicks DESC';
  $sth = $dbh->query($selectProducts);

  while ($product = $sth->fetchObject()) {
    $product->url = $DIR . $product->name; 
  	$products[] = $product;
  }

  if (empty($products)) {
    throw new MyException('Нет продуктов в БД');
  }

  $loader = new \Twig\Loader\FilesystemLoader('./templates/');
  $twig = new \Twig\Environment($loader);
  echo $twig->render('index.html.twig', [
  	'isLogged' => $isLogged,
  	'isAdmin' => $isAdmin,
  	'name' => $name,
  	'products' => $products
  ]);

} catch (PDOException $e) {
  echo "Ошибка соединения с БД: " . $e->getMessage();
} catch (MyException $e) {
  echo "Ошибка: " . $e->getMessage();
}

?>



