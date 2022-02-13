<?php
require '../vendor/autoload.php';

$router = new AltoRouter();
$router->map('GET|POST', '/', 'home', 'home');
$router->map('GET', '/products', 'products', 'products');
$router->map('GET|POST', '/connection', 'connection', 'connection');
$router->map('GET', '/user', 'user', 'user');
$router->map('GET', '/admin', 'admin', 'admin');
$match = $router->match();