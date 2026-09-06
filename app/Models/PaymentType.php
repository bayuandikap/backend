<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentType extends Model
{
    protected $fillable = [
        'name',
        'default_amount',
    ];

    protected $casts = [
        'default_amount' => 'decimal:2',
    ];

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
