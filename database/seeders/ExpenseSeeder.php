<?php

namespace Database\Seeders;

use App\Models\Expense;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

/**
 * ExpenseSeeder
 *
 * Creates realistic, varied expense records for the year 2026.
 *
 * RECURRING (monthly) — amounts vary slightly month-to-month so the
 * 12-month financial chart is not a flat line:
 *   • Gaji Satpam          — Rp 2,500,000 base, +/− small bonus/deduction
 *   • Token Listrik Pos    — Rp 120,000–200,000 (seasonal variation)
 *
 * OCCASIONAL — spread across different months to create natural spikes:
 *   • Feb  : Perbaikan Jalan (road repair)
 *   • Mar  : Pengadaan Alat Kebersihan (cleaning supplies restock)
 *   • May  : Perbaikan Selokan (drainage repair)
 *   • Jul  : Penggantian Lampu Jalan (street lamp replacement)
 *   • Aug  : Pembelian Tong Sampah (bin replacement)
 *   • Sep  : Pengecatan Tembok Lingkungan (fence/wall painting)
 *   • Nov  : Perbaikan Pos Satpam (security post maintenance)
 *   • Dec  : Perayaan Akhir Tahun (year-end celebration)
 *
 * Fixed year: 2026.
 * Safe to re-run: truncates table first (FK checks disabled by DatabaseSeeder).
 */
class ExpenseSeeder extends Seeder
{
    private const YEAR = 2026;

    public function run(): void
    {
        Expense::truncate();

        $this->seedRecurring();
        $this->seedOccasional();
    }

    // ─────────────────────────────────────────────────────────────────────────
    // Recurring monthly expenses
    // ─────────────────────────────────────────────────────────────────────────
    private function seedRecurring(): void
    {
        // Gaji Satpam: base Rp 2,500,000 with small deterministic variation
        // (simulates occasional overtime or THR bonus in certain months)
        $salaryByMonth = [
            1  => 2500000,
            2  => 2500000,
            3  => 2500000,
            4  => 2500000,
            5  => 2500000,
            6  => 3000000,  // tunjangan hari raya (THR) — bonus month
            7  => 2500000,
            8  => 2500000,
            9  => 2500000,
            10 => 2500000,
            11 => 2500000,
            12 => 2750000,  // bonus akhir tahun
        ];

        // Token Listrik Pos Satpam: varies with season/usage
        $electricByMonth = [
            1  => 155000,
            2  => 145000,
            3  => 140000,
            4  => 150000,
            5  => 160000,
            6  => 175000,
            7  => 185000,
            8  => 195000,
            9  => 180000,
            10 => 165000,
            11 => 155000,
            12 => 170000,
        ];

        for ($month = 1; $month <= 12; $month++) {
            Expense::create([
                'title'        => 'Gaji Satpam',
                'amount'       => $salaryByMonth[$month],
                'expense_date' => Carbon::create(self::YEAR, $month, 1)->toDateString(),
                'description'  => $month === 6
                    ? 'Gaji + Tunjangan Hari Raya petugas keamanan'
                    : ($month === 12
                        ? 'Gaji + bonus akhir tahun petugas keamanan'
                        : 'Gaji bulanan petugas keamanan'),
            ]);

            Expense::create([
                'title'        => 'Token Listrik Pos Satpam',
                'amount'       => $electricByMonth[$month],
                'expense_date' => Carbon::create(self::YEAR, $month, 5)->toDateString(),
                'description'  => 'Pembelian token listrik pos keamanan',
            ]);
        }
    }

    // ─────────────────────────────────────────────────────────────────────────
    // Occasional / one-off expenses
    // ─────────────────────────────────────────────────────────────────────────
    private function seedOccasional(): void
    {
        $occasional = [
            [
                'title'        => 'Perbaikan Jalan',
                'amount'       => 4500000,
                'expense_date' => Carbon::create(self::YEAR, 2, 12)->toDateString(),
                'description'  => 'Pengaspalan ulang jalan utama kompleks blok A–B',
            ],
            [
                'title'        => 'Pengadaan Alat Kebersihan',
                'amount'       => 850000,
                'expense_date' => Carbon::create(self::YEAR, 3, 8)->toDateString(),
                'description'  => 'Pembelian sapu, pel, dan kantong sampah untuk 3 bulan',
            ],
            [
                'title'        => 'Perbaikan Selokan',
                'amount'       => 3200000,
                'expense_date' => Carbon::create(self::YEAR, 5, 20)->toDateString(),
                'description'  => 'Normalisasi dan pengerukan saluran drainase blok C',
            ],
            [
                'title'        => 'Penggantian Lampu Jalan',
                'amount'       => 1800000,
                'expense_date' => Carbon::create(self::YEAR, 7, 15)->toDateString(),
                'description'  => 'Penggantian 4 unit lampu jalan LED yang rusak',
            ],
            [
                'title'        => 'Pembelian Tong Sampah',
                'amount'       => 600000,
                'expense_date' => Carbon::create(self::YEAR, 8, 3)->toDateString(),
                'description'  => 'Pengadaan 6 unit tong sampah pilah (organik/non-organik)',
            ],
            [
                'title'        => 'Pengecatan Tembok Lingkungan',
                'amount'       => 2100000,
                'expense_date' => Carbon::create(self::YEAR, 9, 11)->toDateString(),
                'description'  => 'Pengecatan pagar dan tembok batas kompleks',
            ],
            [
                'title'        => 'Perbaikan Pos Satpam',
                'amount'       => 1250000,
                'expense_date' => Carbon::create(self::YEAR, 11, 6)->toDateString(),
                'description'  => 'Perbaikan atap dan pengecatan ulang pos satpam',
            ],
            [
                'title'        => 'Perayaan Akhir Tahun RT',
                'amount'       => 1500000,
                'expense_date' => Carbon::create(self::YEAR, 12, 22)->toDateString(),
                'description'  => 'Konsumsi dan dekorasi acara pertemuan warga akhir tahun',
            ],
        ];

        foreach ($occasional as $item) {
            Expense::create($item);
        }
    }
}
