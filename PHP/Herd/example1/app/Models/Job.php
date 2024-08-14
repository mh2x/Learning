<?php

namespace App\Models;

use \Illuminate\Support\Arr;

//you can pass it to functions (closures) with use()
class Job
{
    //using explicit data type for return
    public static function all(): array
    {
        return
            [
                [
                    'id' => '1',
                    'title' => 'Director',
                    'salary' => '$50,000'
                ],
                [
                    'id' => '2',
                    'title' => 'Programmer',
                    'salary' => '$20,000'
                ],
                [
                    'id' => '3',
                    'title' => 'Teacher',
                    'salary' => '$40,000'
                ]
            ];
    }
    public static function find(int $id): array
    {
        //instead of foreach here, use laravel helper Arr for arrays
        $job = Arr::first(static::all(), fn($job) => $job['id'] == $id);
        if (! $job) {
            //handle null when we cannot find it
            abort(404);
        }
        return $job;
    }
}
