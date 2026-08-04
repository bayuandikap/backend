<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    public function residents()
    {
        return $this->hasMany(HouseResident::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
