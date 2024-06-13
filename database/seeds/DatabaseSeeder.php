<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(BannerSeeder::class);
        //$this->call(EventSeeder::class);
        $this->call(TrialEvent::class);
        $this->call(TransactionSeeder::class);
        //$this->call(RedeemSeeder::class);
        $this->call(StickerSeeder::class);
        //$this->call(QuestionSeeder::class);
        $this->call(TrialQuestion::class);
        $this->call(NotificationSettingSeeder::class);
    }
}
