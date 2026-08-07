<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HouseResident;

class HouseResidentSeeder extends Seeder
{
    public function run(): void
    {
        HouseResident::truncate();

        /*
            House 1-19 mempunyai penghuni aktif.
            House 20 kosong.

            Tambahan:
            Dibuat 2 riwayat penghuni agar fitur history terlihat.
        */

        for($i=1;$i<=19;$i++){

            HouseResident::create([

                'house_id'=>$i,

                'resident_id'=>$i,

                'start_date'=>'2026-01-01',

                'end_date'=>null,

                'is_active'=>true,

            ]);

        }

        /*
            History penghuni A-03
        */

        HouseResident::create([

            'house_id'=>3,

            'resident_id'=>16,

            'start_date'=>'2025-01-01',

            'end_date'=>'2025-12-31',

            'is_active'=>false,

        ]);

        /*
            History penghuni B-02
        */

        HouseResident::create([

            'house_id'=>7,

            'resident_id'=>17,

            'start_date'=>'2025-05-01',

            'end_date'=>'2025-11-30',

            'is_active'=>false,

        ]);

    }
}
