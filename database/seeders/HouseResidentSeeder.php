<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HouseResident;

/**
 * HouseResidentSeeder
 *
 * Maps residents to houses.  Multiple residents per house simulate real
 * family/household units.  Historical (is_active = false) records show
 * previous tenancies.  Periods for the same house never overlap.
 *
 * House ID reference (from HouseSeeder):
 *   1  = A-01   6  = B-01   11 = C-01   16 = D-01 (contract, occupied)
 *   2  = A-02   7  = B-02   12 = C-02   17 = D-02 (contract, occupied)
 *   3  = A-03   8  = B-03   13 = C-03   18 = D-03 (vacant)
 *   4  = A-04   9  = B-04   14 = C-04   19 = D-04 (vacant)
 *   5  = A-05  10  = B-05   15 = C-05   20 = D-05 (vacant)
 *
 * Resident ID reference (from ResidentSeeder):
 *   1–2   A-01  (Hendra + Wulandari)
 *   3     A-02  (Budi, single)
 *   4–5   A-03  (Deden + Siti)
 *   6     A-04  (Agus, single)
 *   7–8   A-05  (Rizal + Dewi)
 *   9     B-01  (Joko, single)
 *   10–11 B-02  (Eko + Yuniati)
 *   12–14 B-03  (Fajar + Nita + Sudirman)
 *   15    B-04  (Ratna, single)
 *   16–17 B-05  (Andri + Lestari)
 *   18    C-01  (Yusuf, single)
 *   19–20 C-02  (Wahyu + Indah)
 *   21–23 C-03  (Bambang + Sulastri + Maryati)
 *   24    C-04  (Iwan, single)
 *   25–26 C-05  (Rudi + Marlina)
 *   27–28 D-01  current contract (Kevin + Putri, from 2026-03-01)
 *   29–30 D-02  current contract (Fandi + Ayu, from 2026-06-01)
 *   31    former D-01  (Dimas,  2025-01-01 – 2025-11-30)
 *   32    former D-02  first  (Lukman, 2025-01-01 – 2025-04-30)
 *   33    former D-02  second (Rizky,  2025-08-01 – 2026-03-31)
 *
 * D-02 history timeline (no overlaps):
 *   2025-01-01 – 2025-04-30  Lukman          (vacated Apr 2025)
 *   2025-05-01 – 2025-07-31  [vacant period] (no record)
 *   2025-08-01 – 2026-03-31  Rizky           (moved out Mar 2026)
 *   2026-06-01 – present     Fandi + Ayu     (current)
 *   Apr–May 2026             [vacant period] (no record)
 */
