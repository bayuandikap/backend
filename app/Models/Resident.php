<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resident extends Model
{
    public function houses()
    {
        return $this->hasMany(HouseResident::class);
    }

    public function houseResidents()
    {
        return $this->hasMany(HouseResident::class);
    }
}
