<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Resident;

class ResidentSeeder extends Seeder
{
    public function run(): void
    {
        Resident::insert([

            [
                'nik' => '3578010101010001',
                'name' => 'Budi Santoso',
                'phone' => '081234567801',
                'email' => 'budi.santoso@example.com',
                'birth_date' => '1982-03-15',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'nik' => '3578010101010002',
                'name' => 'Siti Santoso',
                'phone' => '081234567802',
                'email' => 'siti.santoso@example.com',
                'birth_date' => '1985-07-20',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'nik' => '3578010101010003',
                'name' => 'Andi Santoso',
                'phone' => '081234567803',
                'email' => 'andi.santoso@example.com',
                'birth_date' => '2012-05-10',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'nik' => '3578010101010004',
                'name' => 'Rudi Hartono',
                'phone' => '081234567804',
                'email' => 'rudi.hartono@example.com',
                'birth_date' => '1980-08-18',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'nik' => '3578010101010005',
                'name' => 'Maya Hartono',
                'phone' => '081234567805',
                'email' => 'maya.hartono@example.com',
                'birth_date' => '1984-11-12',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'nik' => '3578010101010006',
                'name' => 'Doni Hartono',
                'phone' => '081234567806',
                'email' => 'doni.hartono@example.com',
                'birth_date' => '2015-02-14',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'nik' => '3578010101010007',
                'name' => 'Agus Prasetyo',
                'phone' => '081234567807',
                'email' => 'agus.prasetyo@example.com',
                'birth_date' => '1978-09-09',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'nik' => '3578010101010008',
                'name' => 'Linda Prasetyo',
                'phone' => '081234567808',
                'email' => 'linda.prasetyo@example.com',
                'birth_date' => '1981-04-17',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'nik' => '3578010101010009',
                'name' => 'Yoga Saputra',
                'phone' => '081234567809',
                'email' => 'yoga.saputra@example.com',
                'birth_date' => '1995-01-21',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'nik' => '3578010101010010',
                'name' => 'Nina Oktavia',
                'phone' => '081234567810',
                'email' => 'nina.oktavia@example.com',
                'birth_date' => '1997-06-05',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'nik' => '3578010101010011',
                'name' => 'Ahmad Fauzi',
                'phone' => '081234567811',
                'email' => 'ahmad.fauzi@example.com',
                'birth_date' => '1987-10-10',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'nik' => '3578010101010012',
                'name' => 'Rika Amelia',
                'phone' => '081234567812',
                'email' => 'rika.amelia@example.com',
                'birth_date' => '1990-03-01',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'nik' => '3578010101010013',
                'name' => 'Hendra Susilo',
                'phone' => '081234567813',
                'email' => 'hendra.susilo@example.com',
                'birth_date' => '1979-12-20',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'nik' => '3578010101010014',
                'name' => 'Wulan Safitri',
                'phone' => '081234567814',
                'email' => 'wulan.safitri@example.com',
                'birth_date' => '1993-05-11',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'nik' => '3578010101010015',
                'name' => 'Fajar Nugroho',
                'phone' => '081234567815',
                'email' => 'fajar.nugroho@example.com',
                'birth_date' => '1992-09-22',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'nik' => '3578010101010016',
                'name' => 'Putri Maharani',
                'phone' => '081234567816',
                'email' => 'putri.maharani@example.com',
                'birth_date' => '1994-01-19',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Continue the same pattern until resident 32...
        ]);
    }
}
