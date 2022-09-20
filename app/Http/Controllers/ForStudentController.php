<?php

namespace App\Http\Controllers;

use App\Models\FeeSlip;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ForStudentController extends Controller
{
    public function __construct()
    {
        $this->middleware(['preventBackHistory']);
    }
    public function Dashboard($id)
    {
        $student = Student::find($id);
        // dd($student->Course->course);
        // $feeSlips = FeeSlip::where('student_id',$id)->get();
        return view('forStudent.dashboard', [
            'student' => $student
        ]);
    }

    public function stdPaymentsHistory($id)
    {
        $student = Student::find($id);
        return view('forStudent.stdPaymentsHistory', compact('student'));
    }

    
}
