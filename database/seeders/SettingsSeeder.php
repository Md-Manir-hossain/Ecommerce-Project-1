<?php

namespace Database\Seeders;

use App\Models\Settings;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            [
                'phone'=> '01908-739091',
                'email'=> 'madmanirhossainb150@gamil.com',
                'address'=> 'Nabinagar, Brahmanbaria.',
                'facebook'=> 'https://www.facebook.com/md.manir.hossain.884267',
                'instagram'=> 'https://www.instagram.com/digital_marketer_pro2/',
                'twitter'=> 'https://x.com/Manir97',
                'pinterest'=> 'http:://www.pinterest.com',
                'youtube'=> 'https://www.youtube.com/@innovativewebschool',
                'logo'=> 'logo.png',
                'hero_image'=> 'hero.png',
                'free_shipping_amount'=> 20000
            ]
        ];

        Settings::insert($settings);
    }
}
