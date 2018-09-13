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
        DB::statement("INSERT INTO `branches` (`id`, `name`, `description`, `about`, `phone`, `address`, `website`, `email`, `facebook`, `instagram`, `zalo`, `tax_number`, `bank`, `type`, `city_id`, `district_id`, `status`) VALUES

            (1, 'Chi nhánh Cát Linh', 'description_1', 'about_1', 'phone_1', 'address_1', 'website_1', 'email_1', 'facebook_1', 'instagram_1', 'zalo_1', 'tax_number_1', 'bank_1', 1, 2, 4, 1),
            (2, 'Chi nhánh Láng Hạ', 'description_2', 'about_2', 'phone_2', 'address_2', 'website_2', 'email_2', 'facebook_2', 'instagram_2', 'zalo_2', 'tax_number_2', 'bank_2', 2, 2, 4, 1)

            ");
    }
}
