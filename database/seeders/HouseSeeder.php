<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\House;

/**
 * HouseSeeder
 *
 * Creates 20 houses across 4 blocks (A–D, 5 houses each).
 *
 * Status distribution:
 *   - 15 permanently occupied  : A-01..A-05, B-01..B-05, C-01..C-05
 *   - 2 contract/temp occupied : D-01, D-02
 *   - 3 vacant                 : D-03, D-04, D-05
 *
 * Houses are deleted and recreated on every run (FK checks disabled by
 * DatabaseSeeder before calling this).
 */
class HouseSeeder extends Seeder
{
    public function run(): void
    {
        House::query()->delete();

        $houses = [];

        // ── Block A  (A-01 … A-05)  — all permanently occupied ──────────────
        for ($i = 1; $i <= 5; $i++) {
            $houses[] = [
                'house_number' => 'A-' . str_pad($i, 2, '0', STR_PAD_LEFT),
                'block'        => 'A',
                'status'       => 'occupied',
            ];
        }

        // ── Block B  (B-01 … B-05)  — all permanently occupied ──────────────
        for ($i = 1; $i <= 5; $i++) {
            $houses[] = [
                'house_number' => 'B-' . str_pad($i, 2, '0', STR_PAD_LEFT),
                'block'        => 'B',
                'status'       => 'occupied',
            ];
        }

        // ── Block C  (C-01 … C-05)  — all permanently occupied ──────────────
        for ($i = 1; $i <= 5; $i++) {
            $houses[] = [
                'house_number' => 'C-' . str_pad($i, 2, '0', STR_PAD_LEFT),
                'block'        => 'C',
                'status'       => 'occupied',
            ];
        }

        // ── Block D  (D-01 … D-05) ──────────────────────────────────────────
        //   D-01 : contract/temporary occupied
        //   D-02 : contract/temporary occupied  (has historical occupancy)
        //   D-03 : vacant
        //   D-04 : vacant
        //   D-05 : vacant
        for ($i = 1; $i <= 5; $i++) {
            $status = match (true) {
                $i <= 2 => 'occupied',   // D-01, D-02 — contract occupants
                default => 'vacant',     // D-03, D-04, D-05
            };

            $houses[] = [
                'house_number' => 'D-' . str_pad($i, 2, '0', STR_PAD_LEFT),
                'block'        => 'D',
                'status'       => $status,
            ];
        }

        foreach ($houses as $house) {
            House::create($house);
        }
    }
}
