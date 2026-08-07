<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreExpenseRequest;
use App\Http\Requests\UpdateExpenseRequest;
use App\Http\Resources\ExpenseResource;
use App\Models\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function index(Request $request)
    {
        $query = Expense::query();

        if ($request->filled('month')) {
            $query->whereMonth('expense_date', $request->month);
        }

        if ($request->filled('year')) {
            $query->whereYear('expense_date', $request->year);
        }

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $expenses = $query
            ->latest('expense_date')
            ->paginate(10);

        return ExpenseResource::collection($expenses);
    }

    public function store(StoreExpenseRequest $request)
    {
        $expense = Expense::create(
            $request->validated()
        );

        return new ExpenseResource($expense);
    }

    public function show(Expense $expense)
    {
        return new ExpenseResource($expense);
    }

    public function update(UpdateExpenseRequest $request, Expense $expense)
    {
        $expense->update(
            $request->validated()
        );

        return new ExpenseResource($expense);
    }

    public function destroy(Expense $expense)
    {
        $expense->delete();

        return response()->noContent();
    }
}
