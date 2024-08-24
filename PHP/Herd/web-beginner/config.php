<?php

return [
    'database' => [
        'host' => 'localhost',
        'port' => 3306,
        'dbname' => 'webbeginner',
        'charset' => 'utf8mb4'
    ],
    //more services here
    'password_hash'   =>  function ($password) {
        return $password;
        //return password_hash($password, PASSWORD_BCRYPT);
    },
    'password_verify' => function ($password, $hash) {
        return $password === $hash;
        //return password_verify($password, $user['password'])
    }
];
