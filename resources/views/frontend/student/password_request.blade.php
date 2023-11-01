@extends('frontend.layouts.header')
@section('content')

       <div class="container">
      <h4 style="color:#f21b54">Please enter an email.....</h4>
       
       @if(Session::has('email_mismatch'))
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
      {{Session::get('email_mismatch')}}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif


  @if(Session::has('email_google_exists'))
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
      {{Session::get('email_google_exists')}}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif


@if(Session::has('reset_link_sent'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{Session::get('reset_link_sent')}}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif

     <div class="form-group">
      <form action="{{route('student.verify.email.password.request')}}" method="post">
        @csrf
    <label for="title">Email Verification for resetting password</label><br>
     <input type="text" class="form-control" name="email" placeholder="Enter email here...." required>
     <input type="submit" class="btn btn-primary" value="Submit">
   </form>
  </div>
</div>


@endsection