<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * DatabaseSeeder
 *
 * Orchestrates all seeders in dependency order.
 * FK checks are disabled for the full run so seeders can truncate/delete
 * tables that have foreign-key references without ordering constraints.
 *
 * Run order:
 *   1. AdminUserSeeder     — admin login credentials
 *   2. HouseSeeder         — 20 houses across 4 blocks
 *   3. ResidentSeeder      — 33 residents (permanent + contract)
 *   4. HouseResidentSeeder — household assignments + historical records
 *   5. PaymentTypeSeeder   — Satpam (Rp 100,000) + Kebersihan (Rp 15,000)
 *   6. PaymentSeeder       — 12-month payment history for occupied houses
 *   7. ExpenseSeeder       — recurring + occasional RT expenses for 2026
 */
class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $this->call([
            AdminUserSeeder::class,
            HouseSeeder::class,
            ResidentSeeder::class,
            HouseResidentSeeder::class,
            PaymentTypeSeeder::class,
            PaymentSeeder::class,
            ExpenseSeeder::class,
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
