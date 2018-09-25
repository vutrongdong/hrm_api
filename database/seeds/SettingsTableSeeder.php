<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {
        DB::statement("INSERT INTO `settings` (`id`, `name`, `slug`, `value`, `created_at`, `updated_at`) VALUES
            (1, 'name', 'name', 'Triplan', '2018-09-21', '2018-09-21'),
            (2, 'description', 'description', 'description_Triplan', '2018-09-21', '2018-09-21'),
            (3, 'about', 'about', 'about_Triplan', '2018-09-21', '2018-09-21'),
            (4, 'phone', 'phone', 'phone_Triplan', '2018-09-21', '2018-09-21'),
            (5, 'address', 'address', 'address_Triplan', '2018-09-21', '2018-09-21'),
            (6, 'website', 'website', 'website_Triplan', '2018-09-21', '2018-09-21'),
            (7, 'email', 'email', 'email_Triplan', '2018-09-21', '2018-09-21'),
            (8, 'facebook', 'facebook', 'facebook_Triplan', '2018-09-21', '2018-09-21'),
            (9, 'instagram', 'instagram', 'instagram_Triplan', '2018-09-21', '2018-09-21'),
            (10, 'zalo', 'zalo', 'zalo_Triplan', '2018-09-21', '2018-09-21'),
            (11, 'tax_number', 'tax_number', 'tax_number_Triplan', '2018-09-21', '2018-09-21'),
            (12, 'bank', 'bank', 'bank_Triplan', '2018-09-21', '2018-09-21')
            ");
    }
}
