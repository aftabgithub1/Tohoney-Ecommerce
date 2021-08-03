@extends('layouts.accounts')

@section('page_title')
Edit Product Multiple Image - 
@endsection

@section('product')
active
@endsection

@section('content')
<div class="container">
  <h1>Edit Product Multiple Images</h1>
  <div class="row justify-content-center">
    <div class="col-lg-12 pl-2">
      <div class="card">
        <div class="card-body">

          @if(session('multi_image_delete_success'))
            <div class="alert alert-success mt-4">
              <strong>Success ! </strong>{{ session('multi_image_delete_success') }}
            </div>
          @endif

          @if(session('images_add_success'))
            <div class="alert alert-success mt-4">
              <strong>Success ! </strong>{{ session('images_add_success') }}
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

          <div class="row">
            @forelse($product_multi_images as $product_multi_image)
            <div class="col-lg-2">
              <div class="mt-3" >
                <img src="{{ asset('uploads/product/product_details/'.$product_multi_image->image)}}" alt="product Image" class="img-thumbnail">
              </div>
              <div class="text-center mt-2">
                <a class="btn btn-sm btn-secondary" href="{{url('multiple_images_delete/'.$product_multi_image->id)}}">Delate</a>
              </div>
            </div>
            @empty
              <div colspan=2 class="text-center mt-3">
                <h4 class="text-danger">No multiple images available!</h4>
              </div>
            @endforelse
          </div>
          <div class="mt-4">
            <form action="{{route('upload_multiple_images', ['product_id' => $product_id])}}" method="post" enctype="multipart/form-data">
              @csrf
              <div class="form-group">
                <label for="">Add more photo</label><br>
                <input type="file" name="multi_images[]" id="prodMultImage" multiple>
              </div>
              <input class="btn btn-secondary" type="submit" value="Add">
              <a href="{{route('product.index')}}" class="btn btn-secondary">Product List</a>
            </form>
          </div>

        </div>
      </div>
    </div>

  </div>
</div>

@endsection