<?php

use Illuminate\Database\Seeder;
use App\Event;
use Carbon\Carbon;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        $entries = 10;

        for ($i = 0; $i < $entries; $i++){
            $time1 = Carbon::createFromFormat('Y-m-d H:i:s', Carbon::today()->addDays($i)->addHours(12));
            $time2 = clone $time1;
            $time2->addSeconds(7200);
            Event::create([
                'event_name' => $faker->sentence(6,true),
                'event_description' => $faker->sentence(12,true),
                'event_host_name' => $faker->name($gender = null),
                'event_start_date' => $time1,
                'event_end_date' => $time2,
                'event_coins_prize_pool' => '100000',
                'event_image_url' => $faker->randomElement([
                    '/images/live-thumbnail-1.png',
                    '/images/live-thumbnail-2.png',
                    '/images/live-thumbnail-3.png',
                    '/images/live-thumbnail-4.png',
                ]),
                'view_more_data' => '{"kol" : {"name" : "Xuan","facebook" : "https://facebook.com/test","twitter" : "https://twitter.com/test","youtube" : "https://youtube.com/test","web" : "https://lux-api.me/login"},"sponsor" : {"name" : "hotshoe","facebook" : "https://facebook.com/test","twitter" : "https://twitter.com/test","youtube" : "https://youtube.com/test","web" : "https://lux-api.me/login"},"brand" : {"name" : "kek","facebook" : "https://facebook.com/test","twitter" : "https://twitter.com/test","youtube" : "https://youtube.com/test","web" : "https://lux-api.me/login"}}',
                'stream_key' => 'https://www.youtube.com/watch?v=HphwQNhByOk',
                'question_state' => '0',
            ]);
        }
    }
}
