<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExamType;

class ExamTypesController extends Controller
{
    // Constructor
    public function __construct() 
    { 
        $this->middleware(['auth','preventBackHistory']);
        // $this->middleware('permission:examType-list|examType-create|examType-edit|examType-delete', ['only' => ['index', 'store']]);
        // $this->middleware('permission:examType-create', ['only' => ['create', 'store']]);
        // $this->middleware('permission:examType-edit', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:examType-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $examTypes = ExamType::all();
        return view('exam_types.index', ['examTypes' => $examTypes]);
    }

    public function create()
    {
        return view('exam_types.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'type' => 'required|unique:exam_types'
        ],
        [
            'type.required' => 'Please input Exam Type',
            'type.unique' => 'Record already exists',
        ]);
        // dd($validatedData, $request->all());
        ExamType::create($request->all());
        return redirect('examTypes')->with('success', 'Record has been saved successfully');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $examType = ExamType::where('id', '=', $id)
            ->first();

        return view('exam_types.edit')->with('examType', $examType);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'type' => 'required|unique:exam_types,type,'.$id
        ],
        [
            'type.unique' => 'Record already exists',
            'type.required' => 'Please input Exam Type'
        ]);

        ExamType::where('id', $id)
            ->update([
                'type' => $request->input('type')
            ]);

        return redirect('examTypes')->with('success', 'Record has been updated successfully');
    }

    public function destroy($id)
    {
        $examType = ExamType::where('id', $id)
            ->first();

        foreach($examType->Exams as $exam)
        {
            $exam->delete();
        }
        $examType->delete();
        return redirect('examTypes')->with('success', 'Record has been deleted successfully');
    }
}
