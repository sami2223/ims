<?php

namespace App\Http\Controllers;

use App\Models\Designation;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeesController extends Controller
{
    // Constructor
    public function __construct() 
    { 
        $this->middleware(['auth','preventBackHistory']);
        // $this->middleware('permission:employee-list|employee-create|employee-edit|employee-delete', ['only' => ['index', 'store']]);
        // $this->middleware('permission:employee-create', ['only' => ['create', 'store']]);
        // $this->middleware('permission:employee-edit', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:employee-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $employees = Employee::all();
        
        return view('employees.index', [
            'employees' => $employees
        ]);
    }

    public function create()
    {
        $designations = Designation::all();
        return view('employees.create',[
            'designations' => $designations
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'employee_name' => 'required|unique:employees',
            'sal_amount' => 'required',
            'sal_type' => 'required',
        ],
        [
            'employee_name.required' => 'Please input employee Name',
            'employee_name.unique' => 'Record already exists',
        ]);
        
        Employee::create([
            'employee_name' => $request->input('employee_name'),
            'email' => $request->input('email'),
            'designation_id' => $request->input('designation'),
            'sal_amount' => $request->input('sal_amount'),
            'sal_type' => $request->input('sal_type')
        ]);
        return redirect('employees')->with('success', 'Record has been saved successfully');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $designations = Designation::all();
        $employee = Employee::where('id', '=', $id)
            ->first();

        return view('employees.edit',[
            'employee' => $employee,
            'designations' => $designations
        ]);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'employee_name' => 'required'
        ],
        [
            'employee_name.required' => 'Please input employee name'
        ]);

        Employee::where('id', $id)
            ->update([
                'employee_name' => $request->input('employee_name'),
                'email' => $request->input('email'),
                'designation_id' => $request->input('designation'),
                'sal_amount' => $request->input('sal_amount'),
                'sal_type' => $request->input('sal_type')
            ]);

        return redirect('employees')->with('success', 'Record has been updated successfully');
    }

    public function destroy($id)
    {
        $employee = Employee::where('id', $id)
            ->first();

            $employee->delete();
            return redirect('employees')->with('success', 'Record has been deleted successfully');
    }

    public function getEmployee($employee_id = 0)
    {
        $employeeData['data'] = Employee::where('id', $employee_id)
            ->get();

        return response()->json($employeeData);
    }

    
}
