<?php

//Two methods to use here:
//it('',func)
//test('', func)

use App\Models\Employer;
use App\Models\Job;

it('belongs to employer', function () {
    //AAA process (Arrange, Act, Assert)

    //-------------------
    //Arrange
    //-------------------
    $employer = Employer::factory()->create();
    $job = Job::factory()->create(
        [
            'employer_id' => $employer->id,
        ]
    );


    //-------------------
    //Act and assert
    //-------------------
    expect($job->employer->is($employer))->toBeTrue();
});

it('can have tags', function () {
    //AAA process (Arrange, Act, Assert)

    //-------------------
    //Arrange
    //-------------------
    $job = Job::factory()->create();

    //-------------------
    //Act and assert
    //-------------------
    $job->tag('Frontend');
    expect($job->tags)->toHaveCount(1);
});
