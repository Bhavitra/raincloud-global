  @extends('frontend.layouts.header')
  @section('content')

  <div class="innermain profile_section tutor_sign_up_navs">
        <div class="bottop">
        	<!--
          <div class="row ones">
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
          </div>
      -->
            <div class="row twos mt-5 mb-5">
              <div class="container">
                <div class="row">
                  <div class="col-lg-8" style="margin: 0 auto;">
              
                    <div class="tab-content" id="pills-tabContent">
                      <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                        <div class="tutor_signup_box">
                          <div class="heading">
                            <h3>Teacher Registration Form</h3>
                          </div>

                            @if(Session::has('teacher_login'))
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
      {{Session::get('teacher_login')}}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif

    
                          <div class="form" >
                            <form action="{{route('teacher.registration')}}" method="post">
                              @csrf
                              <div class="row">
                                <div class="col">
                                  <div class="form-group">
                                    <label>First name</label>
                                    <input type="text" name="f_name" class="" value="{{old('f_name')}}"/ required>
                                    <span style="color:red;">{{$errors->first('f_name')}}</span>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col">
                                  <div class="form-group">
                                    <label>last name</label>
                                    <input type="text" name="l_name" class="" value="{{old('l_name')}}"/ required>
                                     <span style="color:red;">{{$errors->first('l_name')}}</span>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col">
                                  <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="email" class="" autocomplete="off" value="{{old('email')}}"/ required>
                                     <span style="color:red;">{{$errors->first('email')}}{{Session::get('email_exists')}}</span>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col">
                                  <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" name="password" class="" id="id_password"/ required>
                                    <i class="far fa-eye" id="togglePassword" style="float:right;position:relative;bottom:30px;right:10px; cursor: pointer;"></i>
                                     <span style="color:red;">{{$errors->first('password')}}</span>
                                  </div>
                                </div>
                              </div>
                                <div class="row">
                                <div class="col">
                                  <div class="form-group">
                                    <label>Password Confirmation</label>
                                    <input type="password" name="password_confirmation" class="" id="id_password_confirmation"/ required>
                                    <i class="far fa-eye" id="togglePasswordConfirmation" style="float:right;position:relative;bottom:30px;right:10px; cursor: pointer;"></i>
                                     <span style="color:red;">{{$errors->first('password_confirmation')}}</span>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col">
                                  <div class="form-group">
                                    <label>Country of origin</label>
                                    <select class="form-control" name="country" required>
                                      <option value=""><span></span>--Select Country--</option>
                                        @foreach($countries as $country)
                                        <option value="{{$country->id}}">{{$country->country_name}}</option>
                                        @endforeach
                                    </select>
                                     <span style="color:red;">{{$errors->first('country')}}</span>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col">
                                  <div class="form-group">
                                    <label>Language Spoken</label>
                                    <select class="form-control" name="language" required>
                                      <option value=""><span></span>--Select Language--</option>
                                        @foreach($languages as $language)
                                        <option value="{{$language->id}}">{{$language->language_name}}</option>
                                        @endforeach
                                    </select>
                                     <span style="color:red;">{{$errors->first('language')}}</span>
                                  </div>
                                 
                                </div>
    
                                <div class="col">
                                  <div class="form-group">
                                    <select class="form-control" name="level" required>
                                      <option value=""><span></span>--Select Level--</option>
                                        @foreach($levels as $level)
                                        <option value="{{$level->id}}">{{$level->level_name}}</option>
                                        @endforeach
                                    </select>
                                     <span style="color:red;">{{$errors->first('level')}}</span>
                                  </div>
                                </div>
                                 
                                 {{--
                                <div class="col addDLT">
                                  <div>
                                    <i class="fa-solid fa-plus"></i>
                                  </div>
                                  <div>
                                    <i class="fa-solid fa-trash"></i>
                                  </div>
                                 
                                 
                                </div>
                                --}}


                              </div>
    
                              <div class="row">
                                <div class="col">
                                  <div class="form-group">
                                    <label>Subject Taught</label>
                                    <select class="form-control" name="subject" onchange="teacher_sub_subject(this.value);" required>
                                      <option value=""><span></span>--Select Subject--</option>
                                        @foreach($subjects as $subject)
                                        <option value="{{$subject->id}}">{{$subject->subject_name}}</option>
                                        @endforeach
                                    </select>
                                     <span style="color:red;">{{$errors->first('subject')}}</span>
                                  </div>
                                
                                </div>


                                <div class="col subject_taught" style="display:none;">
                                  <div class="form-group">
                                    <label>Sub Subject Taught</label>
                                    <select class="form-control" name="sub_subject" id="subject_taught">
                                    </select>
                                  </div>
                                
                                </div>
    
                                <div class="col">
                                  <div class="form-group">
                                    <label>Hourly Rate</label>
                                    <input type="text" class="" name="rate" placeholder="0" value="{{old('rate')}}"/ required>
                                       <span style="color:red;">{{$errors->first('rate')}}</span>
                                  </div>
                                </div>
                              </div>

                               <div class="row">
                                <div class="col">
                                  <div class="form-group">
                                    <label>Currency</label>
                                    <select class="form-control" name="currency" required>
                                      <option value="">--Select Currency--</option>
                                      @foreach($currencies as $currency)
                                      <option value="{{$currency->currency_slug}}">{{$currency->currency_name}}(@php echo $currency->currency_value; @endphp)</option>
                                      @endforeach
                                    </select>
                                       <span style="color:red;">{{$errors->first('currency')}}</span>
                                  </div>
                                
                                </div>
                              </div>
    
                              <div class="row">
                                <div class="col">
                                  <div class="form-group">
                                    <label>Describe your teaching experience</label>
                                    <textarea rows="4" name="teaching_experience" class="" required>{{old('teaching_experience')}}</textarea>
                                       <span style="color:red;">{{$errors->first('teaching_experience')}}</span>
                                  </div>
                                
                                </div>
                              </div>
    
                              <div class="row">
                                <div class="col">
                                  <div class="form-group">
                                    <label>Describe your current situation</label>
                                  <textarea rows="4" name="current_situation" class="" required>{{old('teaching_experience')}}</textarea>
                                     <span style="color:red;">{{$errors->first('current_situation')}}</span>
                                  </div>
                                </div>
                              </div>
    
    
                              <div class="row">
                                <div class="col">
                                  <div class="form-group">
                                    <label>phone number</label>
                                  <input type="text" name="phone" class="" value="{{old('phone')}}" required>
                                     <span style="color:red;">{{$errors->first('phone')}}</span>
                                  </div>

                                  
                                </div>
                              </div>
    
                              <div class="row">
                                <div class="col">
                                  <div class="form-group">
                                    <button type="submit" class="btn btn">Sign Up</button>
                                    <span style="float:right;position:relative;top:10px;">Already have an account? &nbsp;<a href="{{route('teacher.login')}}">Login here</a></span>
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