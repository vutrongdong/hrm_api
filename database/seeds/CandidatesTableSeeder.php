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
        DB::statement("
            INSERT INTO `candidates` (`name`, `plan_id`, `position_id`, `status`) VALUES
            ('Nguyễn Văn A', 1, 5, 0), 
            ('Nguyễn Văn B', 1, 5, 1),
            ('Nguyễn Văn C', 2, 6, 2),
            ('Nguyễn Thị D', 2, 6, 3), 
            ('Nguyễn Thị E', 3, 5, 0)
            ");

        DB::table('interview')->insert([
            [
                'candidate_id' => 1,
                'interview_by' => 1,
            ],

            [
                'candidate_id' => 1,
                'interview_by' => 2,
            ],

            [
                'candidate_id' => 2,
                'interview_by' => 2,
            ]
        ]);
    }
}
