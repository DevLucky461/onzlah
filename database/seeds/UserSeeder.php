<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

         Role::create(['name' => 'user']);
         Role::create(['name' => 'admin']);

        $faker = \Faker\Factory::create();
        $faker->addProvider(new \Faker\Provider\ms_MY\PhoneNumber($faker));
        $entries = 30;

        for($i = 0; $i < $entries; $i++){
            $user = User::create([
                'name' => $faker->firstName,
                'phonenumber' => $faker->mobileNumber(false,null),
                'email' => $faker->freeEmail,
                'email_verified_at' => Carbon::now(),
                'referral_code' => '#ONZ'.$faker->bothify('######'),
                'coins' => $faker->numberBetween('0', '15000'),
                'password' => Hash::make('123456789'),
                'life' => 3,
                'verify' => 'yes',
                'verificationcode' => $faker->randomNumber(6),
            ]);

            $user->update([
                'picture' => 'images/default-picture/'.strtolower($user->name[0]).'.png'
            ]);

            $user->assignRole('user');
        }

        for($i = 0; $i < $entries * 2; $i++){
            $me = $faker->numberBetween('1', $entries);
            $iterate = $faker->numberBetween('0', '5');

            for($j = 0; $j < $iterate; $j++){
                $you = $faker->numberBetween('1', $entries);
                if ($me != $you){
                    if (App\Friend::where([
                        'user_id' => $me,
                        'friend_id' => $you,
                        'status' => "approved"
                    ])->doesntExist()){
                        App\Friend::create([
                            'user_id' => $me,
                            'friend_id' => $you,
                            'status' => "approved"
                        ]);
                    }


                    if (App\Friend::where([
                        'user_id' => $you,
                        'friend_id' => $me,
                        'status' => "approved"
                    ])->doesntExist()){
                        App\Friend::create([
                            'user_id' => $you,
                            'friend_id' => $me,
                            'status' => "approved"
                        ]);
                    }
                }
            }
        }

        $super_user = User::create([
            'name' => 'lux',
            'phonenumber' => "601120512013",
            
            'picture' => 'https://picsum.photos/200',
            'email' => 'luxollidd@gmail.com',
            'email_verified_at' => Carbon::now(),
            'referral_code' => '#ONZ'.$faker->bothify('######'),
            'coins' => '1000000',
            'password' => Hash::make('123456789'),
            'life' => 50,
            'verify' => 'yes',
            'verificationcode' => $faker->randomNumber(6),
        ]);
        $super_user->update([
            'picture' => 'images/default-picture/'.strtolower($super_user->name[0]).'.png'
        ]);

        $super_user->assignRole('admin');
        $super_user = User::create([
            'name' => 'kim',
            'phonenumber' => "601120512013",
            
            'picture' => 'https://picsum.photos/200',
            'email' => 'kim@gmail.com',
            'email_verified_at' => Carbon::now(),
            'referral_code' => '#ONZ'.$faker->bothify('######'),
            'coins' => '1000000',
            'password' => Hash::make('123456789'),
            'life' => 50,
            'verify' => 'yes',
            'verificationcode' => $faker->randomNumber(6),
        ]);
        $super_user->update([
            'picture' => 'images/default-picture/'.strtolower($super_user->name[0]).'.png'
        ]);

        $super_user->assignRole('admin');
        $super_user = User::create([
            'name' => 'ryan',
            'phonenumber' => "601120512013",
            
            'picture' => 'https://picsum.photos/200',
            'email' => 'ryan@gmail.com',
            'email_verified_at' => Carbon::now(),
            'referral_code' => '#ONZ'.$faker->bothify('######'),
            'coins' => '1000000',
            'password' => Hash::make('123456789'),
            'life' => 50,
            'verify' => 'yes',
            'verificationcode' => $faker->randomNumber(6),
        ]);
        $super_user->update([
            'picture' => 'images/default-picture/'.strtolower($super_user->name[0]).'.png'
        ]);

        $super_user->assignRole('admin');
        $super_user = User::create([
            'name' => 'xuan',
            'phonenumber' => "601120512013",
            
            'picture' => 'https://picsum.photos/200',
            'email' => 'xuan@gmail.com',
            'email_verified_at' => Carbon::now(),
            'referral_code' => '#ONZ'.$faker->bothify('######'),
            'coins' => '1000000',
            'password' => Hash::make('123456789'),
            'life' => 50,
            'verify' => 'yes',
            'verificationcode' => $faker->randomNumber(6),
        ]);
        $super_user->update([
            'picture' => 'images/default-picture/'.strtolower($super_user->name[0]).'.png'
        ]);

        $super_user->assignRole('admin');
        $super_user = User::create([
            'name' => 'benn',
            'phonenumber' => "601120512013",
            
            'picture' => 'https://picsum.photos/200',
            'email' => 'benn@gmail.com',
            'email_verified_at' => Carbon::now(),
            'referral_code' => '#ONZ'.$faker->bothify('######'),
            'coins' => '1000000',
            'password' => Hash::make('123456789'),
            'life' => 50,
            'verify' => 'yes',
            'verificationcode' => $faker->randomNumber(6),
        ]);
        $super_user->update([
            'picture' => 'images/default-picture/'.strtolower($super_user->name[0]).'.png'
        ]);

        $super_user->assignRole('admin');

        $super_user = User::create([
            'name' => 'karhow',
            'phonenumber' => "601120512013",
            
            'picture' => 'https://picsum.photos/200',
            'email' => 'karhow@gmail.com',
            'email_verified_at' => Carbon::now(),
            'referral_code' => '#ONZ'.$faker->bothify('######'),
            'coins' => '1000000',
            'password' => Hash::make('123456789'),
            'life' => 50,
            'verify' => 'yes',
            'verificationcode' => $faker->randomNumber(6),
        ]);
        $super_user->update([
            'picture' => 'images/default-picture/'.strtolower($super_user->name[0]).'.png'
        ]);

        $super_user->assignRole('admin');
        $super_user = User::create([
            'name' => 'ching',
            'phonenumber' => "601120512013",
            
            'picture' => 'https://picsum.photos/200',
            'email' => 'ching@gmail.com',
            'email_verified_at' => Carbon::now(),
            'referral_code' => '#ONZ'.$faker->bothify('######'),
            'coins' => '1000000',
            'password' => Hash::make('123456789'),
            'life' => 50,
            'verify' => 'yes',
            'verificationcode' => $faker->randomNumber(6),
        ]);
        $super_user->update([
            'picture' => 'images/default-picture/'.strtolower($super_user->name[0]).'.png'
        ]);

        $super_user->assignRole('admin');
        $super_user = User::create([
            'name' => 'jerry',
            'phonenumber' => "601120512013",
            
            'picture' => 'https://picsum.photos/200',
            'email' => 'jerry@gmail.com',
            'email_verified_at' => Carbon::now(),
            'referral_code' => '#ONZ'.$faker->bothify('######'),
            'coins' => '1000000',
            'password' => Hash::make('123456789'),
            'life' => 50,
            'verify' => 'yes',
            'verificationcode' => $faker->randomNumber(6),
        ]);
        $super_user->update([
            'picture' => 'images/default-picture/'.strtolower($super_user->name[0]).'.png'
        ]);

        $super_user->assignRole('admin');
        $super_user = User::create([
            'name' => 'lye',
            'phonenumber' => "601120512013",
            
            'picture' => 'https://picsum.photos/200',
            'email' => 'lye@gmail.com',
            'email_verified_at' => Carbon::now(),
            'referral_code' => '#ONZ'.$faker->bothify('######'),
            'coins' => '1000000',
            'password' => Hash::make('123456789'),
            'life' => 50,
            'verify' => 'yes',
            'verificationcode' => $faker->randomNumber(6),
        ]);
        $super_user->update([
            'picture' => 'images/default-picture/'.strtolower($super_user->name[0]).'.png'
        ]);

        $super_user->assignRole('admin');
        $super_user = User::create([
            'name' => 'mark',
            'phonenumber' => "601120512013",
            
            'picture' => 'https://picsum.photos/200',
            'email' => 'mark@gmail.com',
            'email_verified_at' => Carbon::now(),
            'referral_code' => '#ONZ'.$faker->bothify('######'),
            'coins' => '1000000',
            'password' => Hash::make('123456789'),
            'life' => 50,
            'verify' => 'yes',
            'verificationcode' => $faker->randomNumber(6),
        ]);
        $super_user->update([
            'picture' => 'images/default-picture/'.strtolower($super_user->name[0]).'.png'
        ]);

        $super_user->assignRole('admin');
        $super_user = User::create([
            'name' => 'OnzLAH_team',
            'phonenumber' => "601120512013",
            
            'picture' => 'https://picsum.photos/200',
            'email' => 'onzlah@gmail.com',
            'email_verified_at' => Carbon::now(),
            'referral_code' => '#ONZ'.$faker->bothify('######'),
            'coins' => '1000000',
            'password' => Hash::make('123456789'),
            'life' => 50,
            'verify' => 'yes',
            'verificationcode' => $faker->randomNumber(6),
        ]);
        $super_user->update([
            'picture' => 'images/default-picture/'.strtolower($super_user->name[0]).'.png'
        ]);

        $super_user->assignRole('admin');
        $super_user = User::create([
            'name' => 'faybian',
            'phonenumber' => "601120512013",
            
            'picture' => 'https://picsum.photos/200',
            'email' => 'faybian@gmail.com',
            'email_verified_at' => Carbon::now(),
            'referral_code' => '#ONZ'.$faker->bothify('######'),
            'coins' => '1000000',
            'password' => Hash::make('123456789'),
            'life' => 50,
            'verify' => 'yes',
            'verificationcode' => $faker->randomNumber(6),
        ]);
        $super_user->update([
            'picture' => 'images/default-picture/'.strtolower($super_user->name[0]).'.png'
        ]);

        $super_user->assignRole('admin');

        $super_user_girl = User::create([
            'name' => 'myr',
            'phonenumber' => "601120512013",
            
            'picture' => 'https://www.perropet.com/wp-content/uploads/2018/05/signs-symptoms-cat-fever-760x428.jpg',
            'email' => 'female@gmail.com',
            'email_verified_at' => Carbon::now(),
            'referral_code' => '#ONZ'.$faker->bothify('######'),
            'coins' => '1000000',
            'password' => Hash::make('123456789'),
            'life' => 50,
            'verify' => 'yes',
            'verificationcode' => $faker->randomNumber(6),
        ]);

      

        $super_user_girl->assignRole('admin');

        for ($i = 0; $i < 10; $i++){
            $test = User::create([
                'name' => 'user-'.$i,
                'phonenumber' => "601120512013",
                
                'picture' => 'https://picsum.photos/200',
                'email' => $faker->freeEmail,
                'email_verified_at' => Carbon::now(),
                'referral_code' => '#ONZ'.$faker->bothify('######'),
                'coins' => '1000000',
                'password' => Hash::make('123456789'),
                'life' => 50,
                'verify' => 'yes',
                'verificationcode' => $faker->randomNumber(6),
            ]);
    
            $test->assignRole('admin');
            $test->update([
                'picture' => 'images/default-picture/'.strtolower($test->name[0]).'.png'
            ]);
        }
    }
}
