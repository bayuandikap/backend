<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Expense;

class ExpenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Expense::insert([

            [
                'title' => 'Street Light Maintenance',
                'amount' => 300000,
                'expense_date' => '2026-01-10',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'title' => 'Security Guard Salary',
                'amount' => 2500000,
                'expense_date' => '2026-01-31',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'title' => 'Drainage Cleaning',
                'amount' => 450000,
                'expense_date' => '2026-02-15',
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}
