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

    protected $casts = [
        'month' => 'integer',
        'year' => 'integer',
        'amount' => 'decimal:2',
        'paid_at' => 'date',
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
