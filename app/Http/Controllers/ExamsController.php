<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseNames;
use Illuminate\Http\Request;
use App\Models\Exam;
use App\Models\ExamType;
use App\Models\Session;
use App\Models\Shift;
use App\Models\Student;
use App\Models\StudentExam;

class ExamsController extends Controller
{
    // Constructor
    public function __construct()
    {
        $this->middleware(['auth', 'preventBackHistory']);
        // $this->middleware('permission:exam-list|exam-create|exam-edit|exam-delete', ['only' => ['index', 'store']]);
        // $this->middleware('permission:exam-create', ['only' => ['create', 'store']]);
        // $this->middleware('permission:exam-edit', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:exam-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $exams = Exam::all();
        return view('exams.index', ['exams' => $exams]);
    }

    public function create()
    {
        $students = Student::all();
        $examTypes = ExamType::all();
        $sessions = Course::all();
        $shifts = Shift::all();
        $courses = CourseNames::all();
        return view('exams.create',
        [
            'examTypes' => $examTypes,
            'sessions' => $sessions,
            'shifts'=> $shifts,
            'courses'=>$courses,
            'students' => $students
        ]);
    }

    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'exam_type' => 'required',
                'studentid' => 'required'
            ],
            [
                'exam_type.required' => 'Please select Exam Type',
                'studentid.required' => 'Please select a student'
            ]
        );
        
        $examCreated = Exam::create([
            'exam_type_id' => $request->input('exam_type'),
            'course_id' => $request->input('selectCourse'),
            'shift_id' => $request->input('selectShift'),
            'session_id' => $request->input('selectSession')
            // 'description' => $request->input('description'),
            // 'exam_date' => $ed_formated
        ]);

        if ($examCreated && count($request->studentid) > 0) {
            $id = $examCreated->id;
            
            foreach ($request->studentid as $key => $student_id) {
                $data = array(
                    'exam_id' => $id,
                    'student_id' => $request->studentid[$key],
                );
                
                StudentExam::insert($data);
            }
        }
        return redirect('exams')->with('success', 'Record has been saved successfully');
    }

    public function show($id)
    {
        $exam = Exam::where('id', $id)->first(); 
        // dd($exam->Students);      
        return view('exams.show',[
            'exam' => $exam
        ]);
    }

    public function edit($id)
    {
        $exam = Exam::where('id', '=', $id)
            ->first();
        $examTypes = ExamType::all();
        return view('exams.edit',[
            'examTypes' => $examTypes,
            'exam' => $exam
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->validate(
            $request,
            [
                'exam_type' => 'required'
            ],
            [
                'exam_type.required' => 'Please select Exam Type',
            ]
        );
        $ed_formated = "";
        if(!empty($request->input('selectDay')) && !empty($request->input('selectMonth')) && !empty($request->input('selectYear')))
        {
            $ed = $request->input('selectDay')
            . '-' . $request->input('selectMonth')
            . '-' . $request->input('selectYear');
            $ed_formated = date('d-M-Y', strtotime($ed));
        }

        Exam::where('id', $id)
            ->update([
                'exam_type_id' => $request->input('exam_type'),
                'description' => $request->input('description'),
                'exam_date' => $ed_formated
            ]);

        return redirect('exams')->with('success', 'Record has been updated successfully');
    }

    public function destroy($id)
    {
        $exam = Exam::where('id', $id)
            ->first();

        $exam->delete();
        return redirect('exams')->with('success', 'Record has been deleted successfully');
    }

    public function showStudentExams($id)
    {
        $student = Student::find($id);
        $student_exams = StudentExam::where('student_id', $id)->get();
        return view('exams.showStudentExams',[
            'student' => $student
        ]);
    }
}
