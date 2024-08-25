<?php
//set the base_path relative to our document root 'public'
const BASE_PATH = __DIR__ . "/../";

use Core\Router;
use Core\Session;
use Core\ValidationException;

require BASE_PATH . "/vendor/autoload.php";
require_once(BASE_PATH . "core/functions.php");
require_once(BASE_PATH . "bootstrap.php");

session_start();

#region Routing and router
//parse request and map route...
$router = new Router();
require(base_path('routes.php'));

$urlParts = parse_url($_SERVER['REQUEST_URI']);
$uri = $urlParts['path'];
$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD']; //either we get the hidden '_method' name or the normal GET/POST

try {
    $router->route($uri, $method);
} catch (ValidationException $exception) {

    Session::flash('errors', $exception->errors);
    Session::flash('old', $exception->old);

    return redirect($router->previousUrl());
}

#endregion Routing
Session::unflash();
