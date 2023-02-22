<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'category' => 'white wedding',
                'description' => 'make overs for white wedding',
                'price' => 250000
            ],
            [
                'category' => 'traditional wedding',
                'description' => 'make overs for traditional',
                'price' => 200000
            ],
            [
                'category' => 'birthday make-up',
                'description' => 'birthday make up',
                'price' => 30000
            ],
        ];

        foreach ($categories as $cat){
            Category::create($cat);
        }
    }
}
