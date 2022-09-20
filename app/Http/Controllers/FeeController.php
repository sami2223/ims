<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fee;
use App\Models\FeeSlip;
use App\Models\Student;
use App\Models\Exam;
use App\Models\Course;
use App\Models\Session;
use App\Models\Shift;
use App\Models\ExamType;
use App\Models\FeeType;
use App\Models\CourseNames;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

class FeeController extends Controller
{
    // Constructor
    public function __construct()
    {
        $this->middleware(['auth', 'preventBackHistory']);
       
    }

    public function index()
    {
        $students = Student::all();
        $sessions = Course::all();
        $shifts = Shift::all();
        $courses = CourseNames::all();       
        
        return view('fee.index2', compact(
            'sessions',
            'shifts',
            'courses'
        ));
    }

    public function edit($id)
    {
        $students = Student::all();
        $examTypes = ExamType::all();
        $sessions = Session::all();
        $shifts = Shift::all();
        $courses = Course::all();
        return view(
            'exams.create',
            [
                'examTypes' => $examTypes,
                'sessions' => $sessions,
                'shifts' => $shifts,
                'courses' => $courses,
                'students' => $students
            ]
        );
        $fee = Fee::find($id);
        return view('fee.edit', ['fee' => $fee]);
    }

    public function create()
    {
        $sessions = Course::all();
        $shifts = Shift::all();
        $courses = CourseNames::all();
        return view('fee.create', compact(
            'sessions',
            'shifts',
            'courses'
        ));
    }

    public function feeSearch(Request $request)
    {
        $this->validate($request, 
        [
            'selectCourse' => 'required'
        ],
        [
            'selectCourse.required' => 'Please select a course'
        ]);
        $course_id = $request->input('selectCourse');
        $session_id = $request->input('selectSession');
        $shift_id = $request->input('selectShift');
        $courses = Course::all();
        $shifts = Shift::all();

        $course = Course::find($request->input('selectCourse'));
        if( $course_id > 0 && $session_id == 0 && $shift_id == 0)
        {
            $students = Student::where('course_id', $course->id)
            ->get();
        }
        else if($course_id > 0 && $session_id > 0 && $shift_id == 0)
        {
            $students = Student::where('session_id', $session_id)
            ->get();
        }
        else if($course_id > 0 && $session_id > 0 && $shift_id > 0)
        {
            $students = Student::where('session_id', $session_id)
            ->where('shift_id', $shift_id)
            ->get();
        }
        else if($course_id > 0 && $session_id == 0 && $shift_id > 0)
        {
            $students = Student::where('course_id', $course_id)
            ->where('shift_id', $shift_id)
            ->get();
        }
        
        return view('fee.searchResult', [
                'shifts' => $shifts,
                'courses' => $courses,
                'students' => $students,
                'course' => $course
            ]
        );

        // $feesArray = array();
        // foreach ($students as $student) {
        //     $fee = Fee::where('student_id', $student->id)->get();
        //     array_push(
        //         $feesArray,
        //         $fee
        //     );
        // }
        
        // $fees = $feesArray;
        // foreach($fees as $f){
        //     dd($f['0']['id']);
        // }
        // dd($fees);
        
    }

    public function feeSearchBySlipNo(Request $request)
    {
        $slipNo = $request->input('slip_no');
        $fee = Fee::where('slip_id', $request->input('slip_no'))
            ->get();
            return view('fee.searchResultForSlipNo',
            [
                'slipNo' => $slipNo,
                'fee' => $fee
            ]);
    }

    public function show($id)
    {
        $feeSlips = FeeSlip::where('student_id', $id)
            ->get();
        $student = Student::find($id);
        return view('fee.show',[
            'student' => $student,
            'feeSlips' => $feeSlips
        ]);
    }

    public function showDetails($id)
    {
        $fee = Fee::where('slip_id', $id)
            ->get();
        $slip = FeeSlip::find($id);
        $student = Student::where('id',$slip->student->id);
        // dd($student);
        return view('fee.showDetails',
        [
            'slip' => $slip,
            'fee' => $fee,
            'student' => $student
        ]);
    }

    public function studentFeeSlipPDF($id)
    {
        // $student = Student::find($id);
        // $feeslip = FeeSlip::where('student_id', '=', $id)
        //     ->orderby('id', 'desc')
        //     ->first();

        $data['feeslip'] = FeeSlip::with(['student', 'fees'])
            ->orderby('id', 'desc')
            ->where('id', $id)->first();

        // $data['student'] = Student::with('address')
        //     ->where('id', $id)->first();

        $pdf = PDF::loadView('students.fees.studentFeeSlip_pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('FeeSlip.pdf');
    }

    public function createFee($id)
    {
        $student = Student::find($id);
        $fee_types = FeeType::all();
        return view('students.fees.create', [
            'student' => $student,
            'fee_types' => $fee_types
        ]);
    }

    public function storeFee(Request $request, $id)
    {
        
        $request->validate([
            'fee_type' => 'required',
            'total' => 'required',
            'paid' => 'required'
        ],
        [
            'fee_type.required'=>'Please select a fee type',
            'total.required' => 'Please enter total amount',
            'paid.required' => 'Please enter paid amount'
        ]);
        $feeType = $request->input('fee_type');
        if($feeType == 'Monthly')
        {
            $request->validate([
                'selectMonth' => 'required',
                'selectYear' => 'required',
                
            ],
            [
                'selectMonth.required'=>'Please select month for fee',
                'selectYear.required' => 'Please select year'
            ]);
        }
        $slip = FeeSlip::create([
            'student_id' => $id,
            'paid_amount' => $request->input('paid'),
            'total_amount' => $request->input('total')
        ]);
        

        if(!empty($slip))
        {
            $fee = Fee::create([
                'student_id' => $id,
                'slip_id' => $slip->id,
                'fee_type' => $request->input('fee_type'),
                'total_amount' => $request->input('total'),
                'paid_amount' => $request->input('paid'),
                'balance' => $request->input('balance'),           
                'for_month' => $request->input('selectMonth'),
                'for_year' => $request->input('selectYear')
            ]);
        }

        return redirect()->route('students.viewFeeslip', [$id]);
    }

}
