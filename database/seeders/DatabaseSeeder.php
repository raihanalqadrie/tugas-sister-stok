<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Barang;
use App\Models\BarangTransfer;
use App\Models\User;
use Database\Factories\Data\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        if (!User::where('email', 'admin@example.com')->exists()) {
            User::factory()->create([
                'name' => 'Admin',
                'last_name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => '12345678',
                'is_admin' => true,
            ]);
        }
        foreach (Product::$value as $key => $value) {
            Barang::factory()->create([
                'nama' => $value,
            ]);
        }
        BarangTransfer::factory(200)->create();
    }
}
