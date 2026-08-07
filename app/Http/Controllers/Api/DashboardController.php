<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use App\Models\House;
use App\Models\HouseResident;
use App\Models\Payment;
use App\Models\Resident;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $month = now()->month;
        $year = now()->year;

        $totalIncome = Payment::where('status', 'paid')
            ->sum('amount');

        $monthlyIncome = Payment::where('status', 'paid')
            ->where('month', $month)
            ->where('year', $year)
            ->sum('amount');

        $totalExpense = Expense::sum('amount');

        $monthlyExpense = Expense::whereMonth('expense_date', $month)
            ->whereYear('expense_date', $year)
            ->sum('amount');

        $chart = [];

        for ($i = 1; $i <= 12; $i++) {

            $income = Payment::where('status', 'paid')
                ->where('month', $i)
                ->where('year', $year)
                ->sum('amount');

            $expense = Expense::whereMonth('expense_date', $i)
                ->whereYear('expense_date', $year)
                ->sum('amount');

            $chart[] = [
                'month' => Carbon::create()->month($i)->format('M'),
                'income' => $income,
                'expense' => $expense,
            ];
        }

        return response()->json([

            'houses' => [
                'total' => House::count(),
                'occupied' => House::where('status', 'occupied')->count(),
                'vacant' => House::where('status', 'vacant')->count(),
            ],

            'residents' => [
                'total' => Resident::count(),
                'active' => HouseResident::where('is_active', true)->count(),
            ],

            'finance' => [
                'total_income' => $totalIncome,
                'total_expense' => $totalExpense,
                'balance' => $totalIncome - $totalExpense,
                'unpaid_bills' => Payment::where('status', 'unpaid')->count(),
            ],

            'current_month' => [
                'income' => $monthlyIncome,
                'expense' => $monthlyExpense,
                'balance' => $monthlyIncome - $monthlyExpense,
            ],

            'chart' => $chart,

            'latest_payments' => Payment::with([
                'house',
                'paymentType'
            ])
                ->latest()
                ->take(5)
                ->get(),

            'latest_expenses' => Expense::latest()
                ->take(5)
                ->get(),
        ]);
    }
}
