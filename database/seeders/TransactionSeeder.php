<?php

namespace Database\Seeders;

use App\Models\Transaction;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Transaction::create([
            'type' => 'pendapatan',
            'amount' => 20000,
            'description' => 'pendapatan dari penjualan',
            'status' => 'disetujui',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
