<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\Faq;
use App\Models\Cart;
use App\Models\Coupon;
use Carbon\Carbon;
use Auth;

class FrontendController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function home() {
        $categories = Category::all();
        $products = Product::all();
        return view('frontend.index', compact('categories', 'products'));
    }

    public function contact() {
        return view('frontend.contact');
    }

    public function faq() {
        $faqs = Faq::all();
        return view('frontend.faq', compact('faqs'));
    }

    public function cart() {
        $carts = Cart::all();
        return view('frontend.cart', compact('carts'));
        
    }
    
    public function apllyCoupon($coupon_name = '') {
        $coupon = Coupon::where('name', $coupon_name);
        if($coupon->exists()) {
            if(Carbon::now() < $coupon->first()->expiry_date) {
                $discount = $coupon->first()->discount / 100;
                return view('frontend.cart', compact('discount'));
            } else {
                return back()->with('no_coupon_available', 'Your coupon validity has been expired! Try new one.');
            }
        } else {
            return back()->with('no_coupon_available', 'Invalid coupon code! Please, enter a valid coupon code.');
        }
    }

    public function checkout(Request $request) { 
        $auth = Auth::user();
        $carts = Cart::all();
        return view('frontend.checkout', $request->all());
    }


    public function shop() {
        $products = Product::all();
        $categories = Category::all();
        return view('frontend.shop', compact('products', 'categories'));
    }


}
