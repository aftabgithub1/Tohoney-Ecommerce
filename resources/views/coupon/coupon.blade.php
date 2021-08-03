@extends('layouts.accounts')

@section('page_title')
Coupon - 
@endsection

@section('coupon')
active
@endsection

@section('content')
<div class="container">
  <h1>Coupon</h1>
  <div class="row justify-content-center">
    <div class="col-lg-12 pl-2">
      <div class="card">
        <div class="card-header">Coupon Table<span class="float-right"><a href="{{route('coupon.create')}}" class="btn btn-danger">Add Coupon</a></span></div>
        <div class="card-body">
          <!-- @if(session('faq_update_success'))
            <div class="alert alert-success mt-4">
              {{ session('faq_update_success') }}
            </div>
          @endif
           -->
          @if(session('coupon_delete_success'))
            <div class="alert alert-success mt-4">
              <strong>Success ! </strong>{{ session('coupon_delete_success') }}
            </div>
          @endif
          <table class="table mt-4">
            <tr>
              <th>#</th>
              <th>Coupon Name</th>
              <th>Discount</th>
              <th>Expiry Date</th>
              <th></th>
            </tr>
            @forelse($coupons as $index => $coupon)
              <tr>
                <td>{{ $index + 1}} </td>
                <td>{{ $coupon->name }}</td>
                <td>{{ $coupon->discount }}</td>
                @if(Carbon\Carbon::now() < $coupon->expiry_date)
                <td>{{dateFormat($coupon->expiry_date, 'd-M-Y h:i a')}}</td>
                @else
                <td><span class="text-danger">{{ __('Validity Expired!') }}</span></td>
                @endif
                <td class="text-right">
                  <div class="dropleft">
                    <a class="btn btn-sm btn-secondary" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <!-- <i data-feather="settings"></i> -->
                      Options
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                      <a class="dropdown-item" href="#">View Details</a>
                      <a class="dropdown-item" href="{{ route('coupon.edit', $coupon->id) }}">Edit</a>
                      <form action="{{ route('coupon.destroy', $coupon->id) }}" method="post">
                        @method('delete')
                        @csrf
                        <input class="dropdown-item" type="submit" value="Delete">
                      </form>
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