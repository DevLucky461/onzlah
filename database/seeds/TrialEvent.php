<?php

use Illuminate\Database\Seeder;
use App\Event;
use Carbon\Carbon;

class TrialEvent extends Seeder
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
        $timee1 = Carbon::createFromFormat('Y-m-d H:i:s', Carbon::today()->addHours(12));
        $timee2 = clone $timee1;
        $timee2->addSeconds(7200);
        Event::create([
            'event_name' => 'First Run for OnzLAH!',
            'event_description' => 'ITS HAPPENING, RIGHT HERE, RIGHT NOW. PLAY, EARN, SPEND!!!',
            'event_host_name' => 'Xuan',
            'event_start_date' => $timee1,
            'event_end_date' => $timee2,
            'event_coins_prize_pool' => '100000',
            'event_image_url' => '/images/event/host/example-sean-lee.png',
            'stream_key' => 'https://www.youtube.com/watch?v=HphwQNhByOk',
            'question_state' => '0',
            'view_more_data' => '{"kol" : {"name" : "Xuan","facebook" : "https://facebook.com/test","twitter" : "https://twitter.com/test","youtube" : "https://youtube.com/test","web" : "https://lux-api.me/login"},"sponsor" : {"name" : "hotshoe","facebook" : "https://facebook.com/test","twitter" : "https://twitter.com/test","youtube" : "https://youtube.com/test","web" : "https://lux-api.me/login"},"brand" : {"name" : "kek","facebook" : "https://facebook.com/test","twitter" : "https://twitter.com/test","youtube" : "https://youtube.com/test","web" : "https://lux-api.me/login"}}',
        ]);

        for ($i = 0; $i < $entries; $i++){
            $time1 = Carbon::createFromFormat('Y-m-d H:i:s', Carbon::today()->addDays($i)->addHours(12));
            $time2 = clone $time1;
            $time2->addSeconds(7200);
            Event::create([
                'event_description' => $faker->sentence(6,true),
                'event_name' => $faker->randomElement([
                    'Hooray! It’s time to PLAY! EARN! SPEND!',
                    'Special Live! Special Appearance!',
                    'Tune in NOW! Join the party!',
                    'New Deal in wait what? Play now #onzlah',
                    'You bet there’s a chase to win coins!',
                ]),
                'event_host_name' => 'Sean Lee',
                'event_start_date' => $time1,
                'event_end_date' => $time2,
                'event_coins_prize_pool' => '100000',
                'event_image_url' => '/images/event/host/example-sean-lee.png',
                'stream_key' => 'https://www.youtube.com/watch?v=HphwQNhByOk',
                'question_state' => '0',
                'view_more_data' => '{"kol" : {"name" : "Xuan","facebook" : "https://facebook.com/test","twitter" : "https://twitter.com/test","youtube" : "https://youtube.com/test","web" : "https://lux-api.me/login"},"sponsor" : {"name" : "hotshoe","facebook" : "https://facebook.com/test","twitter" : "https://twitter.com/test","youtube" : "https://youtube.com/test","web" : "https://lux-api.me/login"},"brand" : {"name" : "kek","facebook" : "https://facebook.com/test","twitter" : "https://twitter.com/test","youtube" : "https://youtube.com/test","web" : "https://lux-api.me/login"}}',
            ]);
        }
    }
}
