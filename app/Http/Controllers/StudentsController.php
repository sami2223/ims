<?php

namespace App\Http\Controllers;

use App\Models\AddFee;
use App\Models\Address;
use App\Models\Category;
use App\Models\Course;
use App\Models\Batch;
use App\Models\Student;
use App\Models\StudentParent;
use App\Models\EmergencyContact;
use App\Models\Fee;
use App\Models\Session;
use App\Models\Shift;
use App\Models\Timing;
use App\Models\StudentFeedback;
use App\Models\StdPreviousData;
use App\Models\FeeType;
use App\Models\FeeSlip;
use App\Models\User;
use App\Models\Certificates;
use App\Models\CourseNames;
use Illuminate\Http\Request;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

class StudentsController extends Controller
{
    // Constructor
    public function __construct()
    {
        date_default_timezone_set('Asia/Karachi');
        $this->middleware(['auth', 'preventBackHistory']);
        // $this->middleware('permission:student-list|student-create|student-edit|student-delete', ['only' => ['index', 'store']]);
        // $this->middleware('permission:student-create', ['only' => ['create', 'store']]);
        // $this->middleware('permission:student-edit', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:student-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $sessions = Course::all();
        $shifts = Shift::all();
        $courses = CourseNames::all();
        $batches = Batch::all();
        $students = Student::all();
        return view('students.index', [
            'batches' => $batches,
            'students' => $students,
            'sessions' => $sessions,
            'shifts' => $shifts,
            'courses' => $courses
        ]);
    }


    public function create()
    {
        // Fetch courses
        $courses = CourseNames::all();

        $shifts = Shift::orderby('id', 'asc')
            ->select('id', 'shift_name')
            ->get();

        // Load create view
        return view('students.create', [
            'courses' => $courses,
            'shifts' => $shifts
        ]);
    }

    // Fetch records for dropdown
    public function getBatches($session_id = 0)
    {

        // Fetch Batches
        $batchData['data'] = Batch::orderby('batch_name', 'asc')
            ->select('id', 'batch_name')
            ->where('session_id', $session_id)
            ->get();

        return response()->json($batchData);
    }

    public function getSessions($course_id = 0)
    {

        // Fetch Sessions
        $sessionData['data'] = Course::orderby('course', 'asc')
            ->select('id', 'course')
            ->where('course_id', $course_id)
            ->get();

        return response()->json($sessionData);
    }

    public function getStudentsViaSessionShift($session_id = 0)
    {

        // Fetch studentData
        $studentData['data'] = Student::orderby('first_name', 'asc')
            ->where('session_id', $session_id)
            ->get();

        return response()->json($studentData);
    }

