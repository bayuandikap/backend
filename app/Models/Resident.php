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

    protected $casts = [
        'birth_date' => 'date',
        'is_married' => 'boolean',
    ];

    public function houseResidents()
    {
        return $this->hasMany(HouseResident::class);
    }
}
