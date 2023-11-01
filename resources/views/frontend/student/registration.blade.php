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
                            <h2>Sign up as a student</h2>
                          </div>
    
                          <div class="modal-content px-3 text-center rounded border-0">
                            <div class="modal-body d-flex justify-content-center text-center">
                              <div>
                                <p class="mt-0">Already have an account? <a class="text-info font-weight-bold" href="{{route('student.login')}}">Log in</a>
                                </p>
                                
                               
                                <p class="text-secondary">Sign up with email</p>
                                <form class="form p-0" action="{{route('student.registration')}}" method="post">
                                    @csrf
                                  <div class="row">
                                    <div class="col">
                                      <div class="form-group">
                                        <input class="form-control" type="text" name="name" class="" placeholder="Your name" required/>
                                        <span style="color:red;">{{$errors->first('name')}}</span>
                                      </div>
                                    </div>
                                  </div>
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
                                      </div>
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col">
                                      <div class="form-group">
                                        <button class="btn btn-info w-100" type="submit">Sign Up</button>
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
        </div>
    </div>
   

     @endsection