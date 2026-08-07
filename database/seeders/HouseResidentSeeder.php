<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Expense;

class HouseResidentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Expense::insert([
            [
                'title' => 'Security Guard Salary',
                'amount' => 2500000,
                'expense_date' => '2026-01-31',
                'description' => 'Monthly security salary',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Street Light Maintenance',
                'amount' => 450000,
                'expense_date' => '2026-02-10',
                'description' => 'Replace damaged lamps',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Drain Cleaning',
                'amount' => 700000,
                'expense_date' => '2026-03-15',
                'description' => 'Community drainage cleaning',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Public Area Cleaning',
                'amount' => 350000,
                'expense_date' => '2026-04-05',
                'description' => 'Monthly cleaning service',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Community Event',
                'amount' => 1500000,
                'expense_date' => '2026-05-20',
                'description' => 'Independence Day preparation',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
