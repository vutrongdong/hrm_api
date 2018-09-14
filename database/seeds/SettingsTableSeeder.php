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
        DB::statement("INSERT INTO `settings` (`id`, `name`, `slug`, `value`) VALUES
            (1, 'name', 'name', 'Triplan'),
            (2, 'description', 'description', 'description_Triplan'),
            (3, 'about', 'about', 'about_Triplan'),
            (4, 'phone', 'phone', 'phone_Triplan'),
            (5, 'address', 'address', 'address_Triplan'),
            (6, 'website', 'website', 'website_Triplan'),
            (7, 'email', 'email', 'email_Triplan'),
            (8, 'facebook', 'facebook', 'facebook_Triplan'),
            (9, 'instagram', 'instagram', 'instagram_Triplan'),
            (10, 'zalo', 'zalo', 'zalo_Triplan'),
            (11, 'tax_number', 'tax_number', 'tax_number_Triplan'),
            (12, 'bank', 'bank', 'bank_Triplan')
            ");
    }
}
