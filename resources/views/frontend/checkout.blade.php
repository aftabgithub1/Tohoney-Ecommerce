@extends('layouts.frontend')

@section('content')
<!-- .breadcumb-area start -->
<div class="breadcumb-area bg-img-4 ptb-100">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="breadcumb-wrap text-center">
					<h2>Checkout</h2>
					<ul>
						<li><a href="index.html">Home</a></li>
						<li><span>Checkout</span></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- .breadcumb-area end -->
<!-- checkout-area start -->
<div class="checkout-area ptb-100">
	<div class="container">
		<div class="row">
			<div class="col-lg-8">
				<div class="checkout-form form-style">
					<h3>Billing Details</h3>
					@php 
						$auth = Auth::user();
						$carts = App\Models\Cart::all();
					@endphp
					<form action="{{route('order')}}" method="post">
						@csrf
						<div class="row">
							<div class="col-sm-6 col-12">
								<p>First Name *</p>
								<input type="text" name="user_id" value="{{$auth->id ?? ''}} " hidden>
								<input type="text" name="name" value="{{$auth->name ?? ''}}">
							</div>
							<div class="col-sm-6 col-12">
								<p>Email Address *</p>
								<input type="email" name="email" value="{{$auth->email ?? ''}}">
							</div>
							<div class="col-sm-6 col-12">
								<p>Phone No. *</p>
								<input type="text" name="phone_no" value="{{$auth->phone_no ?? ''}}">
							</div>
							<div class="col-sm-6 col-12">
								<p>Country *</p>
								<input type="text" name="country" value="{{$auth->country ?? ''}}">
							</div>
							<div class="col-sm-6 col-12">
								<p>Postcode/ZIP</p>
								<input type="text" name="post_code" value="{{$auth->zip_code ?? ''}}">
							</div>
							<div class="col-sm-6 col-12">
								<p>Town/City *</p>
								<input type="text" name="city" value="{{$auth->city ?? ''}}">
							</div>
							<div class="col-12">
								<p>Your Address *</p>
								<input type="text" name="address" value="{{$auth->address ?? ''}}">
							</div>
							<div class="col-12">
								<p>Order Notes </p>
								<textarea name="order_notes" placeholder="Notes about Your Order, e.g.Special Note for Delivery"></textarea>
							</div>
						</div>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="order-area">
					<h3>Your Order</h3>
					<ul class="total-cost">
						@foreach($carts as $cart)
						<li>{{$cart->products->name}}<span class="pull-right">Tk. {{$cart->products->price}}</span></li>
						@endforeach
						<li>Subtotal <span class="pull-right"><strong>Tk. {{$subtotal}}</strong></span></li>
						<li>Discount at {{$discount}}%<span class="pull-right">Tk. {{$discount_price}}</span></li>
						<li>Shipping <span class="pull-right">Free</span></li>
						<li>Total<span class="pull-right">Tk. {{$total}}</span></li>
					</ul>
					<ul class="payment-method">
						<li>
							<input id="card" type="radio" name="payment" value="1">&nbsp;
							<label for="card">Credit Card</label>
						</li>
						<li>
							<input id="delivery" type="radio" name="payment" value="2">&nbsp;
							<label for="delivery">Cash on Delivery</label>
						</li>
					</ul>
					<input type="text" name="subtotal" value="{{$subtotal}}" hidden>
					<input type="text" name="discount" value="{{$discount_price}}" hidden>
					<input type="text" name="total" value="{{$total}}" hidden>
					<button type="submit">Place Order</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- checkout-area end -->
@endsection