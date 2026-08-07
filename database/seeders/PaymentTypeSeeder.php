<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PaymentType;

class PaymentTypeSeeder extends Seeder
{
    public function run(): void
    {
        //PaymentType::query()->delete();

        PaymentType::create([
            'name' => 'Satpam',
            'default_amount' => 100000,
        ]);

        PaymentType::create([
            'name' => 'Kebersihan',
            'default_amount' => 15000,
        ]);
    }
}
