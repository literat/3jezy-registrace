<?php

use Illuminate\Database\Seeder;
use App\Models\Roles;
use App\Models\User;

class UserSeeder extends Seeder{

    public function run(){
        DB::table('users')->delete();

        $adminRole = Roles::whereName('administrator')->first();
        $userRole = Roles::whereName('user')->first();

        $user = User::create(array(
            'first_name'    => 'John',
            'last_name'     => 'Doe',
            'email'         => 'j.doe@codingo.me',
            'password'      => Hash::make('password'),
            'token'         => str_random(64),
            'activated'     => true
        ));
        $user->assignRole($adminRole);

        $user = User::create(array(
            'first_name'    => 'Jane',
            'last_name'     => 'Doe',
            'email'         => 'jane.doe@codingo.me',
            'password'      => Hash::make('janesPassword'),
            'token'         => str_random(64),
            'activated'     => true
        ));
        $user->assignRole($userRole);
    }
}