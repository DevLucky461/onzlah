<?php

use Illuminate\Database\Seeder;
use App\Sticker;
use App\Sticker_State;
use App\Event;

class StickerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        $entries = 8;

        $event = Event::all();

        for ($i = 1; $i <= $entries; $i++){
            $sticker = Sticker::create([
                'sticker_name' => 'sticker-'.$i,
                'src' => '/images/stickers/'.$i.'.png',
                'sticker_cost' => 25,
            ]);

            foreach ($event as $e){
                Sticker_State::create([
                    'event_id' => $e->id,
                    'sticker_id' => $sticker->id,
                    'quantity' => 0,
                ]);
            }
        }
    }
}
