<?php

namespace Database\Seeders;

use App\Models\Budgets;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use id;

class BudgetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Budgets::create([
            'user_id' => 1, // fk ke table user
            'amount_requested' => 2000,
            'amount_approved' => 40000,
            'status' => 'menunggu persetujuan',
            'reason' => 'Anggaran terlalu besar',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
