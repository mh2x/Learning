<?php

namespace App\Models;

use \Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


//Eloquent is the ORM for Laravel. Extending Model makes your model Eloquent compatible
//it uses by convention the class name to be singular form of table
//name,like Employee for table("Employees)
//In our case here, the table name is job_listings
//so we can name our class JobListing
//OR use $table attribute to set the proper table name
class Job extends Model
{
    use HasFactory;

    protected $table = "job_listings";
    //Allow us to mass-assign these values:
    //this is to avoid  Illuminate\Database\Eloquent\MassAssignmentException


    //$fillable vs guarded
    //This area is debatable among devs, however, you can disable fillable
    //since it is used mainly to guard against malicious updates of fields
    // and use guarded instead. If you make guarded an empty array, then
    // Nothing is being protected
    //protected $fillable = ['title', 'salary', 'employer_id'];
    protected $guarded = [];

    //use Eloquent to map the relationship between job and employer
    //you can reference it as a property and Eloquent takes care of the rest
    //Example in php artisan tinker:
    // App\Models\Job::First()->employer
    // App\Models\Job::First()->employer.name
    //When you reference employer, it is a new SQL query
    //This is called LAZY LOADING
    public function employer()
    {
        return $this->belongsTo(Employer::class);
    }

    //A job has many tags, so
    // a job has a tag (belongs to)
    // a job has many tags (hasMany)
    //both = belongsToMany(...)
    //in other words:
    //Job->tags
    public function tags()
    {
        //We are not using the standard job_id due to another table called 'jobs'
        return $this->belongsToMany(Tag::class, foreignPivotKey: "job_listing_id");
    }
}
