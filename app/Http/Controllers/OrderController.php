<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\Cart;
use App\Models\OrderList;
use Carbon\Carbon;
use Auth;
use PDF;

class OrderController extends Controller
{
	public function __construct() {
		$this->middleware(['auth', 'verified']);
	}

	public function order(Request $request) {
		if($request->payment == 1) {
			return view('stripe', $request->all());
		} else {
			$order_id = Order::insertGetId($request->except('_token') + ['created_at' => Carbon::now()]);
			
			$carts = Cart::where('ip_address', request()->ip());
			foreach($carts->get() as $cart) {
				OrderList::insert([
					'user_id' => Auth::user()->id,
					'order_id' => $order_id,
					'product_id' => $cart->product_id,
					'quantity' => $cart->quantity,
					'review' => $cart->review,
					'star' => $cart->star,
					'created_at' => Carbon::now()
				]);
				$cart->delete();
				Product::find($cart->product_id)->decrement('stock', $cart->quantity);
			}
			return redirect(url('cart'))->with('order_success', 'Order placed successfully.');
		}
	}

	public function orderInvoice($id) {
		$order = Order::find($id);
		return view('frontend.order_invoice', compact('order'));
	}

	public function orderPdf($id) {
		$order = Order::find($id);
		$order_pdf = PDF::loadView('frontend.order_invoice', compact('order'));
		$order_pdf_file = 'Order-'.$id.'_'.Carbon::now()->format('d-m-Y-H-i-s').'.pdf';
    return $order_pdf->download($order_pdf_file);
	}

	public function sendSms($id) {
		$order = Order::find($id);
		$url = "http://66.45.237.70/api.php";
		$number= $order->phone_no;
		$text="Order ID: $order->id, Total Payment: $order->total <br> Your payment received successfully!";
		$data= array(
		'username'=>"UserName",
		'password'=>"******",
		'number'=>"$number",
		'message'=>"$text"
		);

		$ch = curl_init(); // Initialize cURL
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$smsresult = curl_exec($ch);
		$p = explode("|",$smsresult);
		$sendstatus = $p[0];
		if($sendstatus == 1101) {
			return back()->with('sms_sent_success', 'SMS sent successfully!');
		}
	}

}
