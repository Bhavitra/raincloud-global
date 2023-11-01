@extends('frontend.layouts.header')
@section('content')

@php
use App\Models\Teacher;
$teacher = Teacher::where('id',$id)->first();

$email = $teacher->email;
$data = ['otp'=>$teacher->otp];

 Mail::send('mail', $data, function($message) use($email) {
         $message->to($email)->subject
            ('Email Verification Message from Tutor');
         $message->from('support@raincloud-global.com','Email Verification Message from Tutor');
      });


@endphp
       <div class="container">
      <h4 style="color:#f21b54">An otp has been sent to the registered email...pls check email...</h4>
       
       @if(Session::has('otp_mismatch'))
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
      {{Session::get('otp_mismatch')}}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif

     <div class="form-group">
      <form action="{{route('teacher.verify.email')}}" method="post">
        @csrf
    <label for="title">Email Verification</label><br>
     <input type="text" class="form-control" name="otp" placeholder="Enter otp here...." required>
     <input type="hidden" name="teacher_id" value="{{$id}}">
     <input type="submit" class="btn btn-primary" value="Submit">
   </form>
  </div>
</div>


@endsection