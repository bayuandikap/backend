<?php

namespace Database\Seeders;

use App\Models\Payment;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Payment::insert([

            // House A-01
            [
                'house_id' => 1,
                'payment_type_id' => 1,
                'month' => 7,
                'year' => 2026,
                'amount' => 100000,
                'paid_at' => '2026-07-05',
                'status' => 'paid',
                'notes' => 'Paid on time',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'house_id' => 1,
                'payment_type_id' => 1,
                'month' => 8,
                'year' => 2026,
                'amount' => 100000,
                'paid_at' => null,
                'status' => 'unpaid',
                'notes' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // House A-02
            [
                'house_id' => 2,
                'payment_type_id' => 1,
                'month' => 8,
                'year' => 2026,
                'amount' => 100000,
                'paid_at' => '2026-08-02',
                'status' => 'paid',
                'notes' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // House A-03
            [
                'house_id' => 3,
                'payment_type_id' => 2,
                'month' => 8,
                'year' => 2026,
                'amount' => 50000,
                'paid_at' => '2026-08-03',
                'status' => 'paid',
                'notes' => 'Garbage fee',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'house_id' => 4,
                'payment_type_id' => 2,
                'month' => 8,
                'year' => 2026,
                'amount' => 50000,
                'paid_at' => null,
                'status' => 'unpaid',
                'notes' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'house_id' => 5,
                'payment_type_id' => 3,
                'month' => 8,
                'year' => 2026,
                'amount' => 75000,
                'paid_at' => '2026-08-01',
                'status' => 'paid',
                'notes' => 'Community contribution',
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}
