<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\House;

class HouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $houses = [];

        foreach (['A', 'B'] as $block) {
            for ($i = 1; $i <= 10; $i++) {
                $houses[] = [
                    'house_number' => sprintf('%s-%02d', $block, $i),
                    'block' => $block,
                    'status' => $i <= 8 ? 'occupied' : 'vacant',
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        House::insert($houses);
    }
}
