<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\House;

class HouseSeeder extends Seeder
{
    public function run(): void
    {
        House::query()->delete();

        $houses = [];

        // Block A
        for ($i = 1; $i <= 5; $i++) {

            $houses[] = [
                'house_number' => 'A-' . str_pad($i, 2, '0', STR_PAD_LEFT),
                'block' => 'A',
                'status' => 'occupied',
            ];
        }

        // Block B
        for ($i = 1; $i <= 5; $i++) {

            $houses[] = [
                'house_number' => 'B-' . str_pad($i, 2, '0', STR_PAD_LEFT),
                'block' => 'B',
                'status' => 'occupied',
            ];
        }

        // Block C
        for ($i = 1; $i <= 5; $i++) {

            $houses[] = [
                'house_number' => 'C-' . str_pad($i, 2, '0', STR_PAD_LEFT),
                'block' => 'C',
                'status' => 'occupied',
            ];
        }

        // Block D
        for ($i = 1; $i <= 5; $i++) {

            $houses[] = [
                'house_number' => 'D-' . str_pad($i, 2, '0', STR_PAD_LEFT),
                'block' => 'D',
                'status' => 'occupied',
            ];
        }

        /*
        20 Houses

        15 Permanent
        4 Contract
        1 Vacant

        D-05 dibuat kosong
        */

        $houses[19]['status'] = 'vacant';

        foreach ($houses as $house) {

            House::create($house);

        }
    }
}
