<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HouseResident extends Model
{
    public function house()
    {
        return $this->belongsTo(House::class);
    }

    public function resident()
    {
        return $this->belongsTo(Resident::class);
    }
}
