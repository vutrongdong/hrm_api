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
            INSERT INTO `plans` (`id`, `title`, `created_at`, `updated_at`) VALUES
            (1, 'Tuyển lập trình viên dự án HRM ', '2018-09-21', '2018-09-21'), 
            (2, 'Tuyển lập trình viên dự án CRM ', '2018-09-21', '2018-09-21'), 
            (3, 'Tuyển nhân viên kế toán', '2018-09-21', '2018-09-21')
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
