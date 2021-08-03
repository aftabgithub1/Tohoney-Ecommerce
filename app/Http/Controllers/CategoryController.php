<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;

class CategoryController extends Controller
{
    public function __construct() {
        $this->middleware(['auth', 'verified']);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('products.category', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.add_category');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories',
            'image' => 'image|mimes:jpg,jpeg,png,gif,svg|max:2048'
        ]);
        
        $category_id = Category::insertGetId([
            'name' => $request->name,
            'user_id' => Auth::id(),
            'created_at' => Carbon::now()
        ]);
        /* Uploding image */
        if($request->hasFile('image')) {
            $image_name = $category_id.'.'.$request->image->extension();
            $request->image->move(public_path('uploads/category'), $image_name);
            Category::find($category_id)->update([
                'image' => $image_name
            ]);
        }
    
        return back()->with('category_add_success', 'Category added Successfully!');

        /* Alternative way

            Category::insert($request->except('_token') + [
                'added_by' => Auth::id(),
                'created_at' => Carbon::now()
            ]);
        
            or,

            Category::create([
                'category_name' => $request->category_name,
                'added_by' => Auth::id(),
                'created_at' => Carbon::now()
            ]);

            or,

            Category::insert([
                'category_name' => $request->category_name,
                'added_by' => Auth::id(),
                'created_at' => Carbon::now()
            ]);

        */

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('products.edit_category', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            // 'name' => 'required|unique:categories',
            'image' => 'image|mimes:jpg,jpeg,png,gif,svg|max:2048'
        ]);
        
        $category->name = $request->name;

        if($request->hasFile('image')) {
            if($category->image != 'default_image.png'){
                unlink(public_path('uploads/category/'.$category->image));
            }
            $image_name = time().'.'.$request->image->extension();
            $request->image->move(public_path('uploads/category/'), $image_name);
            $category->image = $image_name;
        }

        $category->save();
        return back()->with('category_edit_success', 'Category updated Successfully.');

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if(Product::where('category_id', $category->id)->count() > 0) {
            return back()->with('delete_warning', 'Categoty cannot be deleted if a single product listed in this category.');
        } else {
            $category->delete();
            return back()->with('delete_success', 'Categoty deleted successfully.');
        }
    }
}
