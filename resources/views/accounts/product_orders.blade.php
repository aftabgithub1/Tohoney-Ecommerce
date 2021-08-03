@extends('layouts.accounts')

@section('product_orders')
Product Orders - 
@endsection

@section('product_orders')
active
@endsection

@section('content')
<div class="container">
  <h1>Product Orders</h1>
  <div class="row justify-content-center">
    <div class="col-lg-12 pl-2">
      <div class="card">
        <div class="card-body">
          @if(session('delete_warning'))
            <div class="alert alert-success mt-4">
            <strong>Warning ! </strong>{{ session('delete_warning') }}
            </div>
          @endif
          
          @if(session('delete_success'))
            <div class="alert alert-success mt-4">
              <strong>Success ! </strong>{{ session('delete_success') }}
            </div>
          @endif
          <table class="table mt-4">
            <tr>
              <th>#</th>
              <th>Order ID</th>
              <th>Name</th>
              <th>Email</th>
              <th>Amount</th>
              <th>Payment Method</th>
              <th></th>
            </tr>
            @forelse($product_orders as $index => $product_order)
            <tr>
              <td>{{ $index + 1}}</td>
              <td>{{ $product_order->id }}</td>
              <td>{{ $product_order->name }}</td>
              <td>{{ $product_order->email}}</td>
              <td>Tk. {{ $product_order->total}}</td>
              <td>{{ $product_order->payment == 1 ? 'Credit Card' : 'Cash'}}</td>
              <td class="text-right">
                <div class="dropleft">
                  <a class="btn btn-sm btn-secondary" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <!-- <i data-feather="settings"></i> -->
                    Options
                  </a>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="{{route('order_invoice', $product_order->id)}}">View Invoice</a>
                    <a class="dropdown-item" href="">Delete</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-success" href="{{route('order_pdf', $product_order->id)}}">Download PDF</a>
                  </div>
                </div>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan=5 class="text-center">
                <h4 class="text-danger">No data available!</h4>
              </td>
            </tr>
            @endforelse
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection