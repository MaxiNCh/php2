<?php

include_once 'config/config.php';
require_once 'vendor/autoload.php';

/**
 * Routing
 */
$router = new \Geekbrains\Core\Router();

// Add the routes
$router->add('', ['namespace' => 'User', 'controller' => 'User', 'action' => 'index']);
$router->add('{controller}/{action}', ['namespace' => 'User']);

if (!empty($_GET['path'])) {
    $router->dispatch($_GET['path']);
} else {
    $router->dispatch($_SERVER['QUERY_STRING']);
}
