<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePaymentRequest;
use App\Http\Requests\UpdatePaymentRequest;
use App\Http\Resources\PaymentResource;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of payments.
     */
    public function index(Request $request)
    {
        $query = Payment::with([
            'house:id,house_number,block',
            'paymentType:id,name',
        ]);

        /*
         * Filters
         */

        $query->when(
            $request->status,
            fn($q, $status) =>
            $q->where('status', $status)
        );

        $query->when(
            $request->month,
            fn($q, $month) =>
            $q->where('month', $month)
        );

        $query->when(
            $request->year,
            fn($q, $year) =>
            $q->where('year', $year)
        );

        $query->when(
            $request->house_id,
            fn($q, $id) =>
            $q->where('house_id', $id)
        );

        /*
         * Clone the filtered query before pagination.
         *
         * This allows us to calculate financial summaries
         * for ALL matching records instead of only the
         * current page.
         */

        $summaryQuery = clone $query;

        $totalPayments = (clone $summaryQuery)->count();

        $paidPayments = (clone $summaryQuery)
            ->where('status', 'paid')
            ->count();

        $unpaidPayments = (clone $summaryQuery)
            ->where('status', 'unpaid')
            ->count();

        $totalPaidAmount = (clone $summaryQuery)
            ->where('status', 'paid')
            ->sum('amount');

        $totalUnpaidAmount = (clone $summaryQuery)
            ->where('status', 'unpaid')
            ->sum('amount');

        /*
         * Paginated payment records
         */

        $payments = $query
            ->latest()
            ->paginate(10);

        return response()->json([
            'data' => PaymentResource::collection($payments)
                ->response()
                ->getData(true)['data'],

            'links' => [
                'first' => $payments->url(1),
                'last' => $payments->url($payments->lastPage()),
                'prev' => $payments->previousPageUrl(),
                'next' => $payments->nextPageUrl(),
            ],

            'meta' => [
                'current_page' => $payments->currentPage(),
                'from' => $payments->firstItem(),
                'last_page' => $payments->lastPage(),
                'per_page' => $payments->perPage(),
                'to' => $payments->lastItem(),
                'total' => $payments->total(),
            ],

            'summary' => [
                'total_payments' => $totalPayments,
                'paid_payments' => $paidPayments,
                'unpaid_payments' => $unpaidPayments,
                'total_paid_amount' => (float) $totalPaidAmount,
                'total_unpaid_amount' => (float) $totalUnpaidAmount,
            ],
        ]);
    }

    /**
     * Store a newly created payment.
     */
    public function store(StorePaymentRequest $request)
    {
        $payment = Payment::create(
            $request->validated()
        );

        return new PaymentResource(
            $payment->load([
                'house',
                'paymentType',
            ])
        );
    }

    /**
     * Display the specified payment.
     */
    public function show(Payment $payment)
    {
        return new PaymentResource(
            $payment->load([
                'house',
                'paymentType',
            ])
        );
    }

    /**
     * Update the specified payment.
     */
    public function update(
        UpdatePaymentRequest $request,
        Payment $payment
    ) {
        $payment->update(
            $request->validated()
        );

        return new PaymentResource(
            $payment->load([
                'house',
                'paymentType',
            ])
        );
    }

    /**
     * Remove the specified payment.
     */
    public function destroy(Payment $payment)
    {
        $payment->delete();

        return response()->noContent();
    }
}
