@extends('layouts.accounts')

@section('page_title')
Trash - 
@endsection

@section('trash')
active
@endsection

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-lg-12 pl-2">
    @if(session('parmanent_delete_success'))
            <div class="alert alert-success mt-4">
              <strong>Success ! </strong>{{ session('parmanent_delete_success') }}
            </div>
          @endif
          @if(session('restore_success'))
            <div class="alert alert-success mt-4">
              <strong>Success ! </strong>{{ session('restore_success') }}
            </div>
          @endif
    </div>

    <!-- FAQ -->
    <div class="col-lg-12 pl-2">
      <div class="card">
        <div class="card-header">FAQ Trash</div>
        <div class="card-body">

          <table class="table mt-4">
            <tr>
              <th>Questions</th>
              <th>Answers</th>
              <th>Deleted at</th>
              <th></th>
            </tr>
            @forelse($faqs as $faq)
            <tr>
              <td>{{ $faq->question }}</td>
              <td>{{ $faq->answer }}</td>
              <td>{{ $faq->deleted_at }}</td>
              <td class="text-right">
                <div class="dropleft">
                  <a class="btn btn-sm btn-secondary" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <!-- <i data-feather="settings"></i> -->
                    Options
                  </a>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="{{ route('restore', $faq->id) }}">Restore</a>
                    <a class="dropdown-item" href="{{ route('force_delete', $faq->id) }}">Delete Permanently</a>
                  </div>
                </div>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan=4 class="text-center">
                <h4 class="text-danger">No data available!</h4>
              </td>
            </tr>
            @endforelse
          </table>
        </div>
      </div>
    </div>

    <!-- Category -->
    <div class="col-lg-12 pl-2">
      <div class="card">
        <div class="card-header">Category Table</div>
        <div class="card-body">

          <table class="table mt-4">
            <tr>
              <th>Sl</th>
              <th>Category</th>
              <th>Images</th>
              <th>Deleted at</th>
              <th></th>
            </tr>
            @forelse($categories as $index => $category)
            <tr>
              <td>{{ $index + 1}}</td>
              <td>{{ $category->name }}</td>
              <!-- 
                <td>{{ App\Models\User::find($category->user_id)->name}}</td> 
              -->
              <td><img src="{{ asset('uploads/category/'.$category->image)}}" alt="Category Image" class="img-thumbnail" width="80"></td>
              <td>{{ $category->deleted_at }}</td>
              <td class="text-right">
                <div class="dropleft">
                  <a class="btn btn-sm btn-secondary" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <!-- <i data-feather="settings"></i> -->
                    Options
                  </a>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="{{ route('restore', $category->id) }}">Restore</a>
                    <a class="dropdown-item" href="{{ route('force_delete', $category->id) }}">Delete Permanently</a>
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