<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        
        $users = [
            [
                'name' => 'admin',
                'email' => 'admin@admin.com',
                'password' =>  Hash::make('123456'),
                'created_at' => date("Y-m-d H:i:s"),

            ],
            [
                'name' => 'super admin',
                'email' => 'sadmin@sadmin.com',
                'password' =>  Hash::make('123456'),
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'name' => 'manager',
                'email' => 'manager@manager.com',
                'password' =>  Hash::make('123456'),
                'created_at' => date("Y-m-d H:i:s"),
            ],
        ];

        DB::table('users')->insert($users);
    }
}
