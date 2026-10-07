<?php

namespace Database\Seeders;

use App\Models\Payment;
use App\Models\PaymentType;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

/**
 * PaymentSeeder
 *
 * Generates 12 months of payment history (January–December 2026) for all
 * occupied houses, respecting the following rules:
 *
 * OCCUPIED HOUSES
 * ───────────────
 * Houses 1–15 (Block A, B, C — permanent residents):
 *   • Both Satpam and Kebersihan payments generated for every month.
 *   • ~87% paid, ~13% unpaid (deterministic pattern, not random).
 *   • Houses 2, 7, 12 pay Kebersihan for the full year in one lump sum
 *     (Rp 180,000 = 12 × Rp 15,000) recorded in month 1, paid in January.
 *     Months 2–12 for Kebersihan are skipped for those houses.
 *
 * CONTRACT HOUSES (D-01 = house 16, D-02 = house 17):
 *   D-01 occupied from 2026-03-01 → payments from month 3 onward.
 *   D-02 occupied from 2026-06-01 → payments from month 6 onward.
 *   No payments generated for months when the house was vacant.
 *
 * VACANT HOUSES (18, 19, 20 — D-03, D-04, D-05):
 *   No payments generated.
 *
 * PAYMENT YEAR
 * ────────────
 * Fixed at 2026 (matches the occupancy start dates in HouseResidentSeeder).
 *
 * UNPAID PATTERN
 * ──────────────
 * Deterministic: a house × month combination is unpaid when
 *   (house_id + month) % 8 === 0
 * This yields roughly 12–13% unpaid across the dataset, spread across
 * different houses and months so the dashboard shows a realistic picture.
 * Additionally, houses 5, 10, and 15 are given one extra unpaid Satpam
 * month each for variety.
 *
 * PAID_AT DATE
 * ────────────
 * Paid records use a deterministic day: (house_id * 3 + month) % 20 + 1
 * so dates look varied but are repeatable.
 */
class PaymentSeeder extends Seeder
{
    private const YEAR = 2026;

    /**
     * Houses that pay Kebersihan annually (lump-sum in January).
     * Amount = 12 × default_amount = Rp 180,000.
     */
    private const ANNUAL_KEBERSIHAN_HOUSES = [2, 7, 12];

    /**
     * Extra forced-unpaid entries: [house_id => [month, ...]]
     * These are in addition to the formula-based unpaid months.
     */
    private const EXTRA_UNPAID = [
        5  => [4],
        10 => [7],
        15 => [10],
    ];

    public function run(): void
    {
        Payment::query()->delete();

        $satpam     = PaymentType::where('name', 'Satpam')->firstOrFail();
        $kebersihan = PaymentType::where('name', 'Kebersihan')->firstOrFail();

        // ── Block A, B, C — permanent houses (IDs 1–15) ─────────────────────
        for ($houseId = 1; $houseId <= 15; $houseId++) {
            $this->seedPermanentHouse($houseId, $satpam, $kebersihan);
        }

        // ── D-01 (house 16) — contract, occupied from March 2026 ─────────────
        $this->seedContractHouse(16, 3, 12, $satpam, $kebersihan);

        // ── D-02 (house 17) — contract, occupied from June 2026 ──────────────
        $this->seedContractHouse(17, 6, 12, $satpam, $kebersihan);

        // Houses 18, 19, 20 (D-03..D-05) — vacant, no payments.
    }

