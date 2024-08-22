<?php

function dd($value)
{
    echo "<pre>";
    var_dump($value);
    echo "</pre>";
    die();
}
function urlIs(string $url)
{
    return $_SERVER['REQUEST_URI'] === $url;
}

function urlIs2(string $url)
{
    $urlParts = parse_url($_SERVER['REQUEST_URI']);
    $currUrl = $urlParts['path'];

    return $currUrl === $url;
}


function abort($code = Response::NOT_FOUND)
{
    http_response_code($code);
    require "views/$code.php";
    die();
}
function base_path(string $path)
{
    return BASE_PATH . $path;
}

function view(string $path, $attributes = [])
{
    extract($attributes); //turns array into local variables!
    require base_path("views/" . $path);
}
