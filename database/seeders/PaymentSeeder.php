<?php

namespace Database\Seeders;

use App\Models\Payment;
use App\Models\PaymentType;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PaymentSeeder extends Seeder
{
    public function run(): void
    {
        Payment::query()->delete();

        $year = Carbon::now()->year;

        $paymentTypes = PaymentType::all();

        /*
         House 1
         Membayar semua tagihan selama 12 bulan
        */

        foreach ($paymentTypes as $type) {

            for ($month = 1; $month <= 12; $month++) {

                Payment::create([

                    'house_id' => 1,

                    'payment_type_id' => $type->id,

                    'month' => $month,

                    'year' => $year,

                    'amount' => $type->default_amount,

                    'paid_at' => Carbon::create($year, $month, rand(1, 10)),

                    'status' => 'paid',

                    'notes' => 'Pembayaran tahunan',

                ]);

            }

        }

        /*
         House 2-19
         Pembayaran bulanan
        */

        for ($house = 2; $house <= 19; $house++) {

            foreach ($paymentTypes as $type) {

                for ($month = 1; $month <= 12; $month++) {

                    /*
                     Sekitar 20% unpaid
                    */

                    $paid = rand(1, 100) > 20;

                    Payment::create([

                        'house_id' => $house,

                        'payment_type_id' => $type->id,

                        'month' => $month,

                        'year' => $year,

                        'amount' => $type->default_amount,

                        'paid_at' => $paid
                            ? Carbon::create($year, $month, rand(1, 28))
                            : null,

                        'status' => $paid
                            ? 'paid'
                            : 'unpaid',

                        'notes' => $paid
                            ? 'Pembayaran bulanan'
                            : 'Belum dibayar',

                    ]);

                }

            }

        }

        /*
         House 20 kosong
         Tidak memiliki pembayaran
        */
    }
}
