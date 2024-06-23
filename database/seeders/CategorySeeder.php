<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Menggunakan data nyata
        $categories = [
            ['name' => 'Nike', 'description' => 'Nike adalah perusahaan Amerika Serikat yang bergerak dalam desain, pengembangan, manufaktur, dan pemasaran sepatu, pakaian, perlengkapan, aksesori, dan layanan lainnya terkait olahraga dan kebugaran'],
            ['name' => 'Adidas', 'description' => 'Adidas adalah perusahaan Jerman yang dikenal di seluruh dunia karena produk-produknya dalam industri pakaian olahraga dan perlengkapan atletik'],
            ['name' => 'Puma', 'description' => 'Puma adalah perusahaan Jerman yang dikenal di seluruh dunia karena produk-produknya dalam industri pakaian dan perlengkapan olahraga'],
        ];

        // Insert data ke dalam database
        DB::table('categories')->insert($categories);
    }
}