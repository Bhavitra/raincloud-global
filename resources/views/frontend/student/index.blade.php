   @php
   $booking_initiate='';
   $subject_search='';
   if(isset($_GET['booking-initiate'])){
       
       $booking_initiate = $_GET['booking-initiate'];
       
   }else{
   
   $booking_initiate = '';
   
   }
   
   
     if(isset($_GET['subject-search'])){
       
       $subject_search = $_GET['subject-search'];
       
   }else{
   
   $subject_search = '';
   
   }
   
   @endphp
   
   @extends('frontend.layouts.header')
     @section('content')
 <div class="main-banner innersban" style="background:url(./img/jpg/innerbanner.jpg) 0 0 no-repeat"> 
      <div class="inner">
        <h2 class="text-left">Online English Tutors & Teachers for Private Lessons</h2>
        <p class="text-left">Looking for an online English tutor? Preply is the leading online language learning platform worldwide. You can choose from 558 English teachers with an average rating of 4.87 out of 5 stars given by 3578 customers. Book a lesson with a private English teacher today and start learning. Not entirely happy with your tutor? No worries, Preply offers free tutor replacement till you're 100% satisfied.
       </p>
      </div>
    </div>

    <div class="innermain profile_section tutor_sign_up_navs">
        <div class="bottop">
          <!-- <div class="row ones">
             <div class="col-lg-12">
              <ul>
                <li><a href="">About</a></li>
                <li><a href="">Photo</a></li>
                <li><a href="">Certification</a></li>
                <li><a href="">Education</a></li>
                <li><a href="">Description</a></li>
                <li><a href="">Video</a></li>
                <li><a href="">Availability</a></li>
              </ul>
             </div>
          </div> -->
            <div class="row twos mt-5 mb-5">
              <div class="container">
                <div class="row">
                  <div class="col-lg-5" style="margin: 0 auto;">
              
                    <div class="tab-content" id="pills-tabContent">
                      <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                        <div class="tutor_signup_box">
                          <div class="heading text-center">
                            <h2>Login</h2>
                            @if(Session::has('otp_verified'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{Session::get('otp_verified')}}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif

  @if(Session::has('new_password_update'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{Session::get('new_password_update')}}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif
                          </div>
                          <div class="modal-content px-3 text-center rounded border-0">
                            <div class="modal-body d-flex justify-content-center text-center">
                              <div>
                                <p class="mt-0"><a class="text-info font-weight-bold" href="{{route('register')}}">Sign up as a student</a></a>
                                </p>

                                <p class="mt-0"><a class="text-primary font-weight-bold" href="{{url('auth/google',['slug'=>Request::segment(2) == 'login' ? 'book' : ''])}}">Google Login</a></a>
                                </p>
                            
                                <p class="text-secondary">or</p>
                                <form action="{{route('login')}}" class="form p-0" method="post">
                                  @csrf
                                  <div class="row">
                                    <div class="col">
                                      <div class="form-group">
                                        <input class="form-control" type="email" name="email" class="" placeholder="Email address" required/>
                                          <span style="color:red;">{{$errors->first('email')}}</span>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col">
                                      <div class="form-group">
                                        <input class="form-control" type="password" name="password" class="" placeholder="Password" required/>
                                        <span style="color:red;">{{$errors->first('password')}}</span>
                                      </div>
                                    </div>
                                  </div>
                                  <input type="hidden" name="slug" value="{{$slug}}">
                                  <input type="hidden" name="booking_initiate" value="<?php echo $booking_initiate;?>">
                                   <input type="hidden" name="subject_search" value="<?php echo $subject_search;?>">
                                  <div class="row">
                                    <div class="col">
                                      <div class="form-group">
                                        <button class="btn btn-info w-100" type="submit">Log In</button>
                                      </div>
                                    </div>
                                  </div>
                                </form>
                                <a href="{{route('student.otp.verify')}}" style="position:relative;right:5px;color:green;">Not yet verify email?</a><a href="{{route('student.password.request')}}" style="position:relative;left:5px;color:red;">Forgot Password</a>
                             
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      </div>
                   </div>
                </div>
              </div>
            
            </div>
        </div>
    </div>
    @endsection
   