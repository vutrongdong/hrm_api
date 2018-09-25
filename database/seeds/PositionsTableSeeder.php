<?php

use Illuminate\Database\Seeder;

class PositionsTableSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {
        DB::statement("
            INSERT INTO `positions` (`id`, `name`, `created_at`, `updated_at`) VALUES
            (1, 'Giám đốc', '2018-09-21', '2018-09-21'), 
            (2, 'Phó Giám đốc', '2018-09-21', '2018-09-21'),
            (3, 'Giám đốc điều hành', '2018-09-21', '2018-09-21'),
            (4, 'Trưởng phòng', '2018-09-21', '2018-09-21'), 
            (5, 'Nhân viên', '2018-09-21', '2018-09-21'),
            (6, 'Thực tập sinh', '2018-09-21', '2018-09-21'),
            (7, 'Cộng tác viên', '2018-09-21', '2018-09-21') 
            ");
    }
}
