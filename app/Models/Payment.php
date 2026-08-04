<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    public function house()
    {
        return $this->belongsTo(House::class);
    }

    public function paymentType()
    {
        return $this->belongsTo(PaymentType::class);
    }
}
