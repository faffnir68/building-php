<?php
// require '../vendor/autoload.php';
require '../config/routes.php';

if(is_array($match)) {
    if(is_callable($match['target'])) {
        ob_start();
        call_user_func_array($match['target'], $match['params']);
        $contents = ob_get_contents();
        ob_end_clean();
    } else {
        ob_start();
        require "{$match['target']}.php";
        $contents = ob_get_contents();
        ob_end_clean();
    }
    require '../parts/layout.php';
} else {
	// no route was matched
	header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
}