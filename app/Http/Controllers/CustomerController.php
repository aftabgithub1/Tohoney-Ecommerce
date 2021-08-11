<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    public function __construct() {
		$this->middleware(['auth', 'verified']);
	}

	public function customerPanel() {
		return view('customer_panel');
	}


}
