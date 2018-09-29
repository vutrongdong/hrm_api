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
            INSERT INTO `departments` (`id`, `name`, `branch_id`, `created_at`, `updated_at`) VALUES
            (1, 'Phòng Nhân Sự', 1, '2018-09-21', '2018-09-21'),
            (2, 'Phòng IT', 1, '2018-09-21', '2018-09-21'),
            (3, 'Phòng Kế toán', 1, '2018-09-21', '2018-09-21'),

            (4, 'Phòng Nhân Sự', 2, '2018-09-21', '2018-09-21'),
            (5, 'Phòng IT', 2, '2018-09-21', '2018-09-21'),
            (6, 'Phòng Kế toán', 2, '2018-09-21', '2018-09-21')
            ");
    }
}
