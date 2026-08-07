<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PaymentType;

class PaymentTypeSeeder extends Seeder
{
    public function run(): void
    {
        PaymentType::insert([
            [
                'name' => 'Security Fee',
                'default_amount' => 50000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Garbage Collection',
                'default_amount' => 25000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Neighborhood Maintenance',
                'default_amount' => 100000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Community Fund',
                'default_amount' => 30000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Water Contribution',
                'default_amount' => 20000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
