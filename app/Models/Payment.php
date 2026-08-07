<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{

    protected $fillable = [
        'house_id',
        'payment_type_id',
        'month',
        'year',
        'amount',
        'paid_at',
        'status',
        'notes',
    ];
    public function house()
    {
        return $this->belongsTo(House::class);
    }

    public function paymentType()
    {
        return $this->belongsTo(PaymentType::class);
    }
}
