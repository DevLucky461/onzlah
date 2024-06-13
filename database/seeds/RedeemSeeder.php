<?php

use Illuminate\Database\Seeder;
use App\Reward;
use Illuminate\Support\Str;

class RedeemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        $entries = 15;
        $data = [
            ['img_link' => '/images/reward/grab-dec20.png','amount' => '20','desc' => 'Grab RM 10 voucher', 'info' => 'Enjoy RM 10 off for your next GrabFood purchase, brought to you by OnzLAH!', 'howto' => 'Contact +601113085270 for redemption', 'tnc' => 'The redemption of this voucher is subject to Hotshoes policy'],
            ['img_link' => '/images/reward/grab-dec20.png','amount' => '20','desc' => 'Grab RM 15 voucher', 'info' => 'Enjoy RM 15 off for your next GrabFood purchase, brought to you by OnzLAH!', 'howto' => 'Contact +601113085270 for redemption', 'tnc' => 'The redemption of this voucher is subject to Hotshoes policy'],
            ['img_link' => '/images/reward/mobleg-dec20.png','amount' => '40','desc' => 'Mobile Legends RM 10 voucher', 'info' => 'Claim RM 10 worth of gems in Mobile Legends Bang Bang, brought to you by OnzLAH!', 'howto' => 'Contact +601113085270 for redemption', 'tnc' => 'The redemption of this voucher is subject to Hotshoes policy'],
            ['img_link' => '/images/reward/anw-dec20.svg','amount' => '20','desc' => 'A&W RM 30 voucher', 'info' => 'Enjoy RM 30 off for your next A&W purchase, brought to you by OnzLAH!', 'howto' => 'Contact +601113085270 for redemption', 'tnc' => 'The redemption of this voucher is subject to Hotshoes policy'],
            ['img_link' => '/images/reward/anw-dec20.svg','amount' => '40','desc' => 'A&W RM 20 voucher', 'info' => 'Enjoy RM 20 off for your next A&W purchase, brought to you by OnzLAH!', 'howto' => 'Contact +601113085270 for redemption', 'tnc' => 'The redemption of this voucher is subject to Hotshoes policy'],
            ['img_link' => '/images/reward/anw-dec20.svg','amount' => '10','desc' => 'A&W RM 10 voucher', 'info' => 'Enjoy RM 10 off for your next A&W purchase, brought to you by OnzLAH!', 'howto' => 'Contact +601113085270 for redemption', 'tnc' => 'The redemption of this voucher is subject to Hotshoes policy'],
        ];

        foreach ($data as $d){
            $reward = Reward::create([
                'img_link' => $d['img_link'],
                'cost_in_coins' => '500',
                'reward_name' => $d['desc'],
                'reward_type' => 'voucher',
                'reward_description' => $d['info'],
                'reward_howto' => $d['howto'],
                'reward_tnc' => $d['tnc'],
                'expiration_date' => now()->addDays(150),
            ]);
                
            $reward_count = \App\Reward_Count::create([
                'reward_id' => $reward->id,
                'count' => $d['amount'],
                'unlist_date' => now()->addDays(3),
            ]);
            for ($i = 0; $i < $d['amount']; $i++){
                $claim = \App\Claim::create([
                    'reward_count_id' => $reward_count->id,
                    'reward_code' =>  Str::upper($faker->bothify($faker->randomElement(['#', '?']).$faker->randomElement(['#', '?']).$faker->randomElement(['#', '?']).$faker->randomElement(['#', '?']).$faker->randomElement(['#', '?']).$faker->randomElement(['#', '?']))),
                ]);
            }
        }

        /* for($i = 0; $i < $entries; $i++){
            $reward = Reward::create([
                'img_link' => $faker->randomElement([
                    '/images/reward-thumbnail-1.png',
                    '/images/reward-thumbnail-2.png',
                    '/images/reward-thumbnail-3.png',
                    '/images/reward-thumbnail-4.png',
                    '/images/reward-thumbnail-5.png',
                ]),
                'sponsor_icon_link' => $faker->randomElement([
                    '/images/sponsor-icon-1.svg',
                    '/images/sponsor-icon-2.png',
                    '/images/sponsor-icon-3.svg',
                    '/images/sponsor-icon-4.svg',
                    '/images/sponsor-icon-5.png',
                ]),
                'cost_in_coins' => $faker->numberBetween(1,15).'00',
                'reward_type' => $faker->randomElement([
                    'voucher',
                    'points',
                    'deals',
                    'event',
                ]),
                'reward_name' => $faker->company." ".$faker->randomElement([
                    '10% discount',
                    '20% discount',
                    '50% discount',
                    '90% discount',
                    'free large set',
                    'free 2x small set',
                ]),
                //'reward_code' => 'Testcode',
                //'quantity' => 10,
                //'balance' => $faker->numberBetween(0,10),
                'expiration_date' => now()->addDays($faker->numberBetween(0,30)),
            ]);
            for($j = 0; $j < $faker->numberBetween(1,3); $j++){
                $reward_count = \App\Reward_Count::create([
                    'reward_id' => $reward->id,
                    'count' => 10,
                    'unlist_date' => $faker->optional(0.75)->passthrough(now()->addDays($faker->numberBetween(-3,3))),

                ]);

                for ($k = 0; $k < $reward_count->count; $k++){
                    $claim = \App\Claim::create([
                        'reward_count_id' => $reward_count->id,
                        'reward_code' =>  Str::upper($faker->bothify($faker->randomElement(['#', '?']).$faker->randomElement(['#', '?']).$faker->randomElement(['#', '?']).$faker->randomElement(['#', '?']).$faker->randomElement(['#', '?']).$faker->randomElement(['#', '?']))),
                    ]);
                }
            }
        } */
    }
}
