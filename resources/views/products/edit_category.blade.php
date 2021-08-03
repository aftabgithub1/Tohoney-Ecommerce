@extends('layouts.accounts')

@section('page_title')
Edit Category - 
@endsection

@section('category')
active
@endsection

@section('content')
<div class="container">
  <h1>Category</h1>
  <div class="row justify-content-center">
    <div class="col-lg-6 pr-2">
      <div class="card">
        <div class="card-header">Edit Category</div>
        <div class="card-body pt-3">
          @if(session('category_edit_success'))
            <div class="alert alert-success mt-4">
              <strong>Success ! </strong> {{ session('category_edit_success') }}
            </div>
          @endif
          
          @if($errors->all() == true)
            <div class="alert alert-danger">
              @foreach($errors->all() as $error)
              <li class="text-danger">
                  {{$error}}
              </li>
              @endforeach
            </div>
          @endif

          <form action="{{ route('category.update', $category->id) }}" method="post" enctype="multipart/form-data">
            <!-- {{method_field('PUT')}} -->
            @method('put')
            @csrf
            <div class="form-group">
              <label for="name">Edit category</label>
              <input type="text" name="name" id="name" value="{{ $category->name }}" class="form-control @error('name') is-invalid @enderror">
            </div>
            <div class="form-group">
              <input type="file" name="image" id="catImage"
              class="form-control @error('image') is-invalid @enderror" 
              onchange="document.getElementById('categoryImage').src=window.URL.createObjectURL(this.files[0])" hidden>
              <label for="">Choose a photo</label><br>
              <div class="text-center">
                <label title="Click to choose a photo" for="catImage" style="width: 200px">
                  <img src="{{ asset('uploads/category/'.$category->image) }}" id="categoryImage" alt="Category Image" class="img-thumbnail" style="width: 200px" onMouseOver="this.style.transform='rotate(3deg)'" onMouseOut="this.style.transform='none'">
                </label>
              </div>
            </div>
            <input class="btn btn-secondary" type="submit" value="Update">
            <a href="{{route('category.index')}}" class="btn btn-secondary">Category List</a>
          </form>
        </div>
      </div>  
    </div>
  </div>
</div>

@endsection