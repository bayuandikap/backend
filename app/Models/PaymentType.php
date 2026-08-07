<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentType extends Model
{
    protected $fillable = [
        'name',
        'default_amount',
    ];

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
