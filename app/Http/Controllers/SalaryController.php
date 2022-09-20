<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Salary;
use Illuminate\Support\Facades\Auth;

class SalaryController extends Controller
{
    
    public function index()
    {
        return view('salaries.index');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        
        $request->validate([
            'selectEmployee' => 'required',            
            'selectDay' => 'required',
            'selectMonth' => 'required',
            'selectYear' => 'required',
        ]);

        $date_formated = "";
        if (!empty($request->input('selectDay')) && !empty($request->input('selectMonth')) && !empty($request->input('selectYear'))) {
            $sal_date = $request->input('selectDay')
                . '-' . $request->input('selectMonth')
                . '-' . $request->input('selectYear');
            $date_formated = date('d-M-Y', strtotime($sal_date));
        }

        $month = '';
        if ($request->input('salType') == 'Monthly') {
            $request->validate(
                [
                    'month' => 'required',
                    'year' => 'required',
                ]
            );
            $month = $request->input('month').'-'.$request->input('year');

            Salary::create([
                'employee_id' => $request->input('selectEmployee'),
                'security' => $request->input('security'),
                'sal_month' => $month,
                'sal_date' => $date_formated,
                'advance' => $request->input('advance'),
                'net_salary' => $request->input('netSalary'),
                'created_by' => Auth::user()->id,
            ]);
        }

        
        if ($request->input('salType') == 'Classwise') {
            $request->validate(
                [
                    'classes' => 'required',
                    'charges' => 'required',
                ]
            );

            Salary::create([
                'employee_id' => $request->input('selectEmployee'),
                'security' => $request->input('security'),
                'no_of_classes' => $request->input('classes'),
                'sal_date' => $date_formated,
                'advance' => $request->input('advance'),
                'net_salary' => $request->input('netSalary'),
                'created_by' => Auth::user()->id,
            ]);
            $classes = $request->input('classes');
            $charges = $request->input('charges');
        }

        return redirect()->route('salaries.index')
        ->with('success', 'Record saved successfully');
    }

    public function show($id)
    {
        $salary = Salary::find($id);
        return view('salaries.show', compact('salary'));
    }

    public function edit($id)
    {
        $salary = Salary::find($id);
        return view('salaries.edit', compact('salary'));
    }

    public function update(Request $request, $id)
    {
        $salary = Salary::find($id);
        $request->validate([            
            'selectDay' => 'required',
            'selectMonth' => 'required',
            'selectYear' => 'required',
        ]);

        $date_formated = "";
        if (!empty($request->input('selectDay')) && !empty($request->input('selectMonth')) && !empty($request->input('selectYear'))) {
            $sal_date = $request->input('selectDay')
                . '-' . $request->input('selectMonth')
                . '-' . $request->input('selectYear');
            $date_formated = date('d-M-Y', strtotime($sal_date));
        }

        $month = '';
        if ($salary->Employee->sal_type == 'Monthly') {
            $request->validate(
                [
                    'month' => 'required',
                    'year' => 'required',
                ]
            );
            $month = $request->input('month').'-'.$request->input('year');

            Salary::where('id',$id)->update([
                'security' => $request->input('security'),
                'sal_month' => $month,
                'sal_date' => $date_formated,
                'advance' => $request->input('advance'),
                'net_salary' => $request->input('netSalary'),
                'updated_by' => Auth::user()->id,
            ]);
        }

        
        if ($salary->Employee->sal_type == 'Classwise') {
            $request->validate(
                [
                    'classes' => 'required',
                    'charges' => 'required',
                ]
            );

            Salary::where('id',$id)->update([
                'security' => $request->input('security'),
                'no_of_classes' => $request->input('classes'),
                'sal_date' => $date_formated,
                'advance' => $request->input('advance'),
                'net_salary' => $request->input('netSalary'),
                'updated_by' => Auth::user()->id,
            ]);

        }

        return redirect()->route('salaries.index')
        ->with('success', 'Record updated successfully');
    }

    public function destroy($id)
    {
        $salary = Salary::find($id);
        $salary->delete();

        return redirect()->route('salaries.index')
        ->with('success', 'Record deleted successfully');
    }
}
