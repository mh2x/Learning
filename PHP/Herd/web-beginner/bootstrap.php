<?php

use Core\Container;
use Core\Database;
use Core\App;
//
// We use service containers and singleton App to 
// minimize duplication of using Database class
// This is sort of like simple Dependency Injection 
// look alike
//
$config = require(base_path("config.php"));
$container = new Container();

$container->bind(Database::class, function () use ($config) {
    return  new Database($config['database'], 'root', 'Mh2x@WLM');
});

//Register the container to be used 
// in the app
App::setContainer($container);
