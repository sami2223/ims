<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Category;

class ApplicantsController extends Controller
{
    // constructor
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
        
    }

    public function create()
    {
        // Fetch categories
        $categories = Category::all();

        // Fetch courses
        $courses = Course::all();

        // Load create view
        return view('applicants.create', [
            'categories' => $categories,
            'courses' => $courses
        ]);
        
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Applicant $applicant)
    {
        //
    }

  
    public function edit(Applicant $applicant)
    {
        //
    }

 
    public function update(Request $request, Applicant $applicant)
    {
        //
    }

    public function destroy(Applicant $applicant)
    {
        //
    }
}
