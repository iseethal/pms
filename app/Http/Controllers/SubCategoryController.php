<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::where('status',1)->pluck('id');

        $sub_categories = SubCategory::with('category')->where('status',1)->whereIn('category_id',$categories)->get();

        return view('sub_category.index', compact('sub_categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('status',1)->get();

        return view('sub_category.create', compact('categories'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        SubCategory::create([

            'category_id' => $request->category_id,
            'sub_category_name' => $request->sub_category_name,
            'status' => $request->status,

        ]);

        return redirect()->route('sub-category.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $sub_category = SubCategory::findOrFail($id);
        $categories = Category::where('status',1)->get();

        return view('sub_category.edit', compact('sub_category','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        SubCategory::findOrFail($id)->update([

            'category_id' => $request->category_id,
            'sub_category_name' => $request->sub_category_name,
            'status' => $request->status,

        ]);

        return redirect()->route('sub-category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $sub_category = Subcategory::findOrFail($id);
        $sub_category->delete();
        // return redirect()->back();
        return response()->json(['success'=>'removed']);
    }
}
