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
                          <div class="heading">
                            <h3>Teacher Login</h3>
                          </div>

                           @if(Session::has('login_fail'))
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
      {{Session::get('login_fail')}}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif

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
    
                          <div class="form">
                            <form action="{{route('teacher.logged.in')}}" method="post">
                              @csrf
                              <div class="row">
                                <div class="col">
                                  <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="email" class="" required/>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col">
                                  <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" name="password" class="" id="id_password" required/>
                                     <i class="far fa-eye" id="togglePassword" style="float:right;position:relative;bottom:30px;right:10px; cursor: pointer;"></i>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col">
                                  <div class="form-group">
                                    <button class="btn btn" type="submit">Login</button>
                                    <a href="{{route('teacher.signup')}}" style="color:red;float:right;position:relative;top:10px;">Not yet signup?</a>

                                    <a href="{{route('teacher.otp.verify')}}" style="color:green;float:right;position:relative;top:10px;right:10px;">Not yet verify email?</a>

                                    <a href="{{route('teacher.password.request')}}" style="color:red;float:right;position:relative;top:10px;">forgot password?</a>

                                  </div>
                                 
                                </div>
                              </div>
    
                            </form>
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