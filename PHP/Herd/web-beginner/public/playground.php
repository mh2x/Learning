<?php

use Illuminate\Support\Collection;

require __DIR__ . "/../vendor/autoload.php";

$numbers = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
$coll = new Collection([
    1,
    2,
    3,
    4,
    5,
    6,
    7,
    8,
    9,
    10,
]);

var_dump($numbers);

var_dump($coll);

//Working with arrays simplifies using the built-in assoc array
if ($coll->contains(10)){
    //..
}

$result = $coll->filter(function ($number) {
    return $number %10=== 0;
});

die();
