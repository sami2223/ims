<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Designation;

class DesignationsController extends Controller
{
    // Constructor
    public function __construct() 
    { 
        $this->middleware(['auth','preventBackHistory']);
        // $this->middleware('permission:designation-list|designation-create|designation-edit|designation-delete', ['only' => ['index', 'store']]);
        // $this->middleware('permission:designation-create', ['only' => ['create', 'store']]);
        // $this->middleware('permission:designation-edit', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:designation-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $designations = Designation::all();
        return view('designations.index', ['designations' => $designations]);
    }

    public function create()
    {
        return view('designations.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'designation_name' => 'required|unique:designations'
        ],
        [
            'designation_name.required' => 'Please input Designation Name',
            'designation_name.unique' => 'Record already exists',
        ]);

        Designation::create($request->all());
        return redirect('designations')->with('success', 'Record has been saved successfully');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $designation = Designation::where('id', '=', $id)
            ->first();

        return view('designations.edit')->with('designation', $designation);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'designation_name' => 'required'
        ],
        [
            'designation_name.required' => 'Please input designation Name'
        ]);

        Designation::where('id', $id)
            ->update([
                'designation_name' => $request->input('designation_name')
            ]);

        return redirect('designations')->with('success', 'Record has been updated successfully');
    }

    public function destroy($id)
    {
        $designation = Designation::where('id', $id)
            ->first();

            $designation->delete();
            return redirect('designations')->with('success', 'Record has been deleted successfully');
    }
}
