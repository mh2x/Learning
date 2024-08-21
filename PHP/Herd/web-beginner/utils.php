<?php

function dd($value)
{
    echo "<pre>";
    var_dump($value);
    echo "</pre>";
    die();
}

function abort()
{
    http_response_code(404);
    require "views/404.php";
    die();
}
