<?php

use Illuminate\Database\Seeder;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("INSERT INTO `cities` (`id`, `zipcode`, `name`, `slug`, `order`, `status`) VALUES
            (1, '700000', 'Hồ Chí Minh', 'Ho-Chi-Minh', 1, 1),
            (2, '100000', 'Hà Nội', 'Ha-Noi', 2, 1),
            (3, '880000', 'An Giang', 'An-Giang', 3, 1),
            (4, '790000', 'Bà Rịa - Vũng Tàu', 'Ba-Ria-Vung-Tau', 4, 1),
            (5, '960000', 'Bắc Cạn', 'Bac-Can', 5, 1),
            (6, '230000', 'Bắc Giang', 'Bac-Giang', 6, 1),
            (7, '260000', 'Bạc Liêu', 'Bac-Lieu', 7, 1),
            (8, '220000', 'Bắc Ninh', 'Bac-Ninh', 8, 1),
            (9, '930000', 'Bến Tre', 'Ben-Tre', 9, 1),
            (10, '590000', 'Bình Định', 'Binh-Dinh', 10, 1),
            (11, '820000', 'Bình Dương', 'Binh-Duong', 11, 1),
            (12, '830000', 'Bình Phước', 'Binh-Phuoc', 12, 1),
            (13, '800000', 'Bình Thuận', 'Binh-Thuan', 13, 1),
            (14, '970000', 'Cà Mau', 'Ca-Mau', 14, 1),
            (15, '900000', 'Cần Thơ', 'Can-Tho', 15, 1),
            (16, '270000', 'Cao Bằng', 'Cao-Bang', 16, 1),
            (17, '550000', 'Đà Nẵng', 'Da-Nang', 17, 1),
            (18, '630000', 'Đắc Lắc', 'Dac-Lac', 18, 1),
            (19, '640000', 'Đắk Nông', 'Dak-Nong', 19, 1),
            (20, '380000', 'Điện Biên', 'Dien-Bien', 20, 1),
            (21, '810000', 'Đồng Nai', 'Dong-Nai', 21, 1),
            (22, '870000', 'Đồng Tháp', 'Dong-Thap', 22, 1),
            (23, '600000', 'Gia Lai', 'Gia-Lai', 23, 1),
            (24, '310000', 'Hà Giang', 'Ha-Giang', 24, 1),
            (25, '400000', 'Hà Nam', 'Ha-Nam', 25, 1),
            (26, '480000', 'Hà Tĩnh', 'Ha-Tinh', 26, 1),
            (27, '170000', 'Hải Dương', 'Hai-Duong', 27, 1),
            (28, '180000', 'Hải Phòng', 'Hai-Phong', 28, 1),
            (29, '910000', 'Hậu Giang', 'Hau-Giang', 29, 1),
            (30, '350000', 'Hòa Bình', 'Hoa-Binh', 30, 1),
            (31, '160000', 'Hưng Yên', 'Hung-Yen', 31, 1),
            (32, '650000', 'Khánh Hòa', 'Khanh-Hoa', 32, 1),
            (33, '920000', 'Kiên Giang', 'Kien-Giang', 33, 1),
            (34, '580000', 'Kon Tum', 'Kon-Tum', 34, 1),
            (35, '390000', 'Lai Châu', 'Lai-Chau', 35, 1),
            (36, '670000', 'Lâm Đồng', 'Lam-Dong', 36, 1),
            (37, '240000', 'Lạng Sơn', 'Lang-Son', 37, 1),
            (38, '330000', 'Lào Cai', 'Lao-Cai', 38, 1),
            (39, '850000', 'Long An', 'Long-An', 39, 1),
            (40, '420000', 'Nam Định', 'Nam-Dinh', 40, 1),
            (41, '460000 - 470000', 'Nghệ An', 'Nghe-An', 41, 1),
            (42, '430000', 'Ninh Bình', 'Ninh-Binh', 42, 1),
            (43, '660000', 'Ninh Thuận', 'Ninh-Thuan', 43, 1),
            (44, '290000', 'Phú Thọ', 'Phu-Tho', 44, 1),
            (45, '620000', 'Phú Yên', 'Phu-Yen', 45, 1),
            (46, '510000', 'Quảng Bình', 'Quang-Binh', 46, 1),
            (47, '560000', 'Quảng Nam', 'Quang-Nam', 47, 1),
            (48, '570000', 'Quảng Ngãi', 'Quang-Ngai', 48, 1),
            (49, '200000', 'Quảng Ninh', 'Quang-Ninh', 49, 1),
            (50, '520000', 'Quảng Trị', 'Quang-Tri', 50, 1),
            (51, '950000', 'Sóc Trăng', 'Soc-Trang', 51, 1),
            (52, '360000', 'Sơn La', 'Son-La', 52, 1),
            (53, '840000', 'Tây Ninh', 'Tay-Ninh', 53, 1),
            (54, '410000', 'Thái Bình', 'Thai-Binh', 54, 1),
            (55, '250000', 'Thái Nguyên', 'Thai-Nguyen', 55, 1),
            (56, '440000 - 450000', 'Thanh Hoá', 'Thanh-Hoa', 56, 1),
            (57, '530000', 'Thừa Thiên - Huế', 'Thua-Thien-Hue', 57, 1),
            (58, '860000', 'Tiền Giang', 'Tien-Giang', 58, 1),
            (59, '940000', 'Trà Vinh', 'Tra-Vinh', 59, 1),
            (60, '300000', 'Tuyên Quang', 'Tuyen-Quang', 60, 1),
            (61, '890000', 'Vĩnh Long', 'Vinh-Long', 61, 1),
            (62, '280000', 'Vĩnh Phúc', 'Vinh-Phuc', 62, 1),
            (63, '320000', 'Yên Bái', 'Yen-Bai', 63, 1)");
    }
}
