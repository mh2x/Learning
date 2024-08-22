<?php

require_once("functions.php");
$routes = require('routes.php');

//parse request
$urlParts = parse_url($_SERVER['REQUEST_URI']);
$url = $urlParts['path'];

//Map the request to a controller
mapRouteToController($url, $routes);

function mapRouteToController($url, $routes)
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
