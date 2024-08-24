<?php
//set the base_path relative to our document root 'public'
const BASE_PATH = __DIR__ . "/../";

use Core\Router;

require_once(BASE_PATH . "core/functions.php");

session_start();

spl_autoload_register(function ($class) {
    //dd($class); //this will tell you which class is being loaded/called
    //you can dynamically load it like so:
    //var_dump(base_path("core/{$class}.php"));

    //solve namespace issues
    $class = str_replace("\\", DIRECTORY_SEPARATOR, $class);
    require base_path("{$class}.php");
});

//We need the spl_autoload_register first
require_once(BASE_PATH . "bootstrap.php");

#region Routing and router
//parse request and map route...
$router = new Router();
require(base_path('routes.php'));

$urlParts = parse_url($_SERVER['REQUEST_URI']);
$url = $urlParts['path'];
$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD']; //either we get the hidden '_method' name or the normal GET/POST

$router->route($url, $method);
#endregion Routing
