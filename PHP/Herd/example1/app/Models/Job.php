<?php

namespace App\Models;

use \Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Model;

//Eloquent is the ORM for Laravel. Extending Model makes your model Eloquent compatible
//it uses by convention the class name to be singular form of table
//name,like Employee for table("Employees)
//In our case here, the table name is job_listings
//so we can name our class JobListing
//OR use $table attribute to set the proper table name
class Job extends Model
{
    protected $table = "job_listings";
}
