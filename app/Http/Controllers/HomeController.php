<?php

namespace App\Http\Controllers;

use App\Models\CourseNames;
use App\Models\Designation;
use App\Models\Employee;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware(['auth', 'preventBackHistory']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $students = Student::all();
        $courses = CourseNames::all();
        $users = User::where('is_admin', 1)->get();
        $designations = Designation::where('designation_name', 'like', '%teacher%')->get();
        
        // Chart Data
        $data = Student::select('id', 'created_at')->orderBy('created_at','asc')->get()->groupBy(function($data){
            return Carbon::parse($data->created_at)->format('M');
        });
        $months=[];
        $monthsCount=[];
        foreach ($data as $month => $values) {
            $months[]=$month;
            $monthsCount[]=count($values);
        }
        // Chart Data End

        return view('home', compact('students', 'courses', 'users', 'designations', 'months', 'monthsCount'));
    }

    public function form()
    {
        return view('form');
    }
}
