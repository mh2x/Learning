<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    //tag->jobs
    public function jobs()
    {
        //set the pivot key name to be correct instead of the default "job_id"
        return $this->belongsToMany(job::class, relatedPivotKey: "job_listing_id");
    }
}
