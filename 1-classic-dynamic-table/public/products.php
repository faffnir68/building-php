<?php
require '../vendor/autoload.php';

$pdo = new PDO("sqlite:../products.db", null, null, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
]);
$req = "SELECT * FROM products";
$sth = $pdo->prepare($req);
$sth->execute();
$products = $sth->fetchAll();

foreach($products as $product) {
    echo $product->id;
}