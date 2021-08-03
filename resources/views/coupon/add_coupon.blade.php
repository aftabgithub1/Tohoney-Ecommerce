@extends('layouts.accounts')

@section('page_title')
Add Coupon - 
@endsection

@section('coupon')
active
@endsection

@section('content')
<div class="container">
  <h1>Coupon</h1>
  <div class="row justify-content-center">
    <div class="col-lg-6 pr-2">
      <div class="card">
        <div class="card-header">Add Coupon</div>
        <div class="card-body pt-3">
          @if(session('coupon_add_success'))
            <div class="alert alert-success mt-4">
              <strong>Success ! </strong>{{ session('coupon_add_success') }}
            </div>
          @endif
          
          @if($errors->all())
            <div class="alert alert-danger">
              @foreach($errors->all() as $error)
              <li class="text-danger">
                  {{$error}}
              </li>
              @endforeach
            </div>
          @endif

          <form action="{{ route('coupon.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <div class="form-group">
                <label for="name">Coupon name</label>
                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror">
              </div>
              <div class="form-group">
                <label for="discount">Discount</label>
                <input type="number" name="discount" id="discount" class="form-control @error('discount') is-invalid @enderror">
              </div>
              <div class="form-group">
                <label for="expiry_date">Expiry Date</label>
                <input type="datetime-local" name="expiry_date" id="expiry_date" class="form-control @error('expiry_date') is-invalid @enderror">
              </div>
            </div>
            <input class="btn btn-secondary" type="submit" value="Add">
            <a href="{{route('coupon.index')}}" class="btn btn-secondary">Coupon List</a>
          </form>
        </div>
      </div>  
    </div>
  </div>
</div>

@endsection 