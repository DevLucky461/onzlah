<?php

use Illuminate\Database\Seeder;
use App\User;
use App\NotificationSettings;

class NotificationSettingSeeder extends Seeder
{
    
    public function run()
    {
        $user = User::all();

        foreach($user as $u){

            NotificationSettings::create([
                "user_id" => $u->id,
                "setting" => "Update latest news",
                "email" => "true",
                "in_app" => "true",
            ]);

            NotificationSettings::create([
                "user_id" => $u->id,
                "setting" => "New items to redeem",
                "email" => "true",
                "in_app" => "true",
            ]);

            NotificationSettings::create([
                "user_id" => $u->id,
                "setting" => "Update Live schedule",
                "email" => "true",
                "in_app" => "true",
            ]);
          

            NotificationSettings::create([
                "user_id" => $u->id,
                "setting" => "Before Live start",
                "email" => "true",
                "in_app" => "true",
            ]);

            NotificationSettings::create([
                "user_id" => $u->id,
                "setting" => "Coins you’ve won",
                "email" => "true",
                "in_app" => "true",
            ]);


            NotificationSettings::create([
                "user_id" => $u->id,
                "setting" => "Friend request",
                "email" => "true",
                "in_app" => "true",
            ]);

            NotificationSettings::create([
                "user_id" => $u->id,
                "setting" => "Your friend request approved",
                "email" => "true",
                "in_app" => "true",
            ]);

            NotificationSettings::create([
                "user_id" => $u->id,
                "setting" => "Referral code has been used",
                "email" => "true",
                "in_app" => "true",
            ]);

        }
    }
}
