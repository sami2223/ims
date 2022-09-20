<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Symfony\Component\Console\Input\Input;

class CategoriesController extends Controller
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
        $categories = Category::all();

        return view('categories.index', 
        [
            'categories' => $categories
        ]);
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        Category::create([
            'title' => $request->input('title'),
            'description' => $request->input('description')
        ]);

        return redirect('categories')->with('success', 'Category Inserted Successfully');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $category = Category::where('id', '=', $id)
            ->first();
            
        return view('categories.edit')->with('category', $category);

    }


    public function update(Request $request, $id)
    {
        Category::where('id',$id)
        ->update([
            'title' => $request->input('title'),
            'description' => $request->input('description')
        ]);

        return redirect('/categories')->with('success', "Record updated successfully...");
    }

    public function destroy($id)
    {
        $cat = Category::where('id', '=', $id)
            ->first();

        $cat->delete();

        return redirect('/categories');
    }
}
