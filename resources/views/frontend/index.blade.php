
     @extends('frontend.layouts.header')
     @section('content')
    <!---TOP BANNER STARTS--->
    <div class="main-banner">
      <!-- Slider main container -->
      <div class="swiper">
        <!-- Additional required wrapper -->
        <div class="swiper-wrapper">
          <!-- Slides -->
           
          @foreach($sliders as $slider)
          <div class="swiper-slide position-relative">
            <img src="{{url('/')}}/backend/banner/{{$slider->image}}" class="img-fluid" />
            <div class="banner-text">
              <h1 id="main-heading">
               @php echo $slider->title; @endphp
              </h1>

              <p id="main-para">
                @php echo $slider->description; @endphp
              </p>

              <a href="{{route('teacher.login')}}"><button class="btn btn-primary" id="mainBTN"><span>Become a Tutor</span></button></a>
            </div>
          </div>
          @endforeach


     
  
          ...
        </div>
        <!-- If we need pagination -->
        <div class="swiper-pagination"></div>

        <!-- If we need navigation buttons -->
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>

        <!-- If we need scrollbar -->
      </div>
    </div>
    <!---TOP BANNER ENDS--->

    <!---who we are starts--->
    <div class="container about py-5 my-5">
      <div class="row align-items-center">
        <div class="col-lg-6 col-md-6">
          <div class="about-img" data-aos="fade-right">
            <img src="{{url('/')}}/backend/about/about.png" class="img-fluid" />
          </div>
        </div>

        <div class="col-lg-6 col-md-6 abtxt" data-aos="fade-left">
          <h2>{{$about->title}}</h2>
          
          @php echo $about->description; @endphp


        </div>
      </div>
    </div>
    <!---who we are ends--->

    <!---how it works starts--->
    <div class="how-it-starts py-5 position-relative">
      <div class="container">
        <div class="row asrts">
          <div class="col-lg-12">
            <h6>Learning IT Diferently</h6>
            <h2>How it Works for Tutors?</h2>
            <p class="position-relative">
              Speak naturally with professional online tutors from 185 countries
            </p>
          </div>
        </div>

        <div class="row my-5 list">
          <div class="col-lg-4 col-md-4 col-sm-4">
            <div class="how-it-starts-ins text-center">
              <div class="ins-ins">
                <div class="icon">
                  <img src="{{url('/')}}/img/png/icon1.png" />
                </div>
                <h4>
                  Create a Free <br />
                  Account
                </h4>
                <p>Find native speakers and certified private tutors</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-4 col-sm-4">
            <div class="how-it-starts-ins text-center">
              <div class="ins-ins">
                <div class="icon">
                  <img src="{{url('/')}}/img/png/icon2.png" />
                </div>
                <h4>
                  Apply to Your Desired <br />
                  Tuition Job
                </h4>
                <p>Find native speakers and certified private tutors</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-4 col-sm-4">
            <div class="how-it-starts-ins text-center">
              <div class="ins-ins">
                <div class="icon">
                  <img src="{{url('/')}}/img/png/icon3.png" />
                </div>
                <h4>Start Tutoring</h4>
                <p>Find native speakers and certified private tutors</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!---how it works ends--->

    <!---how it works starts--->
    <div class="how-it-starts py-5 faculty position-relative lef">
      <div class="container">
        <div class="row asrts">
          <div class="col-lg-12">
            <h6>Learning IT Diferently</h6>
            <h2>Our Popular Teacher</h2>
            <p class="position-relative">
              Speak naturally with professional online tutors from 185 countries
            </p>
          </div>
        </div>

        <div class="row my-5 list">

          @foreach($teachers as $teacher)
          <div class="col-lg-4 col-md-4 col-sm-4">
            <div class="how-it-starts-ins text-center rit">
              <div class="ins-ins">
                <div class="facul-img">
                  <img src="{{url('/')}}/frontend/images/user.webp" class="img-fluid" />
                </div>
                <h4>{{$teacher->first_name}} {{$teacher->last_name}}</h4>
                <h5>{{$teacher->subject_name}}</h5>
                <p>
                 @php echo $teacher->teaching_experience; @endphp
                </p>
                <a href="{{route('teacher_profile',['id'=>$teacher->id])}}"
                  ><button class="btn btn-primary d-block mx-auto">
                    View Profile
                  </button></a
                >
              </div>
            </div>
          </div>
          @endforeach

       




        </div>
      </div>
    </div>

    <!---how it works ends--->

    <!----cta starts---->
    <div class="cta" data-aos="fade-up">
      <div class="cta-img">
        <img src="{{url('/')}}/img/jpg/cta.jpg" class="img-fluid" />
      </div>
      <div class="cta-text" >
        <h2>Request a Private Tutor</h2>
        <p>Post your requirements and let tutors find you</p>
        <a href="{{route('teacher.login')}}"><button class="btn btn-primary"><span>Apply Now</button></span></a>
      </div>
    </div>
    <!----cta ends---->

    @endsection

   