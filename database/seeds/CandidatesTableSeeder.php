<?php

use Illuminate\Database\Seeder;

class CandidatesTableSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {
        $user = \App\User::all()->pluck('id')->toArray();
        $max = max(array_values($user));
        
        factory(\App\Repositories\Candidates\Candidate::class, 30)->create()->each(function($candidate) use ($max) {
            for($i = 0; $i <= rand(1,3); $i++) {
                $candidate->users()->sync(rand(2, $max));
            }
        });
    }
}
