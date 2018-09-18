<?php

use Illuminate\Database\Seeder;

class ContractsTableSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {
        DB::statement("
            INSERT INTO `contracts` (`type`, `title`) VALUES
            (0, 'Hợp đồng học việc'), 
            (1, 'Hợp đồng thử việc'),
            (2, 'Hợp đồng cộng tác viên'),
            (3, 'Hợp đồng chính thức có thời hạn'), 
            (4, 'Hợp đồng chính thức không thời hạn')
            ");

        DB::table('contract_user')->insert([
            [
                'id' => 1,
                'user_id' => 2,
                'contract_id' => 1
            ],

            [
                'id' => 2,
                'user_id' => 2,
                'contract_id' => 2
            ],
        ]);
    }
}