    // ─────────────────────────────────────────────────────────────────────────
    // Permanent house — 12 months, both payment types
    // ─────────────────────────────────────────────────────────────────────────
    private function seedPermanentHouse(
        int $houseId,
        PaymentType $satpam,
        PaymentType $kebersihan,
    ): void {
        $annualKebersihan = in_array($houseId, self::ANNUAL_KEBERSIHAN_HOUSES);

        for ($month = 1; $month <= 12; $month++) {

            // ── Satpam ───────────────────────────────────────────────────────
            $satpamPaid = $this->isPaid($houseId, $month, $satpam->id);
            $this->createPayment(
                houseId:       $houseId,
                paymentTypeId: $satpam->id,
                month:         $month,
                amount:        $satpam->default_amount,
                paid:          $satpamPaid,
                note:          'Iuran keamanan bulanan',
            );

            // ── Kebersihan ───────────────────────────────────────────────────
            if ($annualKebersihan) {
                // Lump-sum in January only
                if ($month === 1) {
                    $annualAmount = $kebersihan->default_amount * 12; // 180,000
                    $this->createPayment(
                        houseId:       $houseId,
                        paymentTypeId: $kebersihan->id,
                        month:         1,
                        amount:        $annualAmount,
                        paid:          true,
                        paidDay:       5,
                        note:          'Iuran kebersihan tahunan (Jan–Des)',
                    );
                }
                // Months 2–12 skipped — no record created
            } else {
                $kebPaid = $this->isPaid($houseId, $month, $kebersihan->id);
                $this->createPayment(
                    houseId:       $houseId,
                    paymentTypeId: $kebersihan->id,
                    month:         $month,
                    amount:        $kebersihan->default_amount,
                    paid:          $kebPaid,
                    note:          'Iuran kebersihan bulanan',
                );
            }
        }
    }

    // ─────────────────────────────────────────────────────────────────────────
    // Contract house — payments only for occupied months
    // ─────────────────────────────────────────────────────────────────────────
    private function seedContractHouse(
        int $houseId,
        int $startMonth,
        int $endMonth,
        PaymentType $satpam,
        PaymentType $kebersihan,
    ): void {
        for ($month = $startMonth; $month <= $endMonth; $month++) {

            $satpamPaid = $this->isPaid($houseId, $month, $satpam->id);
            $this->createPayment(
                houseId:       $houseId,
                paymentTypeId: $satpam->id,
                month:         $month,
                amount:        $satpam->default_amount,
                paid:          $satpamPaid,
                note:          'Iuran keamanan bulanan',
            );

            $kebPaid = $this->isPaid($houseId, $month, $kebersihan->id);
            $this->createPayment(
                houseId:       $houseId,
                paymentTypeId: $kebersihan->id,
                month:         $month,
                amount:        $kebersihan->default_amount,
                paid:          $kebPaid,
                note:          'Iuran kebersihan bulanan',
            );
        }
    }

    // ─────────────────────────────────────────────────────────────────────────
    // Determine paid/unpaid deterministically
    // ─────────────────────────────────────────────────────────────────────────
    private function isPaid(int $houseId, int $month, int $typeId): bool
    {
        // Formula-based unpaid: ~12.5% of records
        if (($houseId + $month + $typeId) % 8 === 0) {
            return false;
        }

        // Extra forced-unpaid entries for variety
        $extra = self::EXTRA_UNPAID[$houseId] ?? [];
        if (in_array($month, $extra)) {
            return false;
        }

        return true;
    }

    // ─────────────────────────────────────────────────────────────────────────
    // Create a single payment record
    // ─────────────────────────────────────────────────────────────────────────
    private function createPayment(
        int    $houseId,
        int    $paymentTypeId,
        int    $month,
        float  $amount,
        bool   $paid,
        ?int   $paidDay = null,
        string $note = '',
    ): void {
        // Deterministic paid-on day so dates look varied but are repeatable
        $day = $paidDay ?? (($houseId * 3 + $month) % 20 + 1);

        Payment::create([
            'house_id'        => $houseId,
            'payment_type_id' => $paymentTypeId,
            'month'           => $month,
            'year'            => self::YEAR,
            'amount'          => $amount,
            'paid_at'         => $paid
                ? Carbon::create(self::YEAR, $month, $day)->toDateString()
                : null,
            'status'          => $paid ? 'paid' : 'unpaid',
            'notes'           => $paid ? $note : 'Belum dibayar',
        ]);
    }
}
