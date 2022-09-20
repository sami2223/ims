<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Batch;
use App\Models\CourseNames;
use App\Models\Shift;
use Illuminate\Http\Request;

class BatchesController extends Controller
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
        $batches = Batch::all();
        return view('courses.batches.index',[
            'batches' => $batches
        ]);
    }

    public function create()
    {
        $courses = CourseNames::all();
        $shifts = Shift::all();
        return view('courses.batches.create', compact('courses', 'shifts'));
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate(
            [
                'batch_name' => 'required'
            ],
            [
                'batch.required' => 'Please enter batch name',
            ]
        );
        
        Batch::create([
            'batch_name' => $request->input('batch_name'),
        ]);

        return redirect('batches')->with('success', 'Record saved successfully');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $batch = Batch::where('id', '=', $id)
            ->first();

        return view('courses.batches.edit', compact('batch'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate(
            [
                'batch_name' => 'required|unique:batches,batch_name,'. $id
            ],
            [
                'batch_name.required' => 'Please enter batch name',
            ]
        );
        $batchName = $request->input('batch_name');

        Batch::where('id', $id)
            ->update([
                'batch_name' => $batchName,
            ]);

        return redirect('batches')->with('success', 'Record has been updated successfully');
    }

    public function destroy($id)
    {
        $batch = Batch::where('id', $id)
            ->first();

            $batch->delete();
            return redirect('batches')->with('success', 'Record has been deleted successfully');
    }
}
