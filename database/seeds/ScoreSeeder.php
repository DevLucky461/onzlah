<?php

use Illuminate\Database\Seeder;

class ScoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        $entries = 100;


        for($i = 0; $i < 30; $i++){
            $ue = User_Event::create([
                    'user_id' => $faker->unique()->numberBetween(1,100),
                    'event_id' => 1,
                    'status' => 'pass',
                ]);

            User_Question::create([

            ]);
        }
    }
}
