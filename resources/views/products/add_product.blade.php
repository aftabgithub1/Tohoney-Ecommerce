@extends('layouts.accounts')

@section('page_title')
Add Product - 
@endsection

@section('product')
active
@endsection

@section('content')
<div class="container">
  <h1>Add Product</h1>
  <div class="card">
    @if(session('product_add_success'))
      <div class="alert alert-success mt-4">
        <strong>Success ! </strong>{{ session('product_add_success') }}
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
    <div class="card-body pt-3">
      <div class="row justify-content-center">
        <div class="col-lg-6 pr-2">
          <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label for="category_id">Category</label>
              <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror">
                <option value="" selected disabled hidden>-- Select Category --</option>
                @php $categories = App\Models\Category::all(); @endphp
                @foreach($categories as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="name">Product name</label>
              <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror">
            </div>
            <div class="form-group">
              <label for="price">Price</label>
              <input type="text" name="price" id="price" class="form-control @error('price') is-invalid @enderror">
            </div>
            <div class="form-group">
              <label for="short_desp">Short Description</label>
              <input type="text" name="short_desp" id="short_desp" class="form-control @error('short_desp') is-invalid @enderror">
            </div>
            <div class="form-group">
              <label for="long_desp">Long Description</label>
              <textarea name="long_desp" id="long_desp" class="form-control @error('long_desp') is-invalid @enderror" cols="30" rows="5">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Aspernatur laboriosam amet nihil corporis doloribus enim neque eos, aliquid rerum voluptatibus.
              </textarea>
            </div>
            <div class="form-group">
              <input type="file" name="thumbnail" id="prodImage"
              class="form-control @error('thumbnail') is-invalid @enderror" 
              onchange="document.getElementById('productImage').src=window.URL.createObjectURL(this.files[0])" hidden>
              <label for="">Choose a photo</label><br>  
              <div class="text-center">
                <label title="Click to choose a photo" for="prodImage" style="width: 200px">
                  <img src="{{ asset('uploads/Camera.png') }}" id="productImage" alt="product Image" class="img-thumbnail" style="width: 200px" onMouseOver="this.style.transform='rotate(3deg)'" onMouseOut="this.style.transform='none'">
                </label>
              </div>
            </div>
            <div class="form-group">
              <label for="">Choose Multiple photo</label><br>
              <input type="file" name="multi_images[]" id="prodMultImage" multiple>
            </div>
            <input class="btn btn-secondary" name="add" type="submit" value="Add">
            <a href="{{route('product.index')}}" class="btn btn-secondary">Product List</a>
          </form>
        </div>
      </div>  
    </div>
  </div>
</div>

@endsection 