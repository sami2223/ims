<?php

namespace App\Http\Controllers;

use App\Models\CertType;
use Illuminate\Http\Request;

class CertTypeController extends Controller
{
    
    public function index()
    {
        $certTypes = CertType::all();
        return view('certificates.certTypes.index', compact('certTypes'));
    }

    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'certType' => 'required|unique:cert_types,cert_type'
        ]);
        CertType::create([
            'cert_type'=>$request->input('certType')
        ]);

        return redirect()->back()->with('success', 'Record saved successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CertType  $certType
     * @return \Illuminate\Http\Response
     */
    public function show(CertType $certType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CertType  $certType
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $certType = CertType::where('id',$id)->first();
        return view('certificates.certTypes.edit', compact('certType'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'certType' => 'required|unique:cert_types,cert_type,'. $id
        ]);
        CertType::where('id', $id)->update([
            'cert_type'=>$request->input('certType')
        ]);

        return redirect()->route('certTypes.index')->with('success', 'Record updated successfully');
    }

    public function destroy($id)
    {
        $certType = CertType::where('id',$id)->first();
        $certType->delete();
        return redirect()->route('certTypes.index')->with('success', 'Record deleted successfully');

    }
}
