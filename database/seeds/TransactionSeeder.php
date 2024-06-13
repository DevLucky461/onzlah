<?php

use Illuminate\Database\Seeder;
use App\Transaction;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        $entries = 1000;

        for ($i = 0; $i < $entries; $i++){
            $trans = Transaction::create([
                'transaction_type' => $faker->randomElement([
                    'redeemed_reward',
                    'won_prize',
                    'purchased_sticker',
                ]),
                'transaction_value' => $faker->numberBetween($min = 1000, $max = 10000),
                'user_id' => $faker->numberBetween($min = 1, $max = 100),
                'event_id' => $faker->optional()->numberBetween($min = 1, $max = 20),
            ]);
            if ($trans->event_id == null) $trans->update(['reward_id' => $faker->numberBetween($min = 1, $max = 20),]);
        }
    }
}
