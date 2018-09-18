<?php

use Illuminate\Database\Seeder;

class PlansTableSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {
        DB::statement("
            INSERT INTO `plans` (`id`, `title`) VALUES
            (1, 'Tuyển lập trình viên dự án HRM '), 
            (2, 'Tuyển lập trình viên dự án CRM '), 
            (3, 'Tuyển nhân viên kế toán')
            ");

        DB::table('plan_details')->insert([
            [
                'plan_id' => 1,
                'department_id' => 2,
                'position_id' => 5,
                'quantity' => 3,
            ],

            [
                'plan_id' => 1,
                'department_id' => 2,
                'position_id' => 6,
                'quantity' => 2,
            ],

            [
                'plan_id' => 2,
                'department_id' => 2,
                'position_id' => 5,
                'quantity' => 2,
            ],  

            [
                'plan_id' => 2,
                'department_id' => 2,
                'position_id' => 6,
                'quantity' => 1,
            ], 

            [
                'plan_id' => 3,
                'department_id' => 3,
                'position_id' => 5,
                'quantity' => 2,
            ],

        ]);
    }
}
