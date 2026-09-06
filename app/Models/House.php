<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    protected $fillable = [
        'house_number',
        'block',
        'status',
    ];

    public function houseResidents()
    {
        return $this->hasMany(HouseResident::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
