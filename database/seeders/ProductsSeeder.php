<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Products;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    { {
            Products::create([
                'name' => 'Nike Air Force 1',
                'description' => 'The Nike Air Force 1 White is an iconic sneaker that has stood the test of time since its debut in 982.',
                'price' => 1899.000,
                'stock' => 10,
                'size' => '38, 39, 40, 41, 42, 43',
                'image' => 'assets/nikeAirForce1.png',
                'category_id' => 1,
            ]);
        }
    }
}