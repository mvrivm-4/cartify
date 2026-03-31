<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'demo@cartify.test'],
            ['name' => 'Cartify Demo User', 'password' => 'password']
        );

        $this->call([
            ProductSeeder::class,
        ]);
    }
}
