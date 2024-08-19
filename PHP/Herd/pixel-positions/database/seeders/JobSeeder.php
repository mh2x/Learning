<?php

namespace Database\Seeders;

use App\Models\Job;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;
use Nette\Utils\Random;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Create random tags and attach them to jobs
        for ($i = 0; $i < 4; $i++) {
            $tags = Tag::factory(rand(1, 4))->create();

            //Sequence function splits the 6 in this case 3 for each sequence

            Job::factory(6)->hasAttached($tags)->create(new Sequence(
                [
                    'featured' => false,
                    'schedule' => 'Full Time',
                ],
                [
                    'featured' => true,
                    'schedule' => 'Part Time',

                ]
            ));
        }
    }
}
