<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PaymentType;

/**
 * PaymentTypeSeeder
 *
 * Ensures exactly two payment types exist:
 *   1. Satpam    — Rp 100,000 / month  (security fee)
 *   2. Kebersihan — Rp 15,000  / month  (cleaning fee)
 *
 * Uses updateOrCreate so re-running is safe and IDs stay stable.
 * The seeder also deletes any stale extra payment types to keep
 * the table clean across repeated runs.
 */
class PaymentTypeSeeder extends Seeder
{
    public function run(): void
    {
        // Wipe and recreate so IDs are always 1 and 2 — PaymentSeeder relies
        // on querying PaymentType::all() but we keep order deterministic.
        PaymentType::query()->delete();

        PaymentType::create([
            'name'           => 'Satpam',
            'default_amount' => 100000,
        ]);

        PaymentType::create([
            'name'           => 'Kebersihan',
            'default_amount' => 15000,
        ]);
    }
}
