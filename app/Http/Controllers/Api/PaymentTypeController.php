<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PaymentType;

class PaymentTypeController extends Controller
{
    public function index()
    {
        return PaymentType::orderBy('name')
            ->get([
                'id',
                'name',
                'default_amount',
            ]);
    }
}
