<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resident extends Model
{
    protected $fillable = [
        'nik',
        'name',
        'phone',
        'email',
        'birth_date',
        'ktp_photo',
        'resident_status',
        'is_married',
    ];

    public function houses()
    {
        return $this->hasMany(HouseResident::class);
    }

    public function houseResidents()
    {
        return $this->hasMany(HouseResident::class);
    }
}
