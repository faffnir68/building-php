<?php

use App\class\connection\DBConnection;

require '../vendor/autoload.php';
$title = "Admin page"; 

DBConnection::getAuth()->requireRole('admin');

?>

<h1>Admin</h1>