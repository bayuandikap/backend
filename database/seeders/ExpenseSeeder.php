<?php

namespace Database\Seeders;

use App\Models\Expense;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ExpenseSeeder extends Seeder
{
    public function run(): void
    {
        Expense::truncate();

        $year = Carbon::now()->year;

        /*
        ===========================================
        EXPENSE RUTIN
        ===========================================
        */

        for ($month = 1; $month <= 12; $month++) {

            Expense::create([
                'title' => 'Gaji Satpam',
                'amount' => 2500000,
                'expense_date' => Carbon::create($year, $month, 1),
                'description' => 'Gaji petugas keamanan',
            ]);

            Expense::create([
                'title' => 'Token Listrik Pos Satpam',
                'amount' => 150000,
                'expense_date' => Carbon::create($year, $month, 5),
                'description' => 'Pembelian token listrik',
            ]);

            Expense::create([
                'title' => 'Kebersihan Lingkungan',
                'amount' => 300000,
                'expense_date' => Carbon::create($year, $month, 10),
                'description' => 'Biaya alat kebersihan',
            ]);
        }

        /*
        ===========================================
        INSIDENTIL
        ===========================================
        */

        Expense::create([
            'title' => 'Perbaikan Jalan',
            'amount' => 5000000,
            'expense_date' => Carbon::create($year, 2, 15),
            'description' => 'Perbaikan jalan utama kompleks',
        ]);

        Expense::create([
            'title' => 'Perbaikan Selokan',
            'amount' => 3500000,
            'expense_date' => Carbon::create($year, 6, 18),
            'description' => 'Normalisasi saluran air',
        ]);

        Expense::create([
            'title' => 'Pengecatan Pos Satpam',
            'amount' => 1500000,
            'expense_date' => Carbon::create($year, 9, 7),
            'description' => 'Perawatan pos satpam',
        ]);

        Expense::create([
            'title' => 'Penggantian Lampu Jalan',
            'amount' => 2000000,
            'expense_date' => Carbon::create($year, 11, 9),
            'description' => 'Lampu jalan rusak',
        ]);
    }
}
