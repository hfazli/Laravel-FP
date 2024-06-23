<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Menggunakan data nyata
        $users = [
            ['name' => 'Faith', 'email' => 'admin@gmail.com', 'password' => bcrypt('admin123'), 'role' => 'admin']
            // Tambahkan data lainnya sesuai kebutuhan
        ];

        // Insert data ke dalam database
        DB::table('users')->insert($users);
    }
}