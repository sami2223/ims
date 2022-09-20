<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GradeSystem;

class GradeSystemController extends Controller
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
        $gradeSystems = GradeSystem::all();

        return view('gradeSystems.index', 
        [
            'gradeSystems' => $gradeSystems
        ]);
    }

    public function create()
    {
        return view('gradeSystems.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'gradeSystem' => 'required'
        ],
        [
            'gradeSystem.required' => 'Please input Academic Year'
        ]);
        GradeSystem::create([
            'grade_system' => $request->input('gradeSystem')
        ]);

        return redirect('gradeSystems')->with('success', 'Grade System Inserted Successfully');
    }

    public function edit($id)
    {
        $gradeSystem = GradeSystem::find($id);

        return view('gradeSystems.edit')->with('gradeSystem', $gradeSystem);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'gradeSystem' => 'required'
        ],
        [
            'gradeSystem.required' => 'Please input Academic Year'
        ]);

        GradeSystem::find($id)
            ->update([
                'grade_system' => $request->input('gradeSystem')
            ]);

        return redirect('gradeSystems')->with('success', 'Record updated successfully');
    }

    public function destroy($id)
    {
        $gradeSystem = GradeSystem::find($id);
        $gradeSystem->delete();
        return redirect('gradeSystems')->with('success', 'Record deleted successfully');
    }

}
