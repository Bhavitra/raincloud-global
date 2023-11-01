@extends('frontend.layouts.header')
@section('content')

       <div class="container">
      <h4 style="color:#f21b54">Please enter new password.....</h4>
       
       @if(Session::has('email_mismatch'))
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
      {{Session::get('email_mismatch')}}
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
      <form action="{{route('student.new.password.update')}}" method="post">
        @csrf
    <label for="title">Enter New Password</label><br>
     <input type="password" class="form-control" name="new_password" placeholder="Enter new password...." required>
     <input type="hidden" name="email" value="{{Request::segment(2)}}">
     <input type="hidden" name="token" value="{{Request::segment(3)}}">
     <input type="submit" class="btn btn-primary" value="Submit">
   </form>
  </div>
</div>


@endsection