<?php

require_once("utils.php");
//parse request
$urlParts = parse_url($_SERVER['REQUEST_URI']);
$url = $urlParts['path'];

//map routes
$routes = [
    '/' => 'home',
    '/about' => 'about',
    '/notes' => "notes",
    '/contact' => 'contact',

];

//Map the request
mapRoute($url, $routes);

function mapRoute($url, $routes)
{
    if (array_key_exists($url, $routes)) {
        $view = "controllers/$routes[$url].php";
        //dd($view);
        require $view;
    } else {
        abort();
    }
}
function abort($code = 404)
{
    http_response_code($code);
    require "views/$code.php";
    die();
}
