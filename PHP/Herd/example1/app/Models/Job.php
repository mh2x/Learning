<?php

namespace App\Models;

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
}
