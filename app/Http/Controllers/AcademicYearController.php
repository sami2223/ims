<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use Illuminate\Http\Request;

class AcademicYearController extends Controller
{
    // Constructor
    public function __construct() 
    { 
        $this->middleware(['auth','preventBackHistory']);
        // $this->middleware('permission:student-list|student-create|student-edit|student-delete', ['only' => ['index', 'store']]);
        // $this->middleware('permission:student-create', ['only' => ['create', 'store']]);
        // $this->middleware('permission:student-edit', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:student-delete', ['only' => ['destroy']]);
    }
    
    public function index()
    {
        $academic_years = AcademicYear::all();
        return view('academic_years.index')
            ->with('academic_years', $academic_years);
    }

    public function create()
    {
        return view('academic_years.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'academic_year' => 'required|unique:academic_years|min:9'
        ],
        [
            'academic_year.required' => 'Please input Academic Year',
            'academic_year.unique' => 'Record already exists',
            'academic_year.min' => 'Please type Academic Year as 2000-2099'
        ]);

        AcademicYear::create($request->all());
        return redirect('academic_years')->with('success', 'Record has been saved successfully');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $academicYear = AcademicYear::where('id', '=', $id)
            ->first();

        return view('academic_years.edit')->with('academicYear', $academicYear);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'academic_year' => 'required|unique:academic_years|min:9'
        ],
        [
            'academic_year.required' => 'Please input Academic Year',
            'academic_year.unique' => 'Record already exists',
            'academic_year.min' => 'Please type Academic Year as 2000-2099'
        ]);

        AcademicYear::where('id', $id)
            ->update([
                'academic_year' => $request->input('academic_year')
            ]);

        return redirect('academic_years')->with('success', 'Record has been updated successfully');
    }

    public function destroy($id)
    {
        $academicYear = AcademicYear::where('id', $id)
            ->first();

            $academicYear->delete();
            return redirect('academic_years')->with('success', 'Record has been deleted successfully');
    }
}
