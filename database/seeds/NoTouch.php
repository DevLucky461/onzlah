<?php

use Illuminate\Database\Seeder;

class NoTouch extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $this->call(UserSeeder::class);
        $this->call(RedeemSeeder::class);
        $this->call(EventSeeder::class);
        $this->call(BannerSeeder::class);
        $this->call(QuestionSeeder::class);
    }
}
