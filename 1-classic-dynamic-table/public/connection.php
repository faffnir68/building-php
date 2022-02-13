<?php 
use App\class\auth\Auth;
use App\class\auth\User;
require '../vendor/autoload.php';
$title = "Connection"; 
$error = false;

$pdo = new PDO('sqlite: ../../../data.sqlite', null, null, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
]);


if($_POST) {
    $user = new Auth($pdo);
    $user->login($_POST['username'], $_POST['password']);
    if($user) {
        header('Location: /?login=1');
        exit();
    }
}
else {
    $error = "Please enter a correct username and/or password";
}



?>

<h1>Connection</h1>
<div class="container-md w-full mx-auto">
    <p class="text-red-500 text-xs"><?= $error ?></p>
    <div class="block p-6 rounded-lg shadow-lg bg-white max-w-sm mx-auto">
      <form method="post" action"#">
        <div class="form-group mb-6">
          <label for="exampleInputEmail1" class="form-label inline-block mb-2 text-gray-700">Username</label>
          <input type="text" class="form-control
            block
            w-full
            px-3
            py-1.5
            text-base
            font-normal
            text-gray-700
            bg-white bg-clip-padding
            border border-solid border-gray-300
            rounded
            transition
            ease-in-out
            m-0
            focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" id="username"
            aria-describedby="usernameHelp" placeholder="Enter your username" name="username">
        </div>
        <div class="form-group mb-6">
          <label for="password" class="form-label inline-block mb-2 text-gray-700">Password</label>
          <input type="password" class="form-control block
            w-full
            px-3
            py-1.5
            text-base
            font-normal
            text-gray-700
            bg-white bg-clip-padding
            border border-solid border-gray-300
            rounded
            transition
            ease-in-out
            m-0
            focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" id="exampleInputPassword1"
            placeholder="Password" name="password">
        </div>
        <button type="submit" class="
          px-6
          py-2.5
          bg-blue-600
          text-white
          font-medium
          text-xs
          leading-tight
          uppercase
          rounded
          shadow-md
          hover:bg-blue-700 hover:shadow-lg
          focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0
          active:bg-blue-800 active:shadow-lg
          transition
          duration-150
          ease-in-out">Connect</button>
      </form>
    </div>

</div>