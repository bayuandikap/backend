<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use App\Models\Payment;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function monthlyFinancial(Request $request)
    {
        $year = $request->input('year', now()->year);

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
                'month_name' => Carbon::create()->month($month)->format('F'),
                'income' => $income,
                'expense' => $expense,
                'balance' => $income - $expense,
            ];
        }

        return response()->json([
            'year' => $year,

            'summary' => [
                'income' => collect($months)->sum('income'),
                'expense' => collect($months)->sum('expense'),
                'balance' => collect($months)->sum('balance'),
            ],

            'months' => $months,
        ]);
    }
}
