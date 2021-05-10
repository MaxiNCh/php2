<?php

include_once 'config/config.php';
require_once 'vendor/autoload.php';

/**
 * Routing
 */
$router = new \Geekbrains\Core\Router();

// Add the routes
$router->add('', ['namespace' => 'User', 'controller' => 'User', 'action' => 'index']);
$router->add('{namespace}/{controller}/{action}');

if (!empty($_GET['path'])) {
    $router->dispatch($_GET['path']);
} else {
    $router->dispatch($_SERVER['QUERY_STRING']);
}
