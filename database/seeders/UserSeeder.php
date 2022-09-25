<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

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
                'is_admin' => 1,
                'name' => 'admin',
                'email' => 'admin@admin',
                'phone' => '080232',
                'address' => 'my address 1',
                'password' => 12345,
            ],
            [
                'is_admin' => 0,
                'name' => 'nadia angel',
                'email' => 'nadia@gmail.com',
                'phone' => '080232',
                'address' => 'my address 2',
                'password' => 12345,
            ],
            [
                'is_admin' => 0,
                'name' => 'steph nneoma',
                'email' => 'steph@gmail.com',
                'phone' => '08011178342',
                'address' => 'address no 2 central arbor',
                'password' => 12345,
            ],

        ];

        foreach ($users as $user){
            User::create($user);
        } 
    }
}