    public function getStudentsViaCourse($course_id = 0)
    {

        // Fetch studentData
        $studentData['data'] = Student::orderby('first_name', 'asc')
            ->where('course_id', $course_id)
            ->get();

        return response()->json($studentData);
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'fname' => 'required|min:2',
                'selectCourse' => 'required',
                'selectBatch' => 'required',
                'photo' => 'image|mimes:jpeg,png,jpg|max:500',
                'email' => 'required|email|unique:students,email',
            ],
            [
                'fname.required' => 'First name cannot be blank',
                'fname.min' => 'Name must be at least 2 characters long',
                'selectCourse.required' => 'Please select a course',
                'selectBatch.required' => 'Please select a batch',
                'email.required' => 'Email cannot be blank',
                'email.unique' => 'Email already exists'
            ]
        );
        $dob_formated = "";
        if (!empty($request->input('selectDay')) && !empty($request->input('selectMonth')) && !empty($request->input('selectYear'))) {
            $dob = $request->input('selectDay')
                . '-' . $request->input('selectMonth')
                . '-' . $request->input('selectYear');
            $dob_formated = date('d-M-Y', strtotime($dob));
        }



        $yoj_formated = "";
        if (!empty($request->input('selectDoJ')) && !empty($request->input('selectMoJ')) && !empty($request->input('selectYoJ'))) {
            $yoj = $request->input('selectDoJ')
                . '-' . $request->input('selectMoJ')
                . '-' . $request->input('selectYoJ');
            $yoj_formated = date('d-M-Y', strtotime($yoj));
        }

        $yol_formated = "";
        if (!empty($request->input('selectDoL')) && !empty($request->input('selectMoL')) && !empty($request->input('selectYoL'))) {
            $yol = $request->input('selectDoL')
                . '-' . $request->input('selectMoL')
                . '-' . $request->input('selectYoL');
            $yol_formated = date('d-M-Y', strtotime($yol));
        }

        if (!empty($yol)) {
            $yol_formated = date('d-M-Y', strtotime($yol));
        }


        $file = '';
        if (!empty($request->file('photo')) || $request->file('photo') != null) {
            $image = $request->file('photo');
            $name_gen = uniqid();
            $img_ext = strtolower($image->getClientOriginalExtension());
            $img_name = $request->input('fname') . '_' . $name_gen . '.' . $img_ext;
            $folderPath = 'images/students/';
            $file = $folderPath .  $img_name;

            $image->move($folderPath, $img_name);
        }
        else if (!empty($request->input('image')) || $request->input('image') != null) {

            $img = $request->input('image');
            $image_parts = explode(";base64,", $img);

            foreach ($image_parts as $key => $image) {
                $image_base64 = base64_decode($image);
            }
            $folderPath = 'images/students/';
            $fileName = $request->input('fname') . '_' . uniqid() . '.png';
            $file = $folderPath . $fileName;
            file_put_contents($file, $image_base64);

            // for <input type="file" ... i.e. choose file
            // $name_gen = hexdec(uniqid()); // OR only uniqid();
            // $img_ext = strtolower($image->getClientOriginalExtension());
            // $fileName = $request->input('fname') . '_' . $name_gen . '.' . 'jpeg';
            // $img->move($folderPath, $fileName);
        }

        $code = rand(00000000, 99999999);
        $password = bcrypt($code);
        $is_admin = 0;
        $shift = Shift::find($request->input('selectShift'));
        $batch = Batch::find($request->input('selectBatch'));
        $session = Course::find($request->input('selectSession'));
        $fcshift = substr($shift->shift_name, 0, 1);
        $regno = $batch->batch_name.'-'. $session->course .'-'. $fcshift;

        $student = Student::create([
            'reg_no' => '',
            'first_name' => $request->input('fname'),
            'last_name' => $request->input('lname'),
            'father_name' => $request->input('father_name'),
            'dob' => $dob_formated,
            'gender' => $request->input('gender'),
            'nationality' => $request->input('nationality'),
            'address' => $request->input('address'),
            'city' => $request->input('city'),
            'mobile' => $request->input('mobile'),
            'father_contact' => $request->input('father_contact'),
            'email' => $request->input('email'),
            'course_id' => $request->input('selectCourse'),
            'session_id' => $request->input('selectSession'),
            'batch_id' => $request->input('selectBatch'),
            'shift_id' => $request->input('selectShift'),
            'image' => $file,
            'yoj' => $yoj_formated,
            'yol' => $yol_formated,
            'code' => $code,
            'created_at' => now()

        ]);

        if ($student) {
            $regno = $regno. $student->id;
            Student::where('id', $student->id)->update([
                'reg_no' => $regno,
            ]);

            $user = User::create([
                'name' => $request->input('fname'),
                'email' => $request->input('email'),
                'student_id' => $student->id,
                'password' => $password,
                'is_admin' => $is_admin,
            ]);
            $user->assignRole('Student');

            // Inserting Address to DB
            Address::create([
                'student_id' => $student->id,
                'address_one' => $request->input('address'),
                'mobile' => $request->input('mobile'),
                'father_contact' => $request->input('father_contact'),
                'email' => $request->input('email'),
            ]);


            Timing::create([
                'student_id' => $student->id,
                'from' => $request->input('from'),
                'to' => $request->input('to'),
            ]);

            StdPreviousData::create([
                'student_id' => $student->id,
                'education' => $request->input('education'),
                'computer_knowledge' => $request->input('computer_knowledge')
            ]);
            StudentFeedback::create([
                'student_id' => $student->id,
                'feedback' => $request->input('feedback')
            ]);
            Certificates::create([
                'student_id' => $student->id,
                'issued' => 0,
                'recevied_by' => '',
                'issue_date' => '',
                'received_by' => '',
            ]);
        }

        return redirect()->route('students.createFee', [$student->id])
            ->with('success', 'Student record has been saved successfully');
    }

    public function show($id)
    {
        $student = Student::find($id);

        return view('students.show', [
            'student' => $student

        ]);
    }


    public function edit($id)
    {
        // Fetch student on id
        $student = Student::find($id);

        $shifts = Shift::orderby('id', 'asc')
            ->select('id', 'shift_name')
            ->get();

        // Fetch courses
        $courses = CourseNames::all();

        return view('students.edit', [
            'student' => $student,
            'shifts' => $shifts,
            'courses' => $courses
        ]);
    }


    public function update(Request $request, $id)
    {
        $validatedData = $request->validate(
            [
                'fname' => 'required|min:2',
                'selectCourse' => 'required',
                'selectBatch' => 'required',
                'email' => 'required|email|unique:students,email,' . $id,
            ],
            [
                'fname.required' => 'First name cannot be blank',
                'fname.min' => 'Name must be at least 2 characters long',
                'selectCourse.required' => 'Please select a course',
                'selectBatch.required' => 'Please select a batch',
                'email.required' => 'Email cannot be blank',
                'email.unique' => 'Email already exists'
            ]
        );
        $dob_formated = "";
        if (!empty($request->input('selectDay')) && !empty($request->input('selectMonth')) && !empty($request->input('selectYear'))) {
            $dob = $request->input('selectDay')
                . '-' . $request->input('selectMonth')
                . '-' . $request->input('selectYear');
            $dob_formated = date('d-M-Y', strtotime($dob));
        }



        $yoj_formated = "";
        if ($request->input('selectDoJ') > 0 && $request->input('selectMoJ') > 0 && $request->input('selectYoJ') > 0) {
            $yoj = $request->input('selectDoJ')
                . '-' . $request->input('selectMoJ')
                . '-' . $request->input('selectYoJ');
            $yoj_formated = date('d-M-Y', strtotime($yoj));
        }


        $yol_formated = "";
        if ($request->input('selectDoL') > 0 && $request->input('selectMoL') > 0 && $request->input('selectYoL') > 0) {
            $yol = $request->input('selectDoL')
                . '-' . $request->input('selectMoL')
                . '-' . $request->input('selectYoL');
            $yol_formated = date('d-M-Y', strtotime($yol));
        }


        if (!empty($yol)) {
            $yol_formated = date('d-M-Y', strtotime($yol));
        }


        $file = '';
        if (!empty($request->input('image')) || $request->input('image') != null) {
            $student = Student::find($id);
            if (!empty($student->image)) {
                unlink($student->image);
            }
            $img = $request->input('image');
            $image_parts = explode(";base64,", $img);

            foreach ($image_parts as $key => $image) {
                $image_base64 = base64_decode($image);
            }
            $folderPath = 'images/students/';
            $fileName = $request->input('fname') . '_' . uniqid() . '.png';
            $file = $folderPath . $fileName;
            file_put_contents($file, $image_base64);
            

            Student::where('id', $id)
                ->update([
                    'first_name' => $request->input('fname'),
                    'last_name' => $request->input('lname'),
                    'father_name' => $request->input('father_name'),
                    'dob' => $dob_formated,
                    'gender' => $request->input('gender'),
                    'nationality' => $request->input('nationality'),
                    'address' => $request->input('address'),
                    'mobile' => $request->input('mobile'),
                    'father_contact' => $request->input('father_contact'),
                    'email' => $request->input('email'),
                    'course_id' => $request->input('selectCourse'),
                    'session_id' => $request->input('selectSession'),
                    'batch_id' => $request->input('selectBatch'),
                    'shift_id' => $request->input('selectShift'),
                    'image' => $file,
                    'yoj' => $yoj_formated,
                    'yol' => $yol_formated,
                ]);
        } else {
            Student::where('id', $id)
                ->update([
                    'first_name' => $request->input('fname'),
                    'last_name' => $request->input('lname'),
                    'father_name' => $request->input('father_name'),
                    'dob' => $dob_formated,
                    'gender' => $request->input('gender'),
                    'nationality' => $request->input('nationality'),
                    'address' => $request->input('address'),
                    'mobile' => $request->input('mobile'),
                    'father_contact' => $request->input('father_contact'),
                    'email' => $request->input('email'),
                    'course_id' => $request->input('selectCourse'),
                    'session_id' => $request->input('selectSession'),
                    'batch_id' => $request->input('selectBatch'),
                    'shift_id' => $request->input('selectShift'),
                    'yoj' => $yoj_formated,
                    'yol' => $yol_formated

                ]);
        }

        Address::where('student_id', $id)->update([
            'address_one' => $request->input('address'),
            'mobile' => $request->input('mobile'),
            'father_contact' => $request->input('father_contact'),
            'email' => $request->input('email'),
        ]);

        Timing::where('student_id', $id)->update([
            'from' => $request->input('from'),
            'to' => $request->input('to'),
        ]);

        // StdPreviousData::where('student_id', $id)->update([
        //     'education' => $request->input('education'),
        //     'computer_knowledge' => $request->input('computer_knowledge')
        // ]);
        // StudentFeedback::where('student_id', $id)->update([
        //     'feedback' => $request->input('feedback')
        // ]);
        return redirect()->route('students.index')
            ->with('success', 'Student record updated successfully');
    }

    public function destroy($id)
    {
        $student = Student::find($id);
        if (!empty($student->image)) {
            unlink($student->image);
        }
        $student->stdPreviousData()->delete();
        $student->Certificate()->delete();
        $student->Feedback()->delete();
        $student->Timing()->delete();
        $student->address()->delete();
        foreach ($student->Fees as $fee) {
            $fee->delete();
        }
        foreach ($student->FeeSlips as $feeslip) {
            $feeslip->delete();
        }
        $user = User::where('email', $student->email)->first();
        $user->delete();
        $student->delete();
        return redirect('students')->with('success', 'Student deleted successfully.');
    }

    public function createParent($id)
    {
        $student = Student::find($id);
        return view('students.parents.createParent', [
            'student' => $student
        ]);
    }

    public function storeParent(Request $request, $id)
    {
        $dob = $request->input('selectDay')
            . '-' . $request->input('selectMonth')
            . '-' . $request->input('selectYear');

        $dob_formated = date('d-M-Y', strtotime($dob));


        $last_img = '';
        if (!empty($request->file('photo')) || $request->file('photo') != null) {
            $image = $request->file('photo');
            $name_gen = hexdec(uniqid());
            $img_ext = strtolower($image->getClientOriginalExtension());
            $img_name = $name_gen . '.' . $img_ext;
            $up_location = 'images/students/parents/';
            $last_img = $up_location .  $img_name;

            $image->move($up_location, $img_name);
        }
        $parent = StudentParent::create([
            'student_id' => $id,
            'first_name' => $request->input('fname'),
            'last_name' => $request->input('lname'),
            'dob' => $dob_formated,
            'relation' => $request->input('relation'),
            'education' => $request->input('education'),
            'occupation' => $request->input('occupation'),
            'income' => $request->input('income'),
            'image' => $last_img

        ]);

        if ($parent) {
            $std_contact = Address::create([
                'parent_id' => $parent->id,
                'address_one' => $request->input('officeAddress1'),
                'address_two' => $request->input('officeAddress2'),
                'city' => $request->input('city'),
                'state' => $request->input('state'),
                'pin_code' => $request->input('pin_code'),
                'country' => $request->input('country'),
                'phone' => $request->input('phone'),
                'mobile' => $request->input('mobile'),
                'email' => $request->input('email'),
                'officePhone' => $request->input('officePhone')
            ]);
        }

        return redirect()->route('students.viewParents', [$id]);
    }

    public function viewParents($id)
    {
        $student = Student::find($id);
        $parents = StudentParent::where('student_id', '=', $id)
            ->get();
        return view('students.parents.viewParents', [
            'parents' => $parents,
            'student' => $student
        ]);
    }

    public function editParent($id)
    {
        header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        $parent = StudentParent::find($id);
        return view('students.parents.editParent', ['parent' => $parent]);
    }

    public function updateParent(Request $request, $id)
    {
        $dob = $request->input('selectDay')
            . '-' . $request->input('selectMonth')
            . '-' . $request->input('selectYear');

        $dob_formated = date('d-M-Y', strtotime($dob));


        $last_img = '';
        if (!empty($request->file('photo')) || $request->file('photo') != null) {
            $image = $request->file('photo');
            $name_gen = hexdec(uniqid());
            $img_ext = strtolower($image->getClientOriginalExtension());
            $img_name = $name_gen . '.' . $img_ext;
            $up_location = 'images/students/parents/';
            $last_img = $up_location .  $img_name;
            // uploading image
            $image->move($up_location, $img_name);

            // removing old image
            if ($request->input('old_image') != null) {
                $old_img = $request->input('old_image');
                unlink($old_img);
            }

            StudentParent::where('id', '=', $id)
                ->update([
                    'first_name' => $request->input('fname'),
                    'last_name' => $request->input('lname'),
                    'dob' => $dob_formated,
                    'relation' => $request->input('relation'),
                    'education' => $request->input('education'),
                    'occupation' => $request->input('occupation'),
                    'income' => $request->input('income'),
                    'image' => $last_img

                ]);
        } else {
            StudentParent::where('id', '=', $id)
                ->update([
                    'first_name' => $request->input('fname'),
                    'last_name' => $request->input('lname'),
                    'dob' => $dob_formated,
                    'relation' => $request->input('relation'),
                    'education' => $request->input('education'),
                    'occupation' => $request->input('occupation'),
                    'income' => $request->input('income'),
                ]);
        }


        Address::where('parent_id', $id)
            ->update([
                'address_one' => $request->input('officeAddress1'),
                'address_two' => $request->input('officeAddress2'),
                'city' => $request->input('city'),
                'state' => $request->input('state'),
                'pin_code' => $request->input('pin_code'),
                'country' => $request->input('country'),
                'phone' => $request->input('phone'),
                'mobile' => $request->input('mobile'),
                'email' => $request->input('email'),
                'officePhone' => $request->input('officePhone')
            ]);

        $parent = StudentParent::where('id', $id)->first();
        return redirect()->route('students.showParents', [$parent->student_id])
            ->with('success', 'Guardian updated successfully');
    }

    public function emergencyContact($id)
    {
        $parents = StudentParent::where('student_id', '=', $id)
            ->get();
        $student = Student::find($id);
        return view('students.parents.emergencyContact', [
            'parents' => $parents,
            'student' => $student
        ]);
    }

    public function storeEmergencyContact(Request $request, $id)
    {
        // $stdId = $request->session()->get('stdId');
        EmergencyContact::create([
            'student_id' => $id,
            'parent_id' => $request->input('emergencyContact')
        ]);

        return redirect()->route('students.previousData', [$id])
            ->with('successMsg', 'Emergency contact has been set successfully');
    }

    public function updateEmergencyContact(Request $request, $id)
    {
        EmergencyContact::where('student_id', $id)
            ->update([
                'parent_id' => $request->input('emergencyContact')
            ]);

        return redirect('students/' . $id)
            ->with('success', 'Emergency contact has been set successfully');
    }

    public function previousData($id)
    {
        $student = Student::find($id);
        return view('students.previousData', [
            'student' => $student
        ]);
    }

    public function storePreviousData(Request $request, $id)
    {
        StdPreviousData::create([
            'student_id' => $id,
            'education' => $request->input('education'),
            'computer_knowledge' => $request->input('computer_knowledge')
        ]);

        return redirect('students/' . $id)
            ->with('success', 'Student previous data saved successfully.');
    }

    public function editPreviousData($id)
    {
        $student = Student::find($id);
        $preData =  StdPreviousData::where('student_id', $id)->first();
        return view('students.editPreviousData', [
            'student' => $student,
            'preData' => $preData
        ]);
    }

    public function updatePreviousData(Request $request, $id)
    {
        StdPreviousData::where('student_id', $id)
            ->update([
                'student_id' => $id,
                'education' => $request->input('education'),
                'computer_knowledge' => $request->input('computer_knowledge')
            ]);

        return redirect('students/' . $id)->with('success', 'Record updated successfully');
    }

    public function showParents($id)
    {
        $student = Student::find($id);
        $parents = StudentParent::where('student_id', $id)
            ->get();
        return view('students.showParents', [
            'parents' => $parents,
            'student' => $student
        ]);
    }

    public function getBatchStudents($batch_id)
    {
        // Fetch students
        $studentsData['data'] = Student::orderby('first_name', 'asc')
            ->select('id', 'first_name', 'midle_name', 'last_name')
            ->where('batch_id', $batch_id)
            ->get();

        return response()->json($studentsData);
    }

    public function studentDetailsPDF($id)
    {
        $data['student'] = Student::with(['batch', 'category', 'address', 'stdPreviousData', 'emergency'])
            ->where('id', $id)->first();

        $pdf = PDF::loadView('students.student_pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }

    public function getFeetypeFee($feetype_id)
    {
        // Fetch record
        $feetypeData['data'] = AddFee::where('feetype_id', $feetype_id)
            ->get();

        return response()->json($feetypeData);
    }

    public function createFee($id)
    {
        $student = Student::find($id);
        $session = Course::find($student->session_id);
        $fee_types = FeeType::all();
        return view('students.fees.create', [
            'student' => $student,
            'fee_types' => $fee_types,
            'session' => $session
        ]);
    }

    public function storeFee(Request $request, $id)
    {

        $request->validate(
            [
                'fee_type' => 'required',
                'total' => 'required',
                'paid' => 'required'
            ],
            [
                'fee_type.required' => 'Please select a fee type',
                'total.required' => 'Please enter total amount',
                'paid.required' => 'Please enter paid amount'
            ]
        );

        $feeType = FeeType::find($request->input('fee_type'));
        if (strstr($feeType->fee_type, 'Monthly')) {
            $request->validate(
                [
                    'selectMonth' => 'required',
                    'selectYear' => 'required',

                ],
                [
                    'selectMonth.required' => 'Please select month for fee',
                    'selectYear.required' => 'Please select year'
                ]
            );
        }
        $slip = FeeSlip::create([
            'student_id' => $id,
            'paid_amount' => $request->input('paid'),
            'total_amount' => $request->input('total')
        ]);


        if (!empty($slip)) {
            $fee = Fee::create([
                'student_id' => $id,
                'slip_id' => $slip->id,
                'fee_type' => $feeType->fee_type,
                'total_amount' => $request->input('total'),
                'paid_amount' => $request->input('paid'),
                'balance' => $request->input('balance'),
                'for_month' => $request->input('selectMonth'),
                'for_year' => $request->input('selectYear')
            ]);
        }

        return redirect()->route('students.viewFeeslip', [$slip->id]);
    }

    public function viewFees($id)
    {
        $student = Student::find($id);
        $fees = Fee::where('student_id', '=', $id)
            ->get();
        return view('students.fees.viewFees', [
            'fees' => $fees,
            'student' => $student
        ]);
    }

    public function viewFeeSlip($id)
    {
        // $student = Student::find($id);
        // $feeslip = FeeSlip::where('student_id', '=', $id)
        //     ->orderby('id', 'desc')
        //     ->first();
        $feeslip = FeeSlip::find($id);
        return view('students.fees.viewFeeslip', [
            'feeslip' => $feeslip
        ]);
    }

    public function createNewFee($id)
    {
        $slip = FeeSlip::find($id);
        $fee_types = FeeType::all();
        return view('students.fees.createNewFee', [
            'slip' => $slip,
            'fee_types' => $fee_types
        ]);
    }

    public function storeNewFee(Request $request, $id)
    {

        $request->validate(
            [
                'fee_type' => 'required',
                'total' => 'required',
                'paid' => 'required'
            ],
            [
                'fee_type.required' => 'Please select a fee type',
                'total.required' => 'Please enter total amount',
                'paid.required' => 'Please enter paid amount'
            ]
        );
        $feeType = FeeType::find($request->input('fee_type'));
        if (strstr($feeType->fee_type, 'Monthly')) {
            $request->validate(
                [
                    'selectMonth' => 'required',
                    'selectYear' => 'required',

                ],
                [
                    'selectMonth.required' => 'Please select month for fee',
                    'selectYear.required' => 'Please select year'
                ]
            );
        }
        $slip = FeeSlip::find($id);

        if (!empty($slip)) {
            Fee::create([
                'student_id' => $slip->student_id,
                'slip_id' => $slip->id,
                'fee_type' => $feeType->fee_type,
                'total_amount' => $request->input('total'),
                'paid_amount' => $request->input('paid'),
                'balance' => $request->input('balance'),
                'for_month' => $request->input('selectMonth'),
                'for_year' => $request->input('selectYear')
            ]);
            if (strstr($feeType->fee_type, 'Balance')) {

                $slip->paid_amount = $slip->paid_amount + $request->input('paid');
                // $slip->total_amount = $slip->total_amount + $request->input('total');
                $slip->save();
            } else {
                $slip->paid_amount = $slip->paid_amount + $request->input('paid');
                $slip->total_amount = $slip->total_amount + $request->input('total');
                $slip->save();
            }
        }

        return redirect()->route('students.viewFeeslip', [$slip->id])
            ->with('success', 'Record added successfully');
    }
}
