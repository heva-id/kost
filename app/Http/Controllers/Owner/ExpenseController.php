<?php
// app/Http/Controllers/ExpenseController.php

namespace App\Http\Controllers\Owner;

use ErrorException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Expense;
use Illuminate\Support\Facades\DB;

class ExpenseController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $search = $request->input('search');
        $filterDate = $request->input('filter_date');

        $expenses = Expense::when($search, function ($query) use ($search) {
            $query->where('description', 'like', '%' . $search . '%');
        })->when($filterDate, function ($query) use ($filterDate) {
            $query->whereDate('date', $filterDate);
        })->paginate($perPage);

        return view('pemilik.pengeluaran.index', compact('expenses', 'search', 'filterDate'));
    }

    public function create()
    {
        return view('pemilik.pengeluaran.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required',
            'amount' => 'required|numeric',
            'date' => 'required|date',
        ]);

        $request->merge(['user_id' => auth()->user()->id]);

        Expense::create($request->all());

        return redirect()->route('expenses.index')->with('success', 'Expense created successfully');
    }

    // public function edit(Expense $expense)
    // {
    //     return view('pemilik.pengeluaran.edit', compact('expense'));
    // }

    public function edit($id)
    {
        $expense = Expense::findOrFail($id);
        return view('pemilik.pengeluaran.create', compact('expense'));
    }
    public function update(Request $request, Expense $expense)
    {
        $request->validate([
            'description' => 'required',
            'amount' => 'required|numeric',
            'date' => 'required|date',
        ]);

        $expense->update($request->all());

        return redirect()->route('expenses.index')->with('success', 'Expense updated successfully');
    }

    public function destroy(Expense $expense)
    {
        $expense->delete();

        return redirect()->route('expenses.index')->with('success', 'Expense deleted successfully');
    }
}
