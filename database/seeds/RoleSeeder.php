<?php

use Illuminate\Database\Seeder;
use App\Models\Roles;

class RoleSeeder extends Seeder{

    public function run(){
        DB::table('roles')->delete();

        Roles::create([
            'name'   => 'user'
        ]);

        Roles::create([
            'name'   => 'administrator'
        ]);

    }
}