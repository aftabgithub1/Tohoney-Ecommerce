@extends('layouts.accounts')

@section('page_title')
Edit FAQ - 
@endsection

@section('faq')
active
@endsection

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-lg-6 pr-2">
      <div class="card">
        <div class="card-header">Edit FAQ</div>
        <div class="card-body pt-3">
          @if($errors->all())
            <div class="alert alert-danger">
              @foreach($errors->all() as $error)
              <li class="text-danger">
                  {{$error}}
              </li>
              @endforeach
            </div>
          @endif

          <form action="{{ url('edit_faq_post') }}" method="post">
            @csrf
            <input type="hidden" name="id" value="{{ $faq->id }}">
            <div class="form-group">
              <label for="question">Add a question</label>
              <input type="text" name="question" id="question" value="{{ $faq->question }}" class="form-control @error('question') is-invalid @enderror">
              @error('question')
                <div class="text-danger"><small>{{ $message }}</small></div>
              @enderror
            </div>
            <div class="form-group">
              <label for="answer">Add an answer</label>
              <input type="text" name="answer" id="answer" value="{{ $faq->answer }}" class="form-control @error('answer') is-invalid @enderror">
              @error('answer')
              <div class="text-danger"><small>{{ $message }}</small></div>
              @enderror
            </div>
            <input class="btn btn-secondary" type="submit" value="Update">
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection