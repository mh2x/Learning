<?php

use Core\Response;

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

function authorize($condition, $status = Response::ACCESS_FORBIDDEN)
{
    if (! $condition) {
        abort($status);
    }
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

function redirect($url, $statusCode = 303)
{
    header('Location: ' . $url, true, $statusCode);
    die();
}

function login($user)
{
    $_SESSION['user'] = [
        'email' => $user['email']
    ];

    session_regenerate_id(true);
}

function logout()
{
    $_SESSION = [];  //clear the session data
    session_destroy(); // close the session

    $params = session_get_cookie_params();
    //Remove the cookie by specifying a time in the past
    setcookie('PHPSESSID', '', time() - 3600, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
}
