<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $paymentMethods = [
            [
                'bank' => 'Access bank',
                'acc_name' => 'Beauty by cindy',
                'acc_number' => 129873910,
                'is_active' => 1
            ],
            [
                'bank' => 'UBA',
                'acc_name' => 'Beauty kwenn',
                'acc_number' => 104792382,
                'is_active' => 1
            ],

        ];

        foreach ($paymentMethods as $p){
            PaymentMethod::create($p);
        } 
    }
}
