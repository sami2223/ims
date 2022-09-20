<?php

namespace App\Http\Controllers;

use App\Models\Shift;
use Illuminate\Http\Request;

class ShiftsController extends Controller
{
    // Constructor
    public function __construct() 
    { 
        $this->middleware(['auth','preventBackHistory']);
        // $this->middleware('permission:shift-list|shift-create|shift-edit|shift-delete', ['only' => ['index', 'store']]);
        // $this->middleware('permission:shift-create', ['only' => ['create', 'store']]);
        // $this->middleware('permission:shift-edit', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:shift-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $shifts = Shift::all();
        return view('shifts.index', ['shifts' => $shifts]);
    }

    public function create()
    {
        return view('shifts.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'shift_name' => 'required|unique:shifts'
        ],
        [
            'shift_name.required' => 'Please input Shift Name',
            'shift_name.unique' => 'Record already exists',
        ]);

        Shift::create($request->all());
        return redirect('shifts')->with('success', 'Record has been saved successfully');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $shift = Shift::where('id', '=', $id)
            ->first();

        return view('shifts.edit')->with('shift', $shift);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'shift_name' => 'required'
        ],
        [
            'shift_name.required' => 'Please input shift Name'
        ]);

        Shift::where('id', $id)
            ->update([
                'shift_name' => $request->input('shift_name')
            ]);

        return redirect('shifts')->with('success', 'Record has been updated successfully');
    }

    public function destroy($id)
    {
        $shift = Shift::where('id', $id)
            ->first();

            $shift->delete();
            return redirect('shifts')->with('success', 'Record has been deleted successfully');
    }
}
