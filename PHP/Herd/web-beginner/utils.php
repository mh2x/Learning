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
    $urlParts = parse_url($_SERVER['REQUEST_URI']);
    $currUrl = $urlParts['path'];

    return $currUrl === $url;
}
