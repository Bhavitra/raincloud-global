@php
use App\Models\User;
use App\Models\Teacher;
$teacher='';
$user='';
if(Session::has('teacher_email')){
   
  
   $user = User::where('id',$student_id)->first();
}else if(Auth::id()){
 $teacher = Teacher::where('id',$teacher_id)->first();
}
@endphp
@extends('frontend.layouts.header2')
@section('content')
<main>
      <!-- message section -->
      <section class="message-section">
          <div class="h-100">
              <div class="row h-100">

          
                  <div class="col-12 col-md-12 h-100 p-md-0 chat-col position-relative">
                    <div class="px-3 py-2 border-bottom">
                      <span class="font-weight-bold">Chat to 
                        @if(Auth::id())
                        {{$teacher->first_name}} {{$teacher->last_name}} 
                        @endif
                         @if(Session::has('teacher_email'))
                        {{$user->name}}
                        @endif
                      </span>
                    </div>
                    <div class="h-75 chat-box p-3" style="overflow-y: scroll;">

                      <!-- outgoing msg area -->
                      
                      <!-- /outgoing msg area end -->

                     <div id="message"></div>
                      <!-- /outgoing msg area end -->

                      <!-- incoming msg area -->
                    
                      <!-- /incoming msg area end -->

                    </div>
                    <div class="position-absolute input-box px-2 py-3 border-top bg-white">
                      <form action="javascript:void();" class="d-flex px-3" id="myForm">
                    
                        <textarea name="message" placeholder="Your message"></textarea>
                        <input type="hidden" name="booking_id" value="{{$booking_id}}">
                         <input type="hidden" name="student_id" value="{{$student_id}}">
                          <input type="hidden" name="teacher_id" value="{{$teacher_id}}">
                        <button class="btn bg-transparent" style="font-size: 20px;" type="submit"><i class="fa-solid fa-paper-plane"></i></button>
                      </form>
                    </div>
                  </div>


              </div>
          </div>
      </section>
      <!-- message section end -->
  </main>
  @endsection


    