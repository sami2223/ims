<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExpenseType;

class ExpenseTypeController extends Controller
{

    public function index()
    {
        $expenseTypes = ExpenseType::all();
        return view('expense_types.index', compact('expenseTypes'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'expense_type' => 'required|unique:expense_types,expense_type',
        ]);
        ExpenseType::create([
            'expense_type'=>$request->input('expense_type')
        ]);

        return redirect()->route('expense_types.index')->with('success', 'Record saved successfully');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $expenseType = ExpenseType::where('id', $id)->first();
        return view('expense_types.edit', compact('expenseType'));

    }

    
    public function update(Request $request, $id)
    {
        $request->validate([
            'expense_type' => 'required|unique:expense_types,expense_type,'. $id
        ]);
        ExpenseType::where('id', $id)->update([
            'expense_type'=>$request->input('expense_type')
        ]);

        return redirect()->route('expense_types.index')->with('success', 'Record updated successfully');
    }

    public function destroy($id)
    {
        $expenseType = ExpenseType::where('id', $id)->first();
        $expenseType->delete();

        return redirect()->route('expense_types.index')->with('success', 'Record deleted successfully');

    }
}
