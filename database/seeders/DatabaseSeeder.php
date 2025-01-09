<?php

namespace Database\Seeders;

use App\Models\Budgets;
use App\Models\Categories;
use App\Models\Transaction;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Memanggil seeder untuk masing-masing tabel
        // $this->call([
        //     UserSeeder::class,
        //     CategorySeeder::class,
        //     BudgetSeeder::class,
        //     TransactionSeeder::class,
        // ]);

        // from factory
        User::factory(10)->create();
        Categories::factory(10)->create();
        Transaction::factory(10)->create();
        Budgets::factory(10)->create();
    }
}
