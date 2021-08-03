<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductMultipleImage;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ProductController extends Controller
{
	public function __construct() {
		$this->middleware(['auth', 'verified'])->except(['show']);
	}


	public function index()
	{
		$products = Product::orderBy('name', 'asc')->get();
		return view('products.product', compact('products'));
	}


	public function create()
	{
		return view('products.add_product');
	}


	public function store(Request $request)
	{
		$request->validate([
			'category_id' => 'required',
			'name' => 'required',
			'price' => 'required',
			'thumbnail' => 'image|mimes:jpg,jpeg,png,gif,svg|max:2048'
		]);
		
		$product_slug = str_replace(' ', '_', $request->name).'_'.time();

		$product_id = Product::insertGetId($request->except('_token') + [
			'thumbnail' => 'default_image.png',
			'slug' => $product_slug,
			'created_at' => Carbon::now()
		]);

		if($request->hasFile('thumbnail')) {
			$thumbnail_name = $product_id.'.'.$request->thumbnail->extension();
			$request->thumbnail->move(public_path('uploads/product'), $thumbnail_name);
			Product::find($product_id)->update([
				'thumbnail' => $thumbnail_name
			]);
		}
		
		if($request->hasFile('multi_images')) {
			$flag =  1;
			foreach($request->multi_images as $single_image) {
				$images_name = $product_id.'.'.$flag.'.'.$single_image->extension();
				$single_image->move(public_path('uploads/product/product_details'), $images_name);
				ProductMultipleImage::insert([
					'product_id' => $product_id,
					'image' => $images_name,
					'created_at' => Carbon::now() 
				]);
				$flag++;
			}
		}
		return back()->with('product_add_success', 'Product added successfully!');
	}

	public function show($slug)
	{
		$product_details = Product::where('slug', $slug)->first();
		$related_products = Product::where('category_id', $product_details->category_id)->get();
		return view('frontend.single-product', compact('product_details', 'related_products'));
	}


	public function edit(Product $product)
	{
		return view('products.edit_product', compact('product'));
	}


	public function update(Request $request, Product $product)
	{
			$request->validate([
				'thumbnail' => 'image|mimes:jpg,jpeg,png,gif,svg|max:2048'
			]);

			$product->category_id = $request->category_id;
			$product->name = $request->name;
			$product->price = $request->price;
			$product->short_desp = $request->short_desp;
			$product->long_desp = $request->long_desp;
			$product->slug = str_replace(' ', '_', $request->name).'_'.Carbon::now()->timestamp;
		
		if($request->hasFile('thumbnail')) {
			if($product->thumbnail != 'default_image.png') {
				unlink(public_path('uploads/product/'.$product->thumbnail));
			}
			$thumbnail_name = $product->id.'.'.$request->thumbnail->extension();
			$request->thumbnail->move(public_path('uploads/product'), $thumbnail_name);
			$product->thumbnail = $thumbnail_name;
		}

		$product->save();
		return back()->with('product_edit_success', 'Product added successfully!');
	}

	
	public function destroy(Product $product)
	{
		foreach($product->productMultipleImage as $product_multiple_image) {
			unlink(public_path('uploads/product/product_details/').$product_multiple_image->image);
		}
		unlink(public_path('uploads/product/').$product->thumbnail);
		$product->delete();
		return back()->with('product_delete_success', 'Product deleted successfully.');
	}
}
