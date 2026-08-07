<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function monthlyFinancial(Request $request)
    {
        $year = $request->input('year', now()->year);

        $selectedMonth = $request->input('month', now()->month);

        $months = [];

        for ($month = 1; $month <= 12; $month++) {

            $income = Payment::where('status', 'paid')
                ->where('year', $year)
                ->where('month', $month)
                ->sum('amount');

            $expense = Expense::whereYear('expense_date', $year)
                ->whereMonth('expense_date', $month)
                ->sum('amount');

            $months[] = [

                'month' => $month,

                'month_name' => Carbon::create()
                    ->month($month)
                    ->format('F'),

                'income' => (float) $income,

                'expense' => (float) $expense,

                'balance' => (float) ($income - $expense),

            ];
        }

        $totalIncome = collect($months)->sum('income');

        $totalExpense = collect($months)->sum('expense');

        $paymentDetails = Payment::with([
            'house',
            'paymentType'
        ])
            ->where('year', $year)
            ->where('month', $selectedMonth)
            ->orderBy('house_id')
            ->get()
            ->map(function ($payment) {

                return [

                    'id' => $payment->id,

                    'house' => $payment->house?->house_number,

                    'block' => $payment->house?->block,

                    'payment_type' => $payment->paymentType?->name,

                    'amount' => $payment->amount,

                    'status' => $payment->status,

                    'paid_at' => $payment->paid_at,

                    'notes' => $payment->notes,

                ];
            });

        $expenseDetails = Expense::whereYear(
            'expense_date',
            $year
        )
            ->whereMonth(
                'expense_date',
                $selectedMonth
            )
            ->orderBy('expense_date')
            ->get()
            ->map(function ($expense) {

                return [

                    'id' => $expense->id,

                    'title' => $expense->title,

                    'amount' => $expense->amount,

                    'expense_date' => $expense->expense_date,

                    'description' => $expense->description,

                ];
            });

        return response()->json([

            'year' => $year,

            'selected_month' => $selectedMonth,

            'summary' => [

                'income' => (float) $totalIncome,

                'expense' => (float) $totalExpense,

                'balance' => (float) ($totalIncome - $totalExpense),

            ],

            'months' => $months,

            'payment_details' => $paymentDetails,

            'expense_details' => $expenseDetails,

        ]);
    }
}
