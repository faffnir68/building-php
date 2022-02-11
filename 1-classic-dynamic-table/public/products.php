<?php
require '../vendor/autoload.php';

$title = "Products";

use App\class\helpers\NumberHelper;
use App\class\helpers\TableHelper;
use App\class\helpers\URLHelper;

// Constant
const NB_PAGE = 5;
const OFFSET = 20;

// PDO call
$pdo = new PDO("sqlite:../products.db", null, null, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
]);

if(isset($_GET['p'])) {
    $currentPage = $_GET['p'];
} else {
    $currentPage = 1;
}

// Pages counter
$reqNbProducts = "SELECT COUNT(id) as 'count_nb' FROM products ";

// Requests
$req = "SELECT * FROM products ";
if(isset($_GET['q'])) {
    $q = $_GET['q'];
    $reqCity = "WHERE city LIKE :city ";
    $req .= $reqCity;
    $reqNbProducts .= $reqCity;
    $city = "%".$q."%";
}

if(isset($_GET['sort'])) {
    $sortKey = $_GET['sort'];
    $dir = $_GET['dir'];
    $req .= " ORDER BY $sortKey $dir ";
}
$req .= "LIMIT " . OFFSET*($currentPage-1) . ", " . OFFSET . " ";     

// Preparation
$sth = $pdo->prepare($req);
$sthNbProducts = $pdo->prepare($reqNbProducts);

if(isset($_GET['q'])) {
    $sth->bindParam(':city', $city, PDO::PARAM_STR);
    $sthNbProducts->bindParam(':city', $city, PDO::PARAM_STR);
}

// Execution
$sthNbProducts->execute();
$sth->execute();

// Fetch
$nbProducts = $sthNbProducts->fetchAll();
$totalPages = (int)ceil($nbProducts[0]['count_nb'] / OFFSET);
$products = $sth->fetchAll();

?>


<div class="container-xl mx-auto">
    <div class="md:px-32 py-8 w-full">
        <h1 class="text-2xl text-sky-600 font-semibold font-mono mt-2">
            Products
        </h1>
        <form action="" class="mt-2">
            <label class="mr-1" for="q">Search by city : </label>
            <input type="text" name="q" id="q" class="border py-1 px-2 w-1/6">
        </form>
  <div class="overflow-hidden rounded mt-2">
    <table class="min-w-full">
        <thead class="bg-gray-800 text-white">
            <tr>
            <th class="w-1/12 text-left py-3 px-4 uppercase font-semibold text-sm"><?= TableHelper::sort('id', 'Id', $_GET) ?></th>
            <th class="w-1/4 text-left py-3 px-4 uppercase font-semibold text-sm"><?= TableHelper::sort('name', 'Name', $_GET) ?></th>
            <th class="w-1/4 text-left py-3 px-4 uppercase font-semibold text-sm"><?= TableHelper::sort('price', 'Price', $_GET) ?></th>
            <th class="w-1/4 text-left py-3 px-4 uppercase font-semibold text-sm"><?= TableHelper::sort('address', 'Address', $_GET) ?></td>
            <th class="w-1/4 text-left py-3 px-4 uppercase font-semibold text-sm"><?= TableHelper::sort('city', 'City', $_GET) ?></td>
            </tr>
        </thead>
        <tbody class="">
        <?php foreach($products as $product): ?>
        <tr class="odd:bg-white even:bg-slate-100">
            <td class="text-left py-3 px-4 border"><?= $product['id'] ?></td>
            <td class="w-1/4 text-left py-3 px-4 border"><?= $product['name'] ?></td>
            <td class="w-1/4 text-left py-3 px-4 border"><?= NumberHelper::priceFormat($product['price'], ' $') ?></td>
            <td class="w-1/4 text-left py-3 px-4 border"><?= $product['address'] ?></td>
            <td class="w-1/4 text-left py-3 px-4 border border-r-2"><?= $product['city'] ?></td>
        </tr>
        <?php endforeach ?>
        </tbody>
    </table>
  </div>
    <!-- Pagination start -->
    <div class="flex justify-center">
        <nav aria-label="Page navigation example">
            <ul class="flex list-style-none">
            <?php if($currentPage > 1): ?>
            <li class="page-item"><a
                class="page-link relative block py-1.5 px-3 rounded border-0 bg-transparent outline-none transition-all duration-300 rounded text-gray-800 hover:text-gray-800 focus:shadow-none"
                href="?<?= URLHelper::withParam($_GET, 'p', $currentPage-1) ?>">Previous</a>
            </li>
            <?php endif ?>
            <li class="page-item"><a
                class="page-link relative block py-1.5 px-3 rounded border-0 bg-transparent outline-none transition-all duration-300 rounded text-gray-800 hover:text-gray-800 hover:bg-gray-200 focus:shadow-none"
                href="javascript:void(0)"><?= $currentPage ?></a>
            </li>
            <?php if($currentPage < $totalPages): ?>
            <li class="page-item"><a
                class="page-link relative block py-1.5 px-3 rounded border-0 bg-transparent outline-none transition-all duration-300 rounded text-gray-800 hover:text-gray-800 hover:bg-gray-200 focus:shadow-none"
                href="?<?= URLHelper::withParam($_GET, 'p', $currentPage+1) ?>">Next</a>
            </li>
            <?php endif ?>
            </ul>
        </nav>
    </div>
    <!-- Pagination end -->

</div>
</div>