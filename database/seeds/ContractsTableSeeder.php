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
        /*
            TYPE:
            0: học việc
            1: cộng tác viên
            2: thử việc
            3: có thời hạn
            4: không thời hạn

            STATUS:
            0: Tiêu chuẩn
            1: Chấm dứt
            2: Gia hạn
        */
        DB::statement("
            INSERT INTO `contracts` (`type`, `user_id`, `title`,`date_sign`, `date_effective`,`date_expiration`, `created_at`, `updated_at`, `status`) VALUES
            (0, 2, 'Hợp đồng học việc', '2018-05-21', '2018-05-21', '2018-07-21', '2018-05-21', '2018-05-21', 0),
            (2, 2, 'Hợp đồng thử việc', '2018-07-23', '2018-07-23', '2018-09-23', '2018-07-23', '2018-07-23', 0),
            (4, 2, 'Hợp đồng chính thức không thời hạn', '2018-09-25', '2018-09-25', null, '2018-09-25', '2018-09-25', 0),

            (1, 3, 'Hợp đồng cộng tác viên', '2017-07-22', '2017-07-22', '2017-09-22', '2017-07-22', '2017-07-22', 1),
            (3, 3, 'Hợp đồng chính thức có thời hạn', '2017-09-24', '2017-09-24', '2018-09-24', '2017-09-24', '2018-03-24', 2),
            (4, 3, 'Hợp đồng chính thức không thời hạn', '2018-09-26', '2018-09-26', null, '2018-09-26', '2018-09-26', 0)
            ");
    }
}
