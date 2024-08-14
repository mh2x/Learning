<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employer extends Model
{
    use HasFactory;

    //to test this with php artisan tinker do:
    //App\Models\Job::First()->employer->jobs
    //App\Models\Job::First()->employer->jobs[0] or App\Models\Job::First()->employer->jobs->first()
    //NOTE: it seems First or first both are fine!
    public function jobs()
    {
        return $this->hasMany(Job::class);
    }
}
