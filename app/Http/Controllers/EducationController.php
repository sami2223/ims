<?php

namespace App\Http\Controllers;

use App\Models\Education;
use Illuminate\Http\Request;

class EducationController extends Controller
{

    public function index()
    {
        $educationList = Education::all();
        return view('education.index', compact('educationList'));
    }

    public function create()
    {
        return view('education.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'education' => 'required|max:50|unique:education,education',
        ]);
        Education::create([
            'education' => $request->input('education')
        ]);
        return redirect()->back()->with('success', 'Record saved successfully');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $education = Education::find($id);
        return view('education.edit', compact('education'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'education' => 'required|max:50|unique:education,education,'. $id,
        ]);
        Education::where('id', $id)->update([
            'education'=> $request->input('education')
        ]);
        return redirect()->route('education.index')->with('success', 'Record updated successfully');
    }

    public function destroy($id)
    {
        $education = Education::find($id);
        $education->delete();
        return redirect()->back()->with('success', 'Record deleted successfully');
    }
}
