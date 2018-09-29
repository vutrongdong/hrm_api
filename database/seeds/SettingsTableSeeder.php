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
        $faker = Faker\Factory::create();

        DB::table('settings')->insert([
            [
                'name'  => 'Tên công ty',
                'slug'  => 'name',
                'value' => 'Công ty CP TM&DV Nguyên Hà'
            ],

            [
                'name'  => 'Địa chỉ',
                'slug'  => 'Tầng 3, số 102 phố Thái Thịnh, Đống Đa, Hà Nội',
                'value' => '0938.622.888'
            ],

            [
                'name'  => 'Email',
                'slug'  => 'email',
                'value' => 'info@nguyenhats.com'
            ],

            [
                'name'  => 'Số điện thoại',
                'slug'  => 'phone',
                'value' => '0938622888'
            ],

            [
                'name'  => 'Website',
                'slug'  => 'website',
                'value' => 'http://nguyenhats.com'
            ],

            [
                'name'  => 'Mô tả',
                'slug'  => 'description',
                'value' => 'Cung cấp dịch vụ phát triển ứng dụng website.'
            ],

            [
                'name'  => 'Thông tin',
                'slug'  => 'about',
                'value' => 'Chúng tôi là một công ty công nghệ chuyên cung cấp các giải pháp, dịch vụ nền tảng website. Với nhiều năm kinh nghiệm phát triển những hệ thống website E-Commerce lớn như Vatgia, Mytour và rất nhiều dự án website trải rộng khắp các lĩnh vực khiến chúng tôi tự tin vào khả năng đáp ứng của mình.'
            ],

            [
                'name'  => 'Facebook',
                'slug'  => 'facebook',
                'value' => 'facebook.com/nguyenhatech'
            ],

            [
                'name'  => 'Instagram',
                'slug'  => 'instagram',
                'value' => $faker->unique()->company
            ],

            [
                'name'  => 'Zalo',
                'slug'  => 'zalo',
                'value' => $faker->unique()->company
            ],

            [
                'name'  => 'Mã số thuế',
                'slug'  => 'tax_number',
                'value' => $faker->unique()->ean8
            ],            

            [
                'name'  => 'Ngân hàng',
                'slug'  => 'bank',
                'value' => 'Maritime Bank'
            ],
        ]);
    }
}
