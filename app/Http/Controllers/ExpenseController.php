<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
{
    
    public function index()
    {
        return view('expenses.index');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        
        $request->validate([
            'selectExpType' => 'required',
            'amount' => 'required',
            'selectDay' => 'required',
            'selectMonth' => 'required',
            'selectYear' => 'required'
        ]);

        $date_formated = "";
        if (!empty($request->input('selectDay')) && !empty($request->input('selectMonth')) && !empty($request->input('selectYear'))) {
            $dob = $request->input('selectDay')
                . '-' . $request->input('selectMonth')
                . '-' . $request->input('selectYear');
            $date_formated = date('d-M-Y', strtotime($dob));
        }

        Expense::create([
            'expense_type_id' => $request->input('selectExpType'),
            'amount' => $request->input('amount'),
            'dated' => $date_formated,
            'created_by' => Auth::user()->id,
        ]);

        return redirect()->route('expenses.index')
        ->with('success', 'Record saved successfully');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $expense = Expense::find($id);
        return view('expenses.edit', compact('expense'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'selectExpType' => 'required',
            'amount' => 'required',
            'selectDay' => 'required',
            'selectMonth' => 'required',
            'selectYear' => 'required'
        ]);

        $date_formated = "";
        if (!empty($request->input('selectDay')) && !empty($request->input('selectMonth')) && !empty($request->input('selectYear'))) {
            $dob = $request->input('selectDay')
                . '-' . $request->input('selectMonth')
                . '-' . $request->input('selectYear');
            $date_formated = date('d-M-Y', strtotime($dob));
        }

        Expense::where('id',$id)->update([
            'expense_type_id' => $request->input('selectExpType'),
            'amount' => $request->input('amount'),
            'dated' => $date_formated,
            'updated_by' => Auth::user()->id,
        ]);

        return redirect()->route('expenses.index')
        ->with('success', 'Record updated successfully');
    }

    public function destroy($id)
    {
        $expense = Expense::find($id);
        $expense->delete();

        return redirect()->route('expenses.index')
        ->with('success', 'Record deleted successfully');
    }
}
