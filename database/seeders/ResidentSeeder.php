<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Resident;

class ResidentSeeder extends Seeder
{
    public function run(): void
    {
        Resident::query()->delete();

        $residents = [

            [
                'nik'=>'3573010000000001',
                'name'=>'Andi Saputra',
                'phone'=>'081234560001',
                'email'=>'andi@example.com',
                'birth_date'=>'1985-01-12',
                'resident_status'=>'permanent',
                'is_married'=>true,
            ],

            [
                'nik'=>'3573010000000002',
                'name'=>'Budi Santoso',
                'phone'=>'081234560002',
                'email'=>'budi@example.com',
                'birth_date'=>'1984-04-11',
                'resident_status'=>'permanent',
                'is_married'=>true,
            ],

            [
                'nik'=>'3573010000000003',
                'name'=>'Citra Lestari',
                'phone'=>'081234560003',
                'email'=>'citra@example.com',
                'birth_date'=>'1992-05-21',
                'resident_status'=>'permanent',
                'is_married'=>false,
            ],

            [
                'nik'=>'3573010000000004',
                'name'=>'Dedi Pratama',
                'phone'=>'081234560004',
                'email'=>'dedi@example.com',
                'birth_date'=>'1988-03-09',
                'resident_status'=>'permanent',
                'is_married'=>true,
            ],

            [
                'nik'=>'3573010000000005',
                'name'=>'Eko Nugroho',
                'phone'=>'081234560005',
                'email'=>'eko@example.com',
                'birth_date'=>'1989-08-18',
                'resident_status'=>'permanent',
                'is_married'=>true,
            ],

            [
                'nik'=>'3573010000000006',
                'name'=>'Farah Putri',
                'phone'=>'081234560006',
                'email'=>'farah@example.com',
                'birth_date'=>'1993-09-11',
                'resident_status'=>'permanent',
                'is_married'=>false,
            ],

            [
                'nik'=>'3573010000000007',
                'name'=>'Gunawan',
                'phone'=>'081234560007',
                'email'=>'gunawan@example.com',
                'birth_date'=>'1980-10-14',
                'resident_status'=>'permanent',
                'is_married'=>true,
            ],

            [
                'nik'=>'3573010000000008',
                'name'=>'Hendra Wijaya',
                'phone'=>'081234560008',
                'email'=>'hendra@example.com',
                'birth_date'=>'1987-07-17',
                'resident_status'=>'permanent',
                'is_married'=>true,
            ],

            [
                'nik'=>'3573010000000009',
                'name'=>'Indra Kurniawan',
                'phone'=>'081234560009',
                'email'=>'indra@example.com',
                'birth_date'=>'1991-02-20',
                'resident_status'=>'permanent',
                'is_married'=>false,
            ],

            [
                'nik'=>'3573010000000010',
                'name'=>'Joko Susilo',
                'phone'=>'081234560010',
                'email'=>'joko@example.com',
                'birth_date'=>'1983-06-10',
                'resident_status'=>'permanent',
                'is_married'=>true,
            ],

            [
                'nik'=>'3573010000000011',
                'name'=>'Kevin Samuel',
                'phone'=>'081234560011',
                'email'=>'kevin@example.com',
                'birth_date'=>'1994-04-19',
                'resident_status'=>'permanent',
                'is_married'=>false,
            ],

            [
                'nik'=>'3573010000000012',
                'name'=>'Lina Marlina',
                'phone'=>'081234560012',
                'email'=>'lina@example.com',
                'birth_date'=>'1992-12-12',
                'resident_status'=>'permanent',
                'is_married'=>true,
            ],

            [
                'nik'=>'3573010000000013',
                'name'=>'Maya Sari',
                'phone'=>'081234560013',
                'email'=>'maya@example.com',
                'birth_date'=>'1990-11-09',
                'resident_status'=>'permanent',
                'is_married'=>true,
            ],

            [
                'nik'=>'3573010000000014',
                'name'=>'Nanda Putra',
                'phone'=>'081234560014',
                'email'=>'nanda@example.com',
                'birth_date'=>'1988-09-03',
                'resident_status'=>'permanent',
                'is_married'=>true,
            ],

            [
                'nik'=>'3573010000000015',
                'name'=>'Rizky Maulana',
                'phone'=>'081234560015',
                'email'=>'rizky@example.com',
                'birth_date'=>'1995-01-15',
                'resident_status'=>'permanent',
                'is_married'=>false,
            ],

            [
                'nik'=>'3573010000000016',
                'name'=>'Agus Salim',
                'phone'=>'081234560016',
                'email'=>'agus@example.com',
                'birth_date'=>'1997-02-02',
                'resident_status'=>'contract',
                'is_married'=>false,
            ],

            [
                'nik'=>'3573010000000017',
                'name'=>'Rina Amelia',
                'phone'=>'081234560017',
                'email'=>'rina@example.com',
                'birth_date'=>'1998-03-15',
                'resident_status'=>'contract',
                'is_married'=>false,
            ],

            [
                'nik'=>'3573010000000018',
                'name'=>'Siti Rahma',
                'phone'=>'081234560018',
                'email'=>'siti@example.com',
                'birth_date'=>'1996-06-08',
                'resident_status'=>'contract',
                'is_married'=>true,
            ],

            [
                'nik'=>'3573010000000019',
                'name'=>'Rudi Hartono',
                'phone'=>'081234560019',
                'email'=>'rudi@example.com',
                'birth_date'=>'1994-05-07',
                'resident_status'=>'contract',
                'is_married'=>true,
            ],

        ];

        foreach ($residents as $resident){

            Resident::create($resident);

        }

    }
}
