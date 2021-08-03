<?php

namespace App\Http\Controllers;

use App\Models\ProductMultipleImage;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ProductMultipleImageController extends Controller
{
	
	public function editMultiImages($product_id) {
		$product_multi_images = ProductMultipleImage::where('product_id', $product_id)->get();
		return view('products.edit_product_multi_image', compact('product_multi_images', 'product_id'));
	}		
	
	public function uploadImages(Request $request) {

		$product_multiple_image = ProductMultipleImage::where('product_id', $request->product_id);
		if($product_multiple_image->exists()) {
			$pmi = $product_multiple_image->latest('id')->first();
		 	$exploded_name = explode('.', $pmi['image']);
			$flag = $exploded_name[1] + 1;
		} else {
			$flag =  1;
		}

		if($request->hasFile('multi_images')) {
			foreach($request->multi_images as $single_image) {
				$images_name = $request->product_id.'.'.$flag.'.'.$single_image->extension();
				$single_image->move(public_path('uploads/product/product_details'), $images_name);
				ProductMultipleImage::insert([
					'product_id' => $request->product_id,
					'image' => $images_name,
					'created_at' => Carbon::now() 
				]);
				$flag++;
			}
		}
		return back()->with('images_add_success', 'Image added duccessfully!');
	}

	
	public function delete($id) {
		$product_multi_image = ProductMultipleImage::find($id);
		unlink(public_path('uploads/product/product_details/'.$product_multi_image->image));
		$product_multi_image->delete();
		return back()->with('multi_image_delete_success', 'Image deleted duccessfully!');
	}
}
