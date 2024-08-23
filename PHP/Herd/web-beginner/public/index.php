<?php
//set the base_path relative to our document root 'public'
const BASE_PATH = __DIR__ . "/../";

require_once(BASE_PATH . "functions.php");

spl_autoload_register(function ($class) {
    //dd($class); //this will tell you which class is being loaded/called
    //you can dynamically load it like so:
    //var_dump(base_path("core/{$class}.php"));
    require base_path("core/{$class}.php");
});

include(base_path("router.php"));
