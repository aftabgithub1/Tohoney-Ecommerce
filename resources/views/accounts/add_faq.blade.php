@extends('layouts.accounts')

@section('page_title')
Add FAQ - 
@endsection

@section('faq')
active
@endsection

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-lg-6 pr-2">
      <div class="card">
        <div class="card-header">Add FAQ</div>
        <div class="card-body pt-3">
          @if(session('success'))
            <div class="alert alert-success mt-4">{{ session('success') }}</div>
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

          <form action="{{ url('add_faq_post') }}" method="post">
            @csrf
            <div class="form-group">
              <label for="question">Add a question</label>
              <input type="text" name="question" id="question" value="{{ old('question') }}" class="form-control @error('question') is-invalid @enderror">
              @error('question')
                <div class="text-danger"><small>{{ $message }}</small></div>
              @enderror
            </div>
            <div class="form-group">
              <label for="answer">Add an answer</label>
              <input type="text" name="answer" id="answer" value="{{ old('answer') }}" class="form-control @error('answer') is-invalid @enderror">
              @error('answer')
              <div class="text-danger"><small>{{ $message }}</small></div>
              @enderror
            </div>
            <input class="btn btn-secondary" type="submit" value="Add">
          </form>
        </div>
      </div>
    </div>
    <div class="col-lg-12 pl-2">
      <div class="card">
        <div class="card-header">FAQ Table</div>
        <div class="card-body">
          @if(session('faq_update_success'))
            <div class="alert alert-success mt-4">
              {{ session('faq_update_success') }}
            </div>
          @endif
          @if(session('delete_success'))
            <div class="alert alert-success mt-4">
              {{ session('delete_success') }}
            </div>
          @endif
          <table class="table mt-4">
            <tr>
              <th>Questions</th>
              <th>Answers</th>
              <th>Created at`</th>
              <th>Updated at</th>
              <th></th>
            </tr>
            @forelse($faqs as $faq)
            <tr>
              <td>{{ $faq->question }}</td>
              <td>{{ $faq->answer }}</td>
              <td>{{ $faq->created_at }}</td>
              <td>{{ $faq->updated_at ? $faq->updated_at : '-' }}</td>
              <td class="text-right">
                <div class="dropleft">
                  <a class="btn btn-sm btn-secondary" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <!-- <i data-feather="settings"></i> -->
                    Options
                  </a>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="#">View Details</a>
                    <a class="dropdown-item" href="{{ route('edit_faq', ['id' => $faq->id]) }}">Edit</a>
                    <a class="dropdown-item" href="{{ url('delete_faq').'/'.$faq->id }}">Delete</a>
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
  </div>
</div>

@endsection