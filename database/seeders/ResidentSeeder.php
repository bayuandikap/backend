<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Resident;

/**
 * ResidentSeeder
 *
 * Creates 33 Indonesian residents with realistic names, NIK, phone numbers,
 * marital status, and resident_status (permanent / contract).
 *
 * Distribution:
 *   IDs  1–24 : permanent residents  (occupy Block A, B, C houses)
 *   IDs 25–29 : permanent residents  (occupy Block D-01 and D-02 as current tenants
 *                                      or previous tenants — see HouseResidentSeeder)
 *   IDs 30–33 : contract residents   (current occupants of D-01 and D-02,
 *                                      plus two former contract tenants for history)
 *
 * NIK format  : 16-digit, prefix 3578 (Surabaya city code) + DOB encoded +
 *               sequential suffix — purely fictional, for demo only.
 *
 * KTP photo   : placeholder path only, no real document stored.
 *
 * Safe to re-run: deletes all residents first (FK checks disabled by
 * DatabaseSeeder).
 */
class ResidentSeeder extends Seeder
{
    public function run(): void
    {
        Resident::query()->delete();

        // ────────────────────────────────────────────────────────────────────
        // Helper: build a fictional NIK
        //   Province 35 (Jawa Timur) · City 78 (Surabaya)
        //   Kecamatan 01 · DOB encoded (women: day+40)
        // ────────────────────────────────────────────────────────────────────
        $nik = fn (int $seq, string $dob, bool $female = false): string => sprintf(
            '3578010%s%04d',
            // DOB as DDMMYY — women add 40 to day
            sprintf(
                '%02d%02d%02d',
                (int) substr($dob, 8, 2) + ($female ? 40 : 0),
                (int) substr($dob, 5, 2),
                (int) substr($dob, 2, 2),
            ),
            $seq,
        );

        $residents = [

            // ── Block A residents (IDs 1–13) ────────────────────────────────
            // A-01 : Pak Hendra (KK) + Bu Wulandari (istri) + 2 anak (tidak didaftarkan sebagai warga)
            [
                'nik'             => $nik(1,  '1982-04-15'),
                'name'            => 'Hendra Kusuma',
                'phone'           => '08121100001',
                'email'           => 'hendra.kusuma@example.com',
                'birth_date'      => '1982-04-15',
                'resident_status' => 'permanent',
                'is_married'      => true,
                'ktp_photo'       => 'ktp/placeholder_ktp_001.jpg',
            ],
            [
                'nik'             => $nik(2,  '1985-07-22', true),
                'name'            => 'Wulandari Kusuma',
                'phone'           => '08121100002',
                'email'           => 'wulandari.k@example.com',
                'birth_date'      => '1985-07-22',
                'resident_status' => 'permanent',
                'is_married'      => true,
                'ktp_photo'       => 'ktp/placeholder_ktp_002.jpg',
            ],

            // A-02 : Pak Budi (single, lajang)
            [
                'nik'             => $nik(3,  '1990-11-03'),
                'name'            => 'Budi Santoso',
                'phone'           => '08121100003',
                'email'           => 'budi.santoso@example.com',
                'birth_date'      => '1990-11-03',
                'resident_status' => 'permanent',
                'is_married'      => false,
                'ktp_photo'       => 'ktp/placeholder_ktp_003.jpg',
            ],

            // A-03 : Pak Deden + Bu Siti
            [
                'nik'             => $nik(4,  '1978-02-28'),
                'name'            => 'Deden Firmansyah',
                'phone'           => '08121100004',
                'email'           => 'deden.f@example.com',
                'birth_date'      => '1978-02-28',
                'resident_status' => 'permanent',
                'is_married'      => true,
                'ktp_photo'       => 'ktp/placeholder_ktp_004.jpg',
            ],
            [
                'nik'             => $nik(5,  '1981-09-14', true),
                'name'            => 'Siti Aminah',
                'phone'           => '08121100005',
                'email'           => 'siti.aminah@example.com',
                'birth_date'      => '1981-09-14',
                'resident_status' => 'permanent',
                'is_married'      => true,
                'ktp_photo'       => 'ktp/placeholder_ktp_005.jpg',
            ],

            // A-04 : Pak Agus (single)
            [
                'nik'             => $nik(6,  '1994-06-19'),
                'name'            => 'Agus Setiawan',
                'phone'           => '08121100006',
                'email'           => 'agus.setiawan@example.com',
                'birth_date'      => '1994-06-19',
                'resident_status' => 'permanent',
                'is_married'      => false,
                'ktp_photo'       => 'ktp/placeholder_ktp_006.jpg',
            ],

            // A-05 : Pak Rizal + Bu Dewi
            [
                'nik'             => $nik(7,  '1980-01-07'),
                'name'            => 'Rizal Hakim',
                'phone'           => '08121100007',
                'email'           => 'rizal.hakim@example.com',
                'birth_date'      => '1980-01-07',
                'resident_status' => 'permanent',
                'is_married'      => true,
                'ktp_photo'       => 'ktp/placeholder_ktp_007.jpg',
            ],
            [
                'nik'             => $nik(8,  '1983-05-30', true),
                'name'            => 'Dewi Rahayu',
                'phone'           => '08121100008',
                'email'           => 'dewi.rahayu@example.com',
                'birth_date'      => '1983-05-30',
                'resident_status' => 'permanent',
                'is_married'      => true,
                'ktp_photo'       => 'ktp/placeholder_ktp_008.jpg',
            ],

            // ── Block B residents (IDs 9–19) ────────────────────────────────
            // B-01 : Pak Joko (single)
            [
                'nik'             => $nik(9,  '1988-12-25'),
                'name'            => 'Joko Prabowo',
                'phone'           => '08121100009',
                'email'           => 'joko.prabowo@example.com',
                'birth_date'      => '1988-12-25',
                'resident_status' => 'permanent',
                'is_married'      => false,
                'ktp_photo'       => 'ktp/placeholder_ktp_009.jpg',
            ],

            // B-02 : Pak Eko + Bu Yuni
            [
                'nik'             => $nik(10, '1975-08-10'),
                'name'            => 'Eko Prasetyo',
                'phone'           => '08121100010',
                'email'           => 'eko.prasetyo@example.com',
                'birth_date'      => '1975-08-10',
                'resident_status' => 'permanent',
                'is_married'      => true,
                'ktp_photo'       => 'ktp/placeholder_ktp_010.jpg',
            ],
            [
                'nik'             => $nik(11, '1978-03-17', true),
                'name'            => 'Yuniati Prasetyo',
                'phone'           => '08121100011',
                'email'           => 'yuniati.p@example.com',
                'birth_date'      => '1978-03-17',
                'resident_status' => 'permanent',
                'is_married'      => true,
                'ktp_photo'       => 'ktp/placeholder_ktp_011.jpg',
            ],

            // B-03 : Pak Fajar + Bu Nita + kakek (3 penghuni)
            [
                'nik'             => $nik(12, '1986-10-08'),
                'name'            => 'Fajar Nugroho',
                'phone'           => '08121100012',
                'email'           => 'fajar.nugroho@example.com',
                'birth_date'      => '1986-10-08',
                'resident_status' => 'permanent',
                'is_married'      => true,
                'ktp_photo'       => 'ktp/placeholder_ktp_012.jpg',
            ],
            [
                'nik'             => $nik(13, '1989-04-21', true),
                'name'            => 'Nita Permata',
                'phone'           => '08121100013',
                'email'           => 'nita.permata@example.com',
                'birth_date'      => '1989-04-21',
                'resident_status' => 'permanent',
                'is_married'      => true,
                'ktp_photo'       => 'ktp/placeholder_ktp_013.jpg',
            ],
            [
                'nik'             => $nik(14, '1952-06-05'),
                'name'            => 'Sudirman',
                'phone'           => '08121100014',
                'email'           => null,
                'birth_date'      => '1952-06-05',
                'resident_status' => 'permanent',
                'is_married'      => true,
                'ktp_photo'       => 'ktp/placeholder_ktp_014.jpg',
            ],

            // B-04 : Bu Ratna (single, janda)
            [
                'nik'             => $nik(15, '1971-11-27', true),
                'name'            => 'Ratna Dewi',
                'phone'           => '08121100015',
                'email'           => 'ratna.dewi@example.com',
                'birth_date'      => '1971-11-27',
                'resident_status' => 'permanent',
                'is_married'      => false,
                'ktp_photo'       => 'ktp/placeholder_ktp_015.jpg',
            ],

            // B-05 : Pak Andri + Bu Lestari
            [
                'nik'             => $nik(16, '1984-07-14'),
                'name'            => 'Andri Wijaya',
                'phone'           => '08121100016',
                'email'           => 'andri.wijaya@example.com',
                'birth_date'      => '1984-07-14',
                'resident_status' => 'permanent',
                'is_married'      => true,
                'ktp_photo'       => 'ktp/placeholder_ktp_016.jpg',
            ],
            [
                'nik'             => $nik(17, '1987-02-09', true),
                'name'            => 'Lestari Wijaya',
                'phone'           => '08121100017',
                'email'           => 'lestari.wijaya@example.com',
                'birth_date'      => '1987-02-09',
                'resident_status' => 'permanent',
                'is_married'      => true,
                'ktp_photo'       => 'ktp/placeholder_ktp_017.jpg',
            ],

            // ── Block C residents (IDs 18–27) ───────────────────────────────
            // C-01 : Pak Yusuf (single)
            [
                'nik'             => $nik(18, '1993-03-31'),
                'name'            => 'Yusuf Hidayat',
                'phone'           => '08121100018',
                'email'           => 'yusuf.hidayat@example.com',
                'birth_date'      => '1993-03-31',
                'resident_status' => 'permanent',
                'is_married'      => false,
                'ktp_photo'       => 'ktp/placeholder_ktp_018.jpg',
            ],

            // C-02 : Pak Wahyu + Bu Indah
            [
                'nik'             => $nik(19, '1979-09-20'),
                'name'            => 'Wahyu Santosa',
                'phone'           => '08121100019',
                'email'           => 'wahyu.santosa@example.com',
                'birth_date'      => '1979-09-20',
                'resident_status' => 'permanent',
                'is_married'      => true,
                'ktp_photo'       => 'ktp/placeholder_ktp_019.jpg',
            ],
            [
                'nik'             => $nik(20, '1982-12-11', true),
                'name'            => 'Indah Pertiwi',
                'phone'           => '08121100020',
                'email'           => 'indah.pertiwi@example.com',
                'birth_date'      => '1982-12-11',
                'resident_status' => 'permanent',
                'is_married'      => true,
                'ktp_photo'       => 'ktp/placeholder_ktp_020.jpg',
            ],

            // C-03 : Pak Bambang + Bu Sulastri + nenek
            [
                'nik'             => $nik(21, '1970-05-02'),
                'name'            => 'Bambang Supriyanto',
                'phone'           => '08121100021',
                'email'           => 'bambang.sp@example.com',
                'birth_date'      => '1970-05-02',
                'resident_status' => 'permanent',
                'is_married'      => true,
                'ktp_photo'       => 'ktp/placeholder_ktp_021.jpg',
            ],
            [
                'nik'             => $nik(22, '1973-08-18', true),
                'name'            => 'Sulastri',
                'phone'           => '08121100022',
                'email'           => null,
                'birth_date'      => '1973-08-18',
                'resident_status' => 'permanent',
                'is_married'      => true,
                'ktp_photo'       => 'ktp/placeholder_ktp_022.jpg',
            ],
            [
                'nik'             => $nik(23, '1948-01-15', true),
                'name'            => 'Maryati',
                'phone'           => null,
                'email'           => null,
                'birth_date'      => '1948-01-15',
                'resident_status' => 'permanent',
                'is_married'      => false,
                'ktp_photo'       => 'ktp/placeholder_ktp_023.jpg',
            ],

            // C-04 : Pak Iwan (single)
            [
                'nik'             => $nik(24, '1991-07-07'),
                'name'            => 'Iwan Susanto',
                'phone'           => '08121100024',
                'email'           => 'iwan.susanto@example.com',
                'birth_date'      => '1991-07-07',
                'resident_status' => 'permanent',
                'is_married'      => false,
                'ktp_photo'       => 'ktp/placeholder_ktp_024.jpg',
            ],

            // C-05 : Pak Rudi + Bu Marlina
            [
                'nik'             => $nik(25, '1977-10-24'),
                'name'            => 'Rudi Hartanto',
                'phone'           => '08121100025',
                'email'           => 'rudi.hartanto@example.com',
                'birth_date'      => '1977-10-24',
                'resident_status' => 'permanent',
                'is_married'      => true,
                'ktp_photo'       => 'ktp/placeholder_ktp_025.jpg',
            ],
            [
                'nik'             => $nik(26, '1980-06-16', true),
                'name'            => 'Marlina Sari',
                'phone'           => '08121100026',
                'email'           => 'marlina.sari@example.com',
                'birth_date'      => '1980-06-16',
                'resident_status' => 'permanent',
                'is_married'      => true,
                'ktp_photo'       => 'ktp/placeholder_ktp_026.jpg',
            ],

            // ── Block D — current contract occupants (IDs 27–30) ────────────
            // D-01 (house 16): Pak Kevin (current contract tenant, arrived Mar 2026)
            [
                'nik'             => $nik(27, '1996-04-13'),
                'name'            => 'Kevin Ardiansyah',
                'phone'           => '08121100027',
                'email'           => 'kevin.ardi@example.com',
                'birth_date'      => '1996-04-13',
                'resident_status' => 'contract',
                'is_married'      => false,
                'ktp_photo'       => 'ktp/placeholder_ktp_027.jpg',
            ],
            [
                'nik'             => $nik(28, '1998-08-05', true),
                'name'            => 'Putri Handayani',
                'phone'           => '08121100028',
                'email'           => 'putri.hd@example.com',
                'birth_date'      => '1998-08-05',
                'resident_status' => 'contract',
                'is_married'      => false,
                'ktp_photo'       => 'ktp/placeholder_ktp_028.jpg',
            ],

            // D-02 (house 17): Pak Fandi + Bu Ayu (current contract, arrived Jun 2026)
            [
                'nik'             => $nik(29, '1992-02-19'),
                'name'            => 'Fandi Akhmad',
                'phone'           => '08121100029',
                'email'           => 'fandi.akhmad@example.com',
                'birth_date'      => '1992-02-19',
                'resident_status' => 'contract',
                'is_married'      => true,
                'ktp_photo'       => 'ktp/placeholder_ktp_029.jpg',
            ],
            [
                'nik'             => $nik(30, '1994-11-30', true),
                'name'            => 'Ayu Laksmi',
                'phone'           => '08121100030',
                'email'           => 'ayu.laksmi@example.com',
                'birth_date'      => '1994-11-30',
                'resident_status' => 'contract',
                'is_married'      => true,
                'ktp_photo'       => 'ktp/placeholder_ktp_030.jpg',
            ],

            // ── Historical contract tenants (IDs 31–33) ──────────────────────
            // These residents previously lived in D-01 and D-02 — no longer active.

            // Former D-01 occupant (Jan 2025 – Nov 2025)
            [
                'nik'             => $nik(31, '1997-09-09'),
                'name'            => 'Dimas Pradipta',
                'phone'           => '08121100031',
                'email'           => 'dimas.pd@example.com',
                'birth_date'      => '1997-09-09',
                'resident_status' => 'contract',
                'is_married'      => false,
                'ktp_photo'       => 'ktp/placeholder_ktp_031.jpg',
            ],

            // Former D-02 occupant 1 (Jan 2025 – Apr 2025)
            [
                'nik'             => $nik(32, '1989-05-22'),
                'name'            => 'Lukman Hakim',
                'phone'           => '08121100032',
                'email'           => 'lukman.h@example.com',
                'birth_date'      => '1989-05-22',
                'resident_status' => 'contract',
                'is_married'      => false,
                'ktp_photo'       => 'ktp/placeholder_ktp_032.jpg',
            ],

            // Former D-02 occupant 2 (Aug 2025 – Mar 2026, vacated before Fandi)
            [
                'nik'             => $nik(33, '1995-03-11'),
                'name'            => 'Rizky Firmansyah',
                'phone'           => '08121100033',
                'email'           => 'rizky.f@example.com',
                'birth_date'      => '1995-03-11',
                'resident_status' => 'contract',
                'is_married'      => false,
                'ktp_photo'       => 'ktp/placeholder_ktp_033.jpg',
            ],
        ];

        foreach ($residents as $resident) {
            Resident::create($resident);
        }
    }
}
