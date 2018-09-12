<?php

use Illuminate\Database\Seeder;

class DepartmentsTableSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {
        DB::statement("
            INSERT INTO `departments` (`id`, `name`, `branch_id`, `status`) VALUES
            (1, 'Phòng Nhân Sự', 1, 1), 
            (2, 'Phòng IT', 1, 1),
            (3, 'Phòng Kế toán', 1, 1),

            (4, 'Phòng Nhân Sự', 2, 1), 
            (5, 'Phòng IT', 2, 1),
            (6, 'Phòng Kế toán', 2, 1)
            ");
    }
}
