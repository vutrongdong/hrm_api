<?php

use Illuminate\Database\Seeder;

class BranchesTableSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {
        DB::statement("INSERT INTO `branches` (`id`, `name`, `description`, `about`, `phone`, `address`, `website`, `email`, `facebook`, `instagram`, `zalo`, `tax_number`, `bank`, `type`, `city_id`, `district_id`, `created_at`, `updated_at`) VALUES

            (1, 'Chi nhánh Cát Linh', 'description_CatLinh', 'about_CatLinh', '0971234567', 'Cát Linh', 'catlinh.com.vn', 'catlinh@nht.com', 'FB_CatLinh', 'Insta_CatLinh', 'Zalo_CatLinh', '123456', 'CatLinhBank', 1, 2, 4, '2018-09-21', '2018-09-21'),
            (2, 'Chi nhánh Láng Hạ', 'description_LangHa', 'about_LangHa', '01691234567', 'Láng Hạ', 'langha.com.vn', 'langha@nht.com', 'FB_LangHa', 'Insta_LangHa', 'Zalo_LangHa', '654321', 'LangHaBank', 0, 2, 4, '2018-09-21', '2018-09-21')

            ");
    }
}
