<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use Carbon\Carbon;

class CartController extends Controller
{
	public function addToCart(Request $request) {
		if(Product::find($request->product_id)->stock >= $request->quantity) {
			$cart = Cart::where('ip_address', $request->ip())->where('product_id', $request->product_id);
			
			if($cart->exists()) {
				$cart->update([
						'quantity' => $request->quantity
					]);
				return back()->with('add_to_cart_success', 'Quantity updated!');
			} else {
				Cart::insert([
					'product_id' => $request->product_id,
					'quantity' => $request->quantity,
					'ip_address' => $request->ip(),
					'created_at' => Carbon::now()
				]);
				return back()->with('add_to_cart_success', 'Quantity added to cart.');
			}
		} else {
			return back()->with('add_to_cart_fail', 'Out of stock.');
		}


	}

	public function updateCart(Request $request) {
		foreach($request->id as $key => $id) {
			Cart::find($id)->update([
				'quantity' => $request->quantity[$key]
			]);
		}
		return back();
	}

	public function deleteCartItem($id) {
		Cart::find($id)->delete();
		return back();
	}
}
