<?php

require_once("functions.php");
//parse request
$urlParts = parse_url($_SERVER['REQUEST_URI']);
$url = $urlParts['path'];

//map routes
$routes = [
    '/' => 'home',
    '/about' => 'about',
    '/notes' => "notes",
    '/note' => 'note',
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

function authorize($condition, $status = Response::ACCESS_FORBIDDEN)
{
    if (! $condition) {
        abort($status);
    }
}
