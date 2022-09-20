<?php

namespace App\Http\Controllers;

use App\Models\AddFee;
use App\Models\Course;
use App\Models\CourseNames;
use App\Models\FeeType;
use App\Models\Shift;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeeTypesController extends Controller
{
    // Constructor
    public function __construct() 
    { 
        $this->middleware(['auth','preventBackHistory']);
        // $this->middleware('permission:fee-list|fee-create|fee-edit|fee-delete', ['only' => ['index', 'store']]);
        // $this->middleware('permission:fee-create', ['only' => ['create', 'store']]);
        // $this->middleware('permission:fee-edit', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:fee-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $fee_types = FeeType::all();
        return view('fee_types.index', ['fee_types' => $fee_types]);
    }

    public function create()
    {
        return view('fee_types.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'fee_type' => 'required|unique:fee_types'
        ],
        [
            'fee_type.required' => 'Please input fee_types name',
            'fee_type.unique' => 'Record already exists',
        ]);

        FeeType::create($request->all());
        return redirect('fee_types')->with('success', 'Record has been saved successfully');
    }

    public function add_fee()
    {
        $sessions = Course::all();
        $feetypes = FeeType::all();
        $courses = CourseNames::all();
        return view('fee_types.add_fee', compact(
            'sessions',
            'feetypes',
            'courses'
        ));
    }

    public function store_add_fee(Request $request)
    {
        $request->validate([
            'selectSession' => 'required',
            'selectFeetype' => 'required',
            'amount' => 'required',
        ]);

        AddFee::create([
            'course_id' => $request->input('selectSession'),
            'feetype_id' => $request->input('selectFeetype'),
            'amount' => $request->input('amount'),
            'created_by' => Auth::user()->id,
        ]);

        return redirect()->back()->with('success', 'Record saved successfully');

    }

    public function edit_add_fee($id)
    {
        $addFee = AddFee::find($id);
        return view('fee_types.edit_add_fee', compact('addFee'));
    }

    public function update_add_fee(Request $request, $id)
    {
        $request->validate([
            'amount' => 'required',
        ]);

        AddFee::where('id', $id)->update([
            'amount' => $request->input('amount'),
            'updated_by' => Auth::user()->id,
        ]);
        

        return redirect()->route('feetypes.addfee')->with('success', 'Record updated successfully');
    }

    public function delete_add_fee($id)
    {
        $addFee = AddFee::find($id);
        $addFee->delete();

        return redirect()->back()->with('success', 'Record deleted successfully');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $fee_type = FeeType::where('id', '=', $id)
            ->first();

        return view('fee_types.edit')->with('fee_type', $fee_type);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'fee_type' => 'required'
        ],
        [
            'fee_type.required' => 'Please input fee_type name'
        ]);

        FeeType::where('id', $id)
            ->update([
                'fee_type' => $request->input('fee_type')
            ]);

        return redirect('fee_types')->with('success', 'Record has been updated successfully');
    }

    public function destroy($id)
    {
        $fee_type = FeeType::where('id', $id)
            ->first();

            $fee_type->delete();
            return redirect('fee_types')->with('success', 'Record has been deleted successfully');
    }
}
