<?php

use App\class\connection\DBConnection;

require '../vendor/autoload.php';
$title = "Homepage"; 
$user = DBConnection::getAuth()->user();
?>

<h1 class="text-2xl text-blue-500">Homepage</h1>

<?php
if(isset($_GET['login'])):
?>
    <h3 class="text-xl">Welcome to the homepage <span class="text-xl text-green-500"><?= $user->username ?></span></h3>
    <div>
        <a href="./logout.php" class="mr-3 w-1/12 text-center bg-blue-500 text-white rounded mt-3 inline-block p-2 shadow-lg border border-blue-600 text-lg">Logout</a>
        <?php if($user->role === 'admin'): ?><a href="./admin" class="mr-3 w-1/12 text-center bg-blue-500 text-white rounded mt-3 inline-block p-2 shadow-lg border border-blue-600 text-lg">Admin</a><?php endif ?>
        <a href="./user" class="mr-3 w-1/12 text-center bg-blue-500 text-white rounded mt-3 inline-block p-2 shadow-lg border border-blue-600 text-lg">User</a>
        <a href="./products" class="w-1/12 text-center bg-blue-500 text-white rounded mt-3 inline-block p-2 shadow-lg border border-blue-600 text-lg">Products</a>
    </div>
    <?php
else:
    ?>
    <h3 class="text-xl">Welcome to the homepage <span class="text-xl text-green-500">stranger</span></h3>
    <div>
        <a href="./connection" class="mr-3 w-1/12 text-center bg-yellow-500 text-white rounded mt-3 inline-block p-2 shadow-lg border border-yellow-600 text-lg">Login</a>
        <a href="./admin" class="mr-3 w-1/12 text-center bg-blue-500 text-white rounded mt-3 inline-block p-2 shadow-lg border border-blue-600 text-lg">Admin</a>
        <a href="./user" class="mr-3 w-1/12 text-center bg-blue-500 text-white rounded mt-3 inline-block p-2 shadow-lg border border-blue-600 text-lg">User</a>
        <a href="./products" class="w-1/12 text-center bg-blue-500 text-white rounded mt-3 inline-block p-2 shadow-lg border border-blue-600 text-lg">Products</a>
    </div>
<?php
endif;