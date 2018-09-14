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
            INSERT INTO `positions` (`id`, `name`) VALUES
            (1, 'Giám đốc'), 
            (2, 'Phó Giám đốc'),
            (3, 'Giám đốc điều hành'),
            (4, 'Trưởng phòng'), 
            (5, 'Nhân viên'),
            (6, 'Thực tập sinh'),
            (7, 'Cộng tác viên') 
            ");
    }
}