class HouseResidentSeeder extends Seeder
{
    public function run(): void
    {
        HouseResident::truncate();

        // ─────────────────────────────────────────────────────────────────────
        // BLOCK A — permanently occupied, all active from 2026-01-01
        // ─────────────────────────────────────────────────────────────────────

        // A-01 : Hendra Kusuma (ID 1) + Wulandari Kusuma (ID 2)
        $this->assign(1, 1, '2026-01-01');
        $this->assign(1, 2, '2026-01-01');

        // A-02 : Budi Santoso (ID 3) — single
        $this->assign(2, 3, '2026-01-01');

        // A-03 : Deden Firmansyah (ID 4) + Siti Aminah (ID 5)
        $this->assign(3, 4, '2026-01-01');
        $this->assign(3, 5, '2026-01-01');

        // A-04 : Agus Setiawan (ID 6) — single
        $this->assign(4, 6, '2026-01-01');

        // A-05 : Rizal Hakim (ID 7) + Dewi Rahayu (ID 8)
        $this->assign(5, 7, '2026-01-01');
        $this->assign(5, 8, '2026-01-01');

        // ─────────────────────────────────────────────────────────────────────
        // BLOCK B — permanently occupied, all active from 2026-01-01
        // ─────────────────────────────────────────────────────────────────────

        // B-01 : Joko Prabowo (ID 9) — single
        $this->assign(6, 9, '2026-01-01');

        // B-02 : Eko Prasetyo (ID 10) + Yuniati Prasetyo (ID 11)
        $this->assign(7, 10, '2026-01-01');
        $this->assign(7, 11, '2026-01-01');

        // B-03 : Fajar Nugroho (ID 12) + Nita Permata (ID 13) + Sudirman (ID 14)
        $this->assign(8, 12, '2026-01-01');
        $this->assign(8, 13, '2026-01-01');
        $this->assign(8, 14, '2026-01-01');

        // B-04 : Ratna Dewi (ID 15) — single
        $this->assign(9, 15, '2026-01-01');

        // B-05 : Andri Wijaya (ID 16) + Lestari Wijaya (ID 17)
        $this->assign(10, 16, '2026-01-01');
        $this->assign(10, 17, '2026-01-01');

        // ─────────────────────────────────────────────────────────────────────
        // BLOCK C — permanently occupied, all active from 2026-01-01
        // ─────────────────────────────────────────────────────────────────────

        // C-01 : Yusuf Hidayat (ID 18) — single
        $this->assign(11, 18, '2026-01-01');

        // C-02 : Wahyu Santosa (ID 19) + Indah Pertiwi (ID 20)
        $this->assign(12, 19, '2026-01-01');
        $this->assign(12, 20, '2026-01-01');

        // C-03 : Bambang (ID 21) + Sulastri (ID 22) + Maryati (ID 23)
        $this->assign(13, 21, '2026-01-01');
        $this->assign(13, 22, '2026-01-01');
        $this->assign(13, 23, '2026-01-01');

        // C-04 : Iwan Susanto (ID 24) — single
        $this->assign(14, 24, '2026-01-01');

        // C-05 : Rudi Hartanto (ID 25) + Marlina Sari (ID 26)
        $this->assign(15, 25, '2026-01-01');
        $this->assign(15, 26, '2026-01-01');

        // ─────────────────────────────────────────────────────────────────────
        // BLOCK D — contract/temporary, with full historical timeline
        // ─────────────────────────────────────────────────────────────────────

        // D-01 (house 16)
        // ┌─────────────────────────────────────────────────────────────────┐
        // │  2025-01-01 – 2025-11-30  Dimas Pradipta (ID 31)  — vacated    │
        // │  2025-12-01 – 2026-02-28  [vacant period]                       │
        // │  2026-03-01 – present     Kevin Ardiansyah (ID 27)             │
        // │                           + Putri Handayani (ID 28)            │
        // └─────────────────────────────────────────────────────────────────┘
        $this->assignHistory(16, 31, '2025-01-01', '2025-11-30');
        $this->assign(16, 27, '2026-03-01');
        $this->assign(16, 28, '2026-03-01');

        // D-02 (house 17)
        // ┌─────────────────────────────────────────────────────────────────┐
        // │  2025-01-01 – 2025-04-30  Lukman Hakim (ID 32)   — vacated     │
        // │  2025-05-01 – 2025-07-31  [vacant period]                       │
        // │  2025-08-01 – 2026-03-31  Rizky Firmansyah (ID 33) — vacated   │
        // │  2026-04-01 – 2026-05-31  [vacant period]                       │
        // │  2026-06-01 – present     Fandi Akhmad (ID 29)                  │
        // │                           + Ayu Laksmi (ID 30)                  │
        // └─────────────────────────────────────────────────────────────────┘
        $this->assignHistory(17, 32, '2025-01-01', '2025-04-30');
        $this->assignHistory(17, 33, '2025-08-01', '2026-03-31');
        $this->assign(17, 29, '2026-06-01');
        $this->assign(17, 30, '2026-06-01');

        // D-03, D-04, D-05 remain vacant — no house_resident records needed.
    }

    // ─────────────────────────────────────────────────────────────────────────
    // Helpers
    // ─────────────────────────────────────────────────────────────────────────

    /** Create an active (current) occupancy record with no end_date. */
    private function assign(int $houseId, int $residentId, string $startDate): void
    {
        HouseResident::create([
            'house_id'    => $houseId,
            'resident_id' => $residentId,
            'start_date'  => $startDate,
            'end_date'    => null,
            'is_active'   => true,
        ]);
    }

    /** Create a closed (historical) occupancy record. */
    private function assignHistory(
        int $houseId,
        int $residentId,
        string $startDate,
        string $endDate
    ): void {
        HouseResident::create([
            'house_id'    => $houseId,
            'resident_id' => $residentId,
            'start_date'  => $startDate,
            'end_date'    => $endDate,
            'is_active'   => false,
        ]);
    }
}
