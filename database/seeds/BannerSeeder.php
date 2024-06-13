<?php

use Illuminate\Database\Seeder;
use App\Banner;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        $entries = 2;

        for ($i = 0; $i < $entries; $i++){
            Banner::create([
                'banner_name' => $faker->sentence(6,true),
                'banner_description' => $faker->sentence(12,true),
                'banner_image_url' => $faker->randomElement([
                    '/images/banner/banner-1.png',
                    '/images/banner/banner-2.png',
                ]),
            ]);
        }
    }
}
