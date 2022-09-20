<?php

namespace App\Http\Controllers;

use App\Models\Session;
use App\Models\Course;
use Illuminate\Http\Request;

class SessionsController extends Controller
{
    // Constructor
    public function __construct() 
    { 
        $this->middleware(['auth','preventBackHistory']);
        $this->middleware('permission:session-list|session-create|session-edit|session-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:session-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:session-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:session-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $sessions = Session::all();
        return view('sessions.index', ['sessions' => $sessions]);
    }

    public function create()
    {
        $courses = Course::all();
        return view('sessions.create', ['courses'=> $courses]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'session_name' => 'required'
        ],
        [
            'session_name.required' => 'Please input Session Name'
        ]);
        // Sub string from full string
        // $course = Course::find($request->input('selectCourse'));
        // $name = substr($course->course,0,3);
        // $full_name = $name.'-'.$request->input('session_name');
        Session::create([
            'course_id' => $request->input('selectCourse'),
            'session_name' => $request->input('session_name')
        ]);
        return redirect('sessions')->with('success', 'Record saved successfully');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $session = Session::where('id', '=', $id)
            ->first();

        return view('sessions.edit')->with('session', $session);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'session_name' => 'required'
        ],
        [
            'session_name.required' => 'Please input Session Name'
        ]);

        Session::where('id', $id)
            ->update([
                'session_name' => $request->input('session_name')
            ]);

        return redirect('sessions')->with('success', 'Record has been updated successfully');
    }

    public function destroy($id)
    {
        $session = Session::where('id', $id)
            ->first();
            foreach($session->batches as $batch)
            {
                $batch->delete();
            }
            $session->delete();
            return redirect('sessions')->with('success', 'Record has been deleted successfully');
    }
}
