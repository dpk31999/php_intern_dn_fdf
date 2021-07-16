<?php

namespace Database\Seeders;

use App\Models\City;
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
        $data = [
            "Ho Chi Minh City",
            "Hanoi",
            "Thanh Hoa",
            "Nghe An",
            "Dong Nai",
            "Binh Duong",
            "Hai Phong",
            "Hai Duong",
            "Dak Lak",
            "Thai Bình",
            "An Giang",
            "Bac Giang",
            "Tien Giang",
            "Nam Dinh",
            "Long An",
            "Kien Giang",
            "Dong Thap",
            "Gia Lai",
            "Quang Nam",
            "Phu Tho",
            "Binh Dinh",
            "Bac Ninh",
            "Quang Ninh",
            "Thai Nguyen",
            "Lam Dong",
            "Ha Tinh",
            "Ben Tre",
            "Son La",
            "Hung Yen",
            "Khanh Hoa",
            "Can Tho",
            "Binh Thuan",
            "Quang Ngai",
            "Ca Mau",
            "Da Nang",
            "Tay Ninh",
            "Vinh Phuc",
            "Soc Trang",
            "Ba Ria",
            "Thura Thien",
            "Vinh Long",
            "Bình Phuoc",
            "Tra Vinh",
            "Ninh Binh",
            "Bac Lieu",
            "Quang Binh",
            "Ha Giang",
            "Phu Yen",
            "Hoa Binh",
            "Ha Nam",
            "Yen Bai",
            "Tuyen Quang",
            "Lang Son",
            "Lao Cai",
            "Hau Giang",
            "Dak Nong",
            "Quang Tri",
            "Dien Bien",
            "Ninh Thuan",
            "Kon Tum",
            "Cao Bang",
            "Lai Chau",
            "Bac Kan",
        ];

        foreach ($data as $city) {
            City::create([
                'name' => $city,
            ]);
        }
    }
}
