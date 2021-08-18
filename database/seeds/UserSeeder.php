<?php

use App\User;
use App\UserDetail;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'buyer1',
            'email' => 'buyer1@gmail.com',
            'role_id' => 1,
            'password' => Hash::make('12345678'),
        ]); 
        // $user->save();

        $userId = $user->id;

        $user->userData = UserDetail::create([
            'nama' => 'buyer1',
            'alamat_lengkap' => 'cangaan',
            'no_telp' => '09881212',
            'user_id' => $userId,
        ]);


        $user2 = User::create([
            'name' => 'seller1',
            'email' => 'seller1@gmail.com',
            'role_id' => 2,
            'password' => Hash::make('12345678'),
        ]); 
        // $user->save();

        $userId = $user2->id;

        $user2->userData = UserDetail::create([
            'nama' => 'seller1',
            'alamat_lengkap' => 'cangaan',
            'no_telp' => '09881212',
            'user_id' => $userId,
        ]);
    }
}
