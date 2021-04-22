<?php 

$DIR = './images/';

$link = mysqli_connect('localhost:3306', 'root', 'MyNewPass', 'geekbrains');

const ROWS_NUM = 4;

try {
    $pdo = new PDO('mysql:dbname=geekbrains;host=localhost:3306', 'root', 'MyNewPass');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $err) {
    die("Error! " . $err->getMessage());
}

?>