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
            INSERT INTO `positions` (`id`, `name`, `status`) VALUES
            (1, 'Giám đốc', 1), 
            (2, 'Phó Giám đốc', 1),
            (3, 'Giám đốc điều hành', 1),
            (4, 'Trưởng phòng', 1), 
            (5, 'Nhân viên', 1),
            (6, 'Thực tập sinh', 1),
            (7, 'Cộng tác viên', 1) 
            ");
    }
}
