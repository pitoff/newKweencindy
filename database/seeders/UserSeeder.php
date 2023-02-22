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
                'role' => 'admin',
                'name' => 'admin admin',
                'email' => 'admin@gmail.com',
                'phone' => '08023277889',
                'address' => 'my address 1',
                'email_verified_at' => '2023-02-21 15:22:34',
                'password' => 12345,
            ],
            [
                'role' => 'default',
                'name' => 'nadia angel',
                'email' => 'nadia@gmail.com',
                'phone' => '080232',
                'address' => 'my address 2',
                'email_verified_at' => '2023-02-21 15:22:34',
                'password' => 12345,
            ],
            [
                'role' => 'default',
                'name' => 'steph nneoma',
                'email' => 'steph@gmail.com',
                'phone' => '08011178342',
                'address' => 'address no 2 central arbor',
                'email_verified_at' => '2023-02-21 15:22:34',
                'password' => 12345,
            ],

        ];

        foreach ($users as $user){
            User::create($user);
        } 
    }
}
