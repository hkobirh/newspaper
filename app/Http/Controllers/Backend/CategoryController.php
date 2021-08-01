<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use MongoDB\Driver\Session;
use Exception;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::select('id', 'name', 'slug', 'status')->get();
        return view('backend.category.manage', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::select('id', 'name', 'slug', 'status')->get();
        return view('backend.category.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'   => 'required|unique:categories',
            'slug'   => 'required',
            'status' => 'required'
        ]);
        Category::create([
            'name'    => $request->name,
            'slug'    => slugify($request->slug),
            'status'  => $request->status,
            'user_id' => auth()->user()->id,
        ]);

        Session()->flash('success', 'Category created successfully.');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        $categories = Category::select('id', 'name', 'slug', 'status')->get();
        return view('backend.category.edit', compact('categories', 'category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        $request->validate([
            'name'   => 'required|unique:categories,name,'.$category->id,
            'slug'   => 'required',
            'status' => 'required'
        ]);
        try {
            $category->name = $request->name;
            $category->slug = slugify($request->slug);
            $category->status = $request->status;
            $category->user_id = auth()->user()->id;
            $category->update();

            Session()->flash('success', 'Category updated successfully.');

        } catch (Exception $e) {
            Session()->flash('error', 'Category not updated.');
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();
        Session()->flash('error', 'Category delete successfully.');
        return redirect()->back();
    }
}
