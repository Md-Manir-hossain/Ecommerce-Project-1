<?php

namespace Database\Seeders;

use App\Models\Banner;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $banners = [
            [
                'image'=>'banner-1.jpg',
            ],

            [
                'image'=>'banner-2.jpg',
            ],

            [
                'image'=>'banner-3.jpg',
            ]

            ];

            Banner::insert($banners);
    }
}
