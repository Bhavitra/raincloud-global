@extends('frontend.layouts.header')
@section('content')

       <div class="container">
      <h4 style="color:#f21b54">Otp has been sent to your Registered Email.pls check your email....</h4>
       
       @if(Session::has('otp_mismatch'))
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
      {{Session::get('otp_mismatch')}}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif


     <div class="form-group">
      <form action="{{route('teacher.otp.updated')}}" method="post">
        @csrf
    <label for="title">Otp Verification</label><br>
     <input type="text" class="form-control" name="otp" placeholder="Enter otp here...." required>
     <input type="hidden" name="email" value="{{$email}}">
     <input type="submit" class="btn btn-primary" value="Submit">
   </form>
  </div>
</div>


@endsection