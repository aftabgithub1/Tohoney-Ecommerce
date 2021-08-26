@extends('layouts.accounts')

@section('page_title')
Category - 
@endsection

@section('category')
active
@endsection

@section('content')
<div class="container">
  <h1>Category</h1>
  <div class="row justify-content-center">
    <div class="col-lg-12 pl-2">
      <div class="card">
        <div class="card-header">
          Category Table
          @can('create')
          <span class="float-right"><a href="{{route('category.create')}}" class="btn btn-danger">Add Category</a></span>
          @endcan
        </div>
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
              <th>Questions</th>
              <th>Answers</th>
              <th>Added By</th>
              <th>Images</th>
              <th>Updated at</th>
              <th></th>
            </tr>
            @forelse($categories as $index => $category)
            <tr>
              <td>{{ $index + 1}}</td>
              <td>{{ $category->name }}</td>
              <td>{{ $category->userTable->name}}</td>
              <!-- 
                <td>{{ App\Models\User::find($category->user_id)->name}}</td> 
              -->
              <td><img src="{{ asset('uploads/category/'.$category->image)}}" alt="Category Image" class="img-thumbnail" width="80"></td>
              <td>{{ $category->updated_at ? $category->updated_at : '-' }}</td>
              <td class="text-right">
                <div class="dropleft">
                  <a class="btn btn-sm btn-secondary" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <!-- <i data-feather="settings"></i> -->
                    Options
                  </a>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="#">View Details</a>
                    @can('update')
                    <a class="dropdown-item" href="{{ route('category.edit', $category->id) }}">Edit</a>
                    @endcan
                    @can('delete')
                    <form action="{{ route('category.destroy', $category->id) }}" method="post">
                      @method('delete')
                      @csrf
                      <input class="dropdown-item" type="submit" value="Delete">
                    </form>
                    @endcan
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