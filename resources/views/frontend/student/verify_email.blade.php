@extends('frontend.layouts.header')
@section('content')

       <div class="container">
      <h4 style="color:#f21b54">Please check your email verified or not</h4>
       
       @if(Session::has('email_not_available'))
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
      {{Session::get('email_not_available')}}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif

 @if(Session::has('email_verified'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{Session::get('email_verified')}}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif

     <div class="form-group">
      <form action="{{route('student.otp.verified')}}" method="get">
    <label for="title">Email Verification</label><br>
     <input type="text" class="form-control" name="email" placeholder="Enter email here...." required>
     <input type="submit" class="btn btn-primary" value="Submit">
   </form>
  </div>
</div>


@endsection