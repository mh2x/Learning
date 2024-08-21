<?php

include("utils.php");

//parse request 
$urlParts = parse_url($_SERVER['REQUEST_URI']);
$url = $urlParts['path'];

//map routes

$routes = [
    '/' => 'home',
    '/about' => 'about',
    '/contact' => 'contact',

];
if (array_key_exists($url, $routes)) {
    $view = "controllers/$routes[$url].php";
    //dd($view);
    require $view;
} else {
    http_response_code(404);
    echo "'$url' page not found.";
    die();
}
