<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Http\Requests\StorePaymentRequest;
use App\Http\Requests\UpdatePaymentRequest;
use App\Http\Resources\HouseResidentResource;
use App\Http\Resources\PaymentResource;
use App\Models\Payment;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payments = Payment::with([
            'house',
            'paymentType'
        ])
            ->latest()
            ->paginate(10);

        return PaymentResource::collection($payments);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePaymentRequest $request)
    {
        $payment = Payment::create(
            $request->validated()
        );

        return new PaymentResource(
            $payment->load([
                'house',
                'paymentType'
            ])
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        return new PaymentResource(
            $payment->load([
                'house',
                'paymentType'
            ])
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePaymentRequest $request, Payment $payment)
    {
        $payment->update(
            $request->validated()
        );

        return new PaymentResource(
            $payment->load([
                'house',
                'paymentType'
            ])
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        $payment->delete();

        return response()->noContent();
    }
}
