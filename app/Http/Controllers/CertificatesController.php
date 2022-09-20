<?php

namespace App\Http\Controllers;

use App\Models\Certificates;
use App\Models\Student;
use App\Models\Course;
use App\Models\Shift;
use App\Models\CourseNames;

use Illuminate\Http\Request;

class CertificatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $certificates = Certificates::all();
        return view('certificates.index', [
            'certificates' => $certificates
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sessions = Course::all();
        $shifts = Shift::all();
        $courses = CourseNames::all();
        $students = Student::all();
        return view('certificates.create', [
            'students' => $students,
            'sessions' => $sessions,
            'shifts' => $shifts,
            'courses' => $courses
        ]);
    }
    
    public function store(Request $request)
    {
        
    }

    public function issue($id)
    {
        $student = Student::find($id);
        return view('certificates.issue', compact('student'));
    }

    public function saveIssue(Request $request, $id){
        $request->validate(
            [
                'selectType' => 'required',
                'selectDay' => 'required',
                'selectMonth' => 'required',
                'selectYear' => 'required',
                'received_by' => 'required'
            ],
            [
                'selectType.required' => 'Please select a Type',
                'selectDay.required' => 'Please select a Day',
                'selectMonth.required' => 'Please select a Month',
                'selectYear.required' => 'Please select Year',
            ]
        );
        $issueDate_formated = "";
        $issueDate =  $request->input('selectMonth') .
            '/' . $request->input('selectDay') .
            '/' . $request->input('selectYear');
        // converting string to date formate
        $issueDate_formated = date('d-M-Y', strtotime($issueDate));
        Certificates::create([
                'student_id' => $id,
                'cert_type_id' => $request->input('selectType'),
                'issued' => 1,
                'issue_date' => $issueDate_formated,
                'received_by' => $request->input('received_by')
            ]);
        
        return redirect()->route('certificates.index')->with('success', 'Record saved successfully');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $certificate = Certificates::find($id);
        return view('certificates.edit', compact('certificate'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'selectType' => 'required',
                'selectDay' => 'required',
                'selectMonth' => 'required',
                'selectYear' => 'required',
                'received_by' => 'required'
            ],
            [
                'selectType.required' => 'Please select a Type',
                'selectDay.required' => 'Please select a Day',
                'selectMonth.required' => 'Please select a Month',
                'selectYear.required' => 'Please select Year',
            ]
        );
        $issueDate_formated = "";
        $issueDate =  $request->input('selectMonth') .
            '/' . $request->input('selectDay') .
            '/' . $request->input('selectYear');
        // converting string to date formate
        $issueDate_formated = date('d-M-Y', strtotime($issueDate));
        Certificates::where('id', $id)->
            update([
                'cert_type_id' => $request->input('selectType'),
                'issue_date' => $issueDate_formated,
                'received_by' => $request->input('received_by')
            ]);
        
        return redirect()->route('certificates.index')->with('success', 'Record updated successfully');
    }

    public function destroy($id)
    {
        $certificate = Certificates::where('id', $id)->first();
        $certificate->delete();

        return redirect()->route('certificates.index')->with('success', 'Record deleted successfully');
    }

}
