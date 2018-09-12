<?php

use Illuminate\Database\Seeder;

class WardsTableSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {
        DB::statement("INSERT INTO `wards` (`id`, `district_id`, `name`, `slug`, `order`, `status`) VALUES

            (1, 4, 'Phưòng Bích Câu', 'Phuong-Bich-Cau', 1, 1),
            (2, 4, 'Phưòng Cát Linh', 'Phuong-Cat-Linh', 2, 1),
            (3, 4, 'Phưòng Hàng Bột', 'Phuong-Hang-Bot', 3, 1),
            (4, 4, 'Phưòng Khâm Thiên', 'Phuong-Kham-Thien', 4, 1),
            (5, 4, 'Phưòng Khương Thượng', 'Phuong-Khuong-Thuong', 5, 1),
            (6, 4, 'Phưòng Kim Liên', 'Phuong-Kim-Lien', 6, 1),
            (7, 4, 'Phưòng Láng Hạ', 'Phuong-Lang-Ha', 7, 1),
            (8, 4, 'Phưòng Láng Thượng', 'Phuong-Lang-Thuong', 8, 1),
            (9, 4, 'Phưòng Nam Đồng', 'Phuong-Nam-Đong', 9, 1),
            (10, 4, 'Phưòng Ngã Tư Sở', 'Phuong-Nga-Tu So', 10, 1),
            (11, 4, 'Phưòng Ô Chợ Dừa', 'Phuong-O-Cho-Dua', 11, 1),
            (12, 4, 'Phưòng Phương Liên', 'Phuong-Phuong-Lien', 12, 1),
            (13, 4, 'Phưòng Phương Mai', 'Phuong-Phuong-Mai', 13, 1),
            (14, 4, 'Phưòng Quang Trung', 'Phuong-Quang-Trung', 14, 1),
            (15, 4, 'Phưòng Quốc Tử Giám', 'Phuong-Quoc-Tu-Giam', 15, 1),
            (16, 4, 'Phưòng Thịnh Quang', 'Phuong-Thinh-Quang', 16, 1),
            (17, 4, 'Phưòng Thổ Quan', 'Phuong-Tho-Quan', 17, 1),
            (18, 4, 'Phưòng Trung Liệt', 'Phuong-Trung-Liet', 18, 1),
            (19, 4, 'Phưòng Trung Phụng', 'Phuong-Trung-Phung', 19, 1),
            (20, 4, 'Phưòng Trung Tự', 'Phuong-Trung-Tu', 20, 1),
            (21, 4, 'Phưòng Văn Chương', 'Phuong-Van-Chuong', 21, 1),
            (22, 4, 'Phưòng Văn Miếu', 'Phuong-Van-Mieu', 22, 1) ");
    }
}
