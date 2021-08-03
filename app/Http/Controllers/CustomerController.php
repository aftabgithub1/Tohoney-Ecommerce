<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class CustomerController extends Controller
{
    public function __construct() {
		$this->middleware(['auth', 'verified']);
	}

	public function customerPanel() {
		return view('customer_panel');
	}

	public function productOrders() {
		$product_orders = Order::all();
		return view('accounts.product_orders', compact('product_orders'));
	}

}
