<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;

class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('events.index');
    }

    public function create()
    {
        
    }

    public function store(Request $request)
    {
        $request->validate([
            'event_type' => 'required',
            'title' => 'required',
            'selectDay' => 'required',
            'selectMonth' => 'required',
            'selectYear' => 'required',
        ]);

        $date_formated = "";
        if (!empty($request->input('selectDay')) && !empty($request->input('selectMonth')) && !empty($request->input('selectYear'))) {
            $e_date = $request->input('selectDay')
                . '-' . $request->input('selectMonth')
                . '-' . $request->input('selectYear');
            $date_formated = date('d-M-Y', strtotime($e_date));
        }

        Event::create([
            'event_type' => $request->input('event_type'),
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'start_date' => $date_formated,
            'created_by' => Auth::user()->id,
        ]);

        return redirect()->route('events.index')
        ->with('success', 'Record saved successfully');
    }

    
    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $event = Event::find($id);
        return view('events.edit', compact('event'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'event_type' => 'required',
            'title' => 'required',
            'selectDay' => 'required',
            'selectMonth' => 'required',
            'selectYear' => 'required',
        ]);

        $date_formated = "";
        if (!empty($request->input('selectDay')) && !empty($request->input('selectMonth')) && !empty($request->input('selectYear'))) {
            $e_date = $request->input('selectDay')
                . '-' . $request->input('selectMonth')
                . '-' . $request->input('selectYear');
            $date_formated = date('d-M-Y', strtotime($e_date));
        }

        Event::where('id', $id)->update([
            'event_type' => $request->input('event_type'),
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'start_date' => $date_formated,
            'created_by' => Auth::user()->id,
        ]);

        return redirect()->route('events.index')
        ->with('success', 'Record updated successfully');
    }

    public function destroy($id)
    {
        $event = Event::find($id);
        $event->delete();

        return redirect()->route('events.index')
        ->with('success', 'Record deleted successfully');
    }
}
