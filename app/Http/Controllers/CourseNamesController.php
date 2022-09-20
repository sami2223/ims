<?php

namespace App\Http\Controllers;

use App\Models\CourseNames;
use Illuminate\Http\Request;

class CourseNamesController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'preventBackHistory']);
        
    }

    public function index()
    {
        $course_names = CourseNames::all();
        return view('courses.courseNames.index',[
            'course_names'=>$course_names
        ]);
    }

    public function create()
    {
        
        return view('courses.courseNames.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|unique:course_names',
            'code' => 'required|unique:course_names'
        ]);
        CourseNames::create($request->all());
        return redirect()
            ->route('courseNames.index')
            ->with('success', 'Record saved successfully');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $course_name = CourseNames::find($id);
        return view('courses.courseNames.edit',[
            'course_name'=>$course_name
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|unique:course_names,title,'.$id,
            'code' => 'required|unique:course_names,code,'.$id
        ]);
        $courseNames = CourseNames::find($id);
        $courseNames->update($request->all());
        return redirect()
            ->route('courseNames.index')
            ->with('success', 'Record updated successfully');
    }

    public function destroy($id)
    {
        $course = CourseNames::where('id', $id)
            ->first();

        $course->delete();
        return redirect('courseNames')->with('success', 'Record deleted successfully');
    }
}
