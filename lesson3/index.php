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
  
  
  $name = null;
  if ($isLogged) {
  	$name = $_SESSION['name'];
  }

  $countSelect = "SELECT count(*) as `count` FROM products";
  $sth = $pdo->query($countSelect);
  $row = $sth->fetch(PDO::FETCH_ASSOC);
  $numberPages = ceil($row['count'] / ROWS_NUM);

  if (empty($numberPages)) {
    throw new MyException('Нет продуктов в БД');
  }

  $loader = new \Twig\Loader\FilesystemLoader('./templates/');
  $twig = new \Twig\Environment($loader);
  echo $twig->render('index.html.twig', [
  	'isLogged' => $isLogged,
  	'isAdmin' => $isAdmin,
  	'name' => $name,
  	'numberPages' => $numberPages
  ]);

} catch (PDOException $e) {
  echo "Ошибка соединения с БД: " . $e->getMessage();
} catch (MyException $e) {
  echo "Ошибка: " . $e->getMessage();
}

?>



