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
            INSERT INTO `departments` (`id`, `name`, `branch_id`) VALUES
            (1, 'Phòng Nhân Sự', 1), 
            (2, 'Phòng IT', 1),
            (3, 'Phòng Kế toán', 1)
            ");
    }
}
