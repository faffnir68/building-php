<?php
require '../vendor/autoload.php';

$router = new AltoRouter();
$router->map('GET', '/', 'home', 'home');
$router->map('GET', '/products', 'products', 'products');
$router->map('GET|POST', '/connection', '/connection', 'connection');
$match = $router->match();