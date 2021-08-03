<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderList;
use Carbon\Carbon;
use Session;
use Stripe;

class StripePaymentController extends Controller
{
	public function stripePost(Request $request)
	{
		Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
		Stripe\Charge::create ([
			"amount" => round($request->total / 83) * 100,
			"currency" => "usd",
			"source" => $request->stripeToken,
			"description" => "Test payment from itsolutionstuff.com." 
		]);
  
		Session::flash('success', 'Payment successful!');
		  
		$order_id = Order::insertGetId($request->except('_token', 'stripeToken') + ['created_at' => Carbon::now()]);
			
			$carts = Cart::where('ip_address', request()->ip());
			foreach($carts->get() as $cart) {
				OrderList::insert([
					'order_id' => $order_id,
					'product_id' => $cart->product_id,
					'quantity' => $cart->quantity,
					'created_at' => Carbon::now()
				]);
				$cart->delete();
				Product::find($cart->product_id)->decrement('stock', $cart->quantity);
			}
			return redirect(url('cart'))->with('order_success', 'Order placed successfully.');
	}
}
