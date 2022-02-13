<?php

use App\class\connection\DBConnection;

require '../vendor/autoload.php';
$title = "User page"; 

DBConnection::getAuth()->requireRole('admin', 'user');

?>

<h1>User</h1>