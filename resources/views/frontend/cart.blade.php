@extends('layouts.frontend')

@section('content')
<!-- .breadcumb-area start -->
<div class="breadcumb-area bg-img-4 ptb-100">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="breadcumb-wrap text-center">
					<h2>Shopping Cart</h2>
					<ul>
						<li><a href="index.html">Home</a></li>
						<li><span>Shopping Cart</span></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- .breadcumb-area end -->
<!-- cart-area start -->
<div class="cart-area ptb-100">
	<div class="container">
		<div class="row">
			<div class="col-12">
				@if(session('order_success'))
					<div class="alert alert-success text-success border-0 rounded-0">
						<strong>Success ! </strong>{{session('order_success')}}
					</div>
				@endif
				@if(session('no_coupon_available'))
					<div class="alert alert-danger text-danger border-0 rounded-0">
						<strong>Warning ! </strong>{{session('no_coupon_available')}}
					</div>
				@endif
				@php
					$carts = App\Models\Cart::where('ip_address', request()->ip())->get();
				@endphp
					<table class="table-responsive cart-wrap">
						<thead>
							<tr>
								<th class="images">Image</th>
								<th class="product">Product</th>
								<th class="ptice">Price</th>
								<th class="quantity">Quantity</th>
								<th class="total">Total</th>
								<th class="remove">Remove</th>
							</tr>
						</thead>
 						
						<tbody>
							@php
								$carts = App\Models\Cart::where('ip_address', request()->ip())->get();
								$subtotal = 0;
							@endphp
							@foreach($carts as $cart)
							<form action="{{route('update_cart')}}" method="post">
							@csrf
							<tr>
								<td class="images"><img src="{{asset('uploads/product/'.$cart->products->thumbnail)}}" alt=""></td>
								<td class="product"><a href="single-product.html">{{$cart->products->name}}</a></td>
								<td class="ptice">Tk. {{$cart->products->price}}</td>
								<input type="number" name="id[]" value="{{$cart->id}}" hidden />
								<td class="quantity cart-plus-minus">
									<input type="text" name="quantity[]" value="{{$cart->quantity}}" />
								</td>
								<td class="total">Tk. {{$cart->products->price * $cart->quantity}}</td>
								<td class="remove"><a href="{{url('delete_cart_item/'.$cart->id)}}"><i class="fa fa-times"></i></a></td>
							</tr>
							@php
								$subtotal += $cart->products->price * $cart->quantity;
							@endphp
							@endforeach
						</tbody>
					</table>
					<div class="row mt-60">
						<div class="col-xl-4 col-lg-5 col-md-6 ">
							<div class="cartcupon-wrap">
								<ul class="d-flex">
									<li><button type="submit">Update Cart</button></li>
									</form>
									<li><a href="{{url('shop')}}">Continue Shopping</a></li>
								</ul>
								<h3>Cupon</h3>
								<p>Enter Your Cupon Code if You Have One</p>
								<div class="cupon-wrap">
										<input id="coupon_name" type="text" name="name">
										<button id="coupon_btn">Apply Cupon</button>
								</div>
							</div>
						</div>
						<div class="col-xl-3 offset-xl-5 col-lg-4 offset-lg-3 col-md-6">
							<div class="cart-total text-right">
								<h3>Cart Totals</h3>
								@php 
									$total = isset($discount) ? ($subtotal * (1 - $discount)) : $subtotal;
									$discount_price = isset($discount) ?  $subtotal * $discount : 0;
									$discount = isset($discount) ? $discount * 100 : 0;
								@endphp
								<ul>
									<li><span class="pull-left">Subtotal </span>TK. {{ $subtotal }}</li>
									<li><span class="pull-left"> Total </span>TK. {{ $total }}</li>
								</ul>
								
								<form action="{{route('checkout')}}" method="post">
									@csrf
									<input type="number" name="subtotal" value="{{$subtotal}}" hidden>
									<input type="number" name="total" value="{{$total}}" hidden>
									<input type="number" name="discount" value="{{$discount}}" hidden>
									<input type="number" name="discount_price" value="{{$discount_price}}" hidden>
									<a><button type="submit" class="bg-transparent border-0 text-light">{{__('Proceed to Checkout')}}</button></a>
								</form>
							</div>
						</div>
					</div>
			</div>
		</div>
	</div>
</div>
<!-- cart-area end -->
@endsection

@section('script')
<script>
	$(document).ready(function() {
		$('#coupon_btn').click(function() {
			var coupon_name = $('#coupon_name').val();
			window.location.href = '{{url('cart')}}' + '/' + coupon_name;
		});
	});
</script>
@endsection