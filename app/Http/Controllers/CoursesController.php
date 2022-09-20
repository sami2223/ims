<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use App\Models\Batch;
use App\Models\Course;
use App\Models\CourseNames;
use App\Models\Designation;
use App\Models\Employee;
use App\Models\GradeSystem;
use Illuminate\Http\Request;

class CoursesController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'preventBackHistory']);
        $this->middleware('permission:course-list|course-create|course-edit|course-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:course-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:course-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:course-delete', ['only' => ['destroy']]);
    }


    public function index()
    {

        $courses = Course::all();

        return view(
            'courses.index',
            [
                'courses' => $courses
            ]
        );
    }


    public function create()
    {
        // $teachers[] = new Employee();
        $course_names = CourseNames::all();
        $designations = Designation::where('designation_name','like', '%Teacher%')->get();
        // dd(empty($designation));
        // if($designation != null){
        //     $teachers = Employee::where('designation_id', $designation->id)->get();
        // }
        // dd($designation);
        return view('courses.create', [
            'designations' => $designations,
            'course_names'=>$course_names
        ]);
    }


    public function store(Request $request)
    {
        $request->validate(
            [
                'course' => 'required',
                'duration' => 'required',
                'teacher' => 'required',
                'selectDaySD' => 'required',
                'selectMonthSD' => 'required',
                'selectYearSD' => 'required'
            ],
            [
                'course.required' => 'Course name cannot be blank',
                'duration.required' => 'Duration cannot be blank',
                'teacher.required' => 'Please select a teacher',
                'selectDaySD.required' => 'Please select Day of Start Date',
                'selectMonthSD.required' => 'Please select Month of Start Date',
                'selectYearSD.required' => 'Please select Year of Start Date',
            ]
        );

        $dur = $request->input('duration');
        $dur_type = $request->input('duration_type');
        $duration = $dur . ' ' . $dur_type;

        $sd_formated = "";
        $ed_formated = "";

        if ($request->input('selectMonthSD') > 0 && $request->input('selectDaySD') > 0 && $request->input('selectYearSD') > 0) {
            $startDate =  $request->input('selectMonthSD') .
                '/' . $request->input('selectDaySD') .
                '/' . $request->input('selectYearSD');

            // converting string to date formate
            $sd_formated = date('d-M-Y', strtotime($startDate));

            $day = $request->input('selectDaySD');
            $month = $request->input('selectMonthSD');
            $year = $request->input('selectYearSD');
            if($dur_type == 'Months')
            {
                $month = $month + $dur;
                $year = $year + ($month/12) ;
                $month = $month % 12;
                $c = $month/12;
                $year = (int)$year;
                $ed_formated = $month.'/'.$day.'/'.$year;
                // converting string to date formate
                $ed_formated = date('d-M-Y', strtotime($ed_formated));
                // dd($ed_formated);
            }
           
            else{
                $nod = $dur * 7;
                $nod = $day + $nod;
                $nom = (int)($nod/30);
                $day = $nod % 30;
                $month = $month + $nom;
                $year = $year + ($month/12) ;
                $month = $month % 12;
                $c = $month/12;
                $year = (int)$year;
                $ed_formated = $month.'/'.$day.'/'.$year;
                // converting string to date formate
                $ed_formated = date('d-M-Y', strtotime($ed_formated));
            }
            
            $courseName = CourseNames::find($request->input('course'));
            $course = $courseName->title.$request->input('selectMonthSD').$request->input('selectYearSD');
            
            Course::create([
                'course' => $course,
                'duration' => $duration,
                'start_date' => $sd_formated,
                'end_date' => $ed_formated,
                'teacher_id' => $request->input('teacher'),
                'course_id' => $request->input('course'),
            ]);
            return redirect('courses')->with('success', 'Record saved successfully');
        }

        return redirect()->back();  
    }

    public function show($id)
    {
        $course = Course::find($id);
        return View('courses.show')->with('course', $course);
    }

    public function edit($id)
    {
        $course_names = CourseNames::all();
        $course = Course::where('id', '=', $id)
            ->first();
        $designations = Designation::where('designation_name', 'like', '%Teacher%')->get();
        $currentTeacher = Employee::where('id', '=', $course->teacher_id)->first();
        // $result = preg_replace("/[^a-zA-Z]+/", "", $course->duration);
        // dd($result);
        return view('courses.edit', [
            'course_names'=>$course_names,
            'course' => $course,
            'designations' => $designations,
            'currentTeacher' => $currentTeacher
        ]);
    }

    public function update(Request $request, $id)
    {

        $request->validate(
            [      
                'duration' => 'required',
                'selectDaySD' => 'required',
                'selectMonthSD' => 'required',
                'selectYearSD' => 'required'
            ],
            [
                'duration.required' => 'Duration cannot be blank',
                'selectDaySD.required' => 'Please select Day of Start Date',
                'selectMonthSD.required' => 'Please select Month of Start Date',
                'selectYearSD.required' => 'Please select Year of Start Date',
            ]
        );

        $dur = $request->input('duration');
        $dur_type = $request->input('duration_type');
        $duration = $dur . ' ' . $dur_type;

        $sd_formated = "";
        $ed_formated = "";

        if ($request->input('selectMonthSD') > 0 && $request->input('selectDaySD') > 0 && $request->input('selectYearSD') > 0) {
            $startDate =  $request->input('selectMonthSD') .
                '/' . $request->input('selectDaySD') .
                '/' . $request->input('selectYearSD');

            // converting string to date formate
            $sd_formated = date('d-M-Y', strtotime($startDate));

            $day = $request->input('selectDaySD');
            $month = $request->input('selectMonthSD');
            $year = $request->input('selectYearSD');
            if($dur_type == 'Months')
            {
                $month = $month + $dur;
                $year = $year + ($month/12) ;
                $month = $month % 12;
                $c = $month/12;
                $year = (int)$year;
                $ed_formated = $month.'/'.$day.'/'.$year;
                // converting string to date formate
                $ed_formated = date('d-M-Y', strtotime($ed_formated));
                // dd($ed_formated);
            }           
            else{
                $nod = $dur * 7;
                $nod = $day + $nod;
                $nom = (int)($nod/30);
                $day = $nod % 30;
                $month = $month + $nom;
                $year = $year + ($month/12) ;
                $month = $month % 12;
                $c = $month/12;
                $year = (int)$year;
                $ed_formated = $month.'/'.$day.'/'.$year;
                // converting string to date formate
                $ed_formated = date('d-M-Y', strtotime($ed_formated));
            }
        }
        $updated = Course::where('id', $id)
            ->update([
                
                'duration' => $duration,
                'start_date' => $sd_formated,
                'end_date' => $ed_formated,
                'teacher_id' => $request->input('teacher')
            ]);

        return redirect('/courses')->with('success', "Record updated successfully...");
    }

    public function destroy($id)
    {
        $course = Course::where('id', $id)
            ->first();

        foreach($course->sessions as $session){
            foreach($session->batches as $batch){
                $batch->delete();
            }   
            $session->delete();
        }
        
        $course->delete();
        return redirect('courses')->with('success', 'Record has been deleted successfully');
    }



    public function createBatch($id)
    {
        $course = Course::find($id);
        $academicYears = AcademicYear::all();
        return view('courses.batches.createBatch', [
            'course' => $course,
            'academicYears' => $academicYears
        ]);
    }

    public function storeBatch(Request $request, $id)
    {
        $request->validate(
            [
                'batch_name' => 'required|unique:batches',
            ],
            [
                'batch_name.required' => 'Please enter batch name',
                'batch_name.unique' => 'Record already exists',
            ]
        );

        $startDate = $request->input('selectDaySD') .
            '/' . $request->input('selectMonthSD') .
            '/' . $request->input('selectYearSD');
        $sd_formated = date('d-M-Y', strtotime($startDate));

        $endDate = $request->input('selectDayED') .
            '/' . $request->input('selectMonthED') .
            '/' . $request->input('selectYearED');
        $ed_formated = date('d-M-Y', strtotime($endDate));

        Batch::create([
            'course_id' => $id,
            'batch_name' => $request->input('batch_name'),
            'start_date' => $sd_formated,
            'end_date' => $ed_formated,
            'academic_year' => $request->input('selectAcademicYear')
        ]);

        return redirect()->route('courses.show', [$id])->with('success', 'Record saved successfully');
    }

    public function editBatch($id)
    {
        $batch = Batch::find($id);
        $academicYears = AcademicYear::all();
        return view('courses.batches.editBatch', [
            'batch' => $batch,
            'academicYears' => $academicYears
        ]);
    }

    public function updateBatch(Request $request, $id)
    {
        $request->validate(
            [
                'batch_name' => 'required|unique:batches',
            ],
            [
                'batch_name.required' => 'Please enter batch name',
                'batch_name.unique' => 'Record already exists',
            ]
        );

        $startDate = $request->input('selectDaySD') .
            '/' . $request->input('selectMonthSD') .
            '/' . $request->input('selectYearSD');
        $sd_formated = date('d-M-Y', strtotime($startDate));

        $endDate = $request->input('selectDayED') .
            '/' . $request->input('selectMonthED') .
            '/' . $request->input('selectYearED');
        $ed_formated = date('d-M-Y', strtotime($endDate));

        Batch::where('id', $id)
            ->update([
                'batch_name' => $request->input('batch_name'),
                'start_date' => $sd_formated,
                'end_date' => $ed_formated,
                'academic_year' => $request->input('selectAcademicYear')
            ]);
        $batch = Batch::find($id);
        return redirect()->route('courses.show', [$batch->course_id])->with('success', 'Record updated successfully');
    }

    public function deleteBatch($id)
    {
    }
}
