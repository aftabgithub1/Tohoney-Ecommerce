@extends('layouts.accounts')

@section('page_title')
Product - 
@endsection

@section('product')
active
@endsection

@section('content')
<div class="container">
  <h1>All Products</h1>
  <div class="row justify-content-center">
    <div class="col-lg-12 pl-2">
      <div class="card">
        <div class="card-body">
          <div><span class="float-right mb-4"><a href="{{route('product.create')}}" class="btn btn-danger">Add product</a></span></div>

          @if(session('product_delete_success'))
            <div class="alert alert-success mt-4">
              <strong>Success ! </strong>{{ session('product_delete_success') }}
            </div>
          @endif
          <table class="table mt-4">
            <tr>
              <th>Sl</th>
              <th>Product Name</th>
              <th>Price</th>
              <th>Category</th>
              <th>Photo</th>
              <th>Multiple Photo</th>
              <th></th>
            </tr>
            @forelse($products as $index => $product)
              <tr> 
                <td>{{ $index + 1}} </td>
                <td>{{ $product->product_name}}</td>
                <td>{{ $product->price}}/-</td>
                <td>{{ $product->category->name}}</td>
                <td><img src="{{ asset('uploads/product/'.$product->thumbnail)}}" alt="product Image" class="img-thumbnail" width="80"></td>
                <td>
                  @foreach($product->productMultipleImage as $multiple_image)
                  <img src="{{ asset('uploads/product/product_details/'.$multiple_image->image)}}" alt="Product Multiple Image" class="img-thumbnail" width="80">
                  @endforeach
                </td>
                <td class="text-right">
                  <div class="dropleft">
                    <a class="btn btn-sm btn-secondary" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <!-- <i data-feather="settings"></i> -->
                      Options
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                      <a class="dropdown-item" href="#">View Details</a>
                      <a class="dropdown-item" href="{{ route('product.edit', $product->id) }}">Edit</a>
                      <a class="dropdown-item" href="{{ url('edit_multiple_images/'. $product->id) }}">Edit multiple images</a>
                      <form action="{{ route('product.destroy', $product->id) }}" method="post">
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
                <td colspan=6 class="text-center">
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