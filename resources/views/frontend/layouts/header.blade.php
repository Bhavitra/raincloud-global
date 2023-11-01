@php 
use App\Models\Teacher;
use App\Models\Webinfo;
use App\Models\Subject;
use App\Models\SubSubject;
use App\Models\Seo;
$teacher = Teacher::where('email',Session::get('teacher_email'))->first();
$webinfo = Webinfo::first();
$subjects = Subject::where('deleted','no')->get();
$seo = Seo::where('page','home')->first();
@endphp
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" type="image/x-icon" href="/backend/images/large_raincloud_trans (1).png">
    <link rel="stylesheet" href="{{url('/')}}/css/style.css" />
    <link rel="stylesheet" href="{{url('/')}}/css/responsive.css" />
     <meta name="csrf-token" content="{{ csrf_token() }}">
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
    />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/8.0.6/swiper-bundle.min.css"
    />
    <!-- Bootstrap CSS -->
    <link
      rel="stylesheet"
      href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/fontawesome.min.css"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    />
      <link rel="stylesheet" href="{{url('/')}}/backend/plugins/summernote/summernote-bs4.min.css">
      <link href="https://cdn.datatables.net/1.13.3/css/dataTables.bootstrap4.min.css" rel="stylesheet">
      <link href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet">
        {{--starts here--}}
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
      {{--ends here--}}
      @if(request()->segment(1) == '')
    <title>{{$seo->seo_title}}</title>
     <meta name="description" content="{{$seo->seo_description}}">
       <meta name="keywords" content="{{$seo->seo_keywords}}">
       <link href="{{$seo->canonical_url}}" rel="canonical_url">
    @endif
    
    <style>
      .active{
        color:#000000;
      }
    </style>
  </head>
  <body style="background-color: #f4f3ef;">
    <!---TOP HEADER STARTS--->

    <!---back to top--->
    <a href="#"
      ><div class="to-top">
        <i class="fa-solid fa-angle-up"></i></div
    ></a>
    <!---back to top--->

    <!---responsive social icon--->
    <div class="responsive_social_menu">
      <ul>
        <li>
          <i class="fa-brands fa-facebook-f"></i>
        </li>
        <li>
          <i class="fa-brands fa-twitter"></i>
        </li>
        <li>
          <i class="fa-brands fa-linkedin-in"></i>
        </li>
      </ul>
    </div>
    <!---responsive social icon--->

    <!---responsive footer contact--->
    <div class="responsive_footer_contact">
      <ul>
        <li>
          <span><i class="fa-solid fa-phone"></i>&nbsp;+880 1249876 24</span>
        </li>
        <li>
          <span
            ><i class="fa-solid fa-envelope"></i>&nbsp;{{$webinfo->email}}</span
          >
        </li>
      </ul>
    </div>

    <div class="mobile_sidepanel">
      <div class="mobile_loogo">
        <a href="{{route('/')}}"><img
          src="{{url('/')}}/backend/images/{{$webinfo->logo}}"
          class="img-fluid"
          style="width: 200px"
        /></a>
      </div>
      <ul>
        <li><a href="javascript:void(0)">Our Courses</a></li>
        <li><a href="#">English</a></li>
        <li><a href="#">Python</a></li>
        <li><a href="#">Artificial Engineering</a></li>
        <li><a href="#">Machine Learning</a></li>
        <li><a href="#">French</a></li>
      </ul>
      <div class="logcreate">
        <a href=""
          ><button class="btn btn-primary">
            <i class="fa-solid fa-arrow-right-to-bracket"></i>&nbsp;Log In
          </button></a
        >
        <a href=""
          ><button class="btn btn-primary">
            <i class="fa-solid fa-user"></i>&nbsp;Create Account
          </button></a
        >
      </div>

      <div class="cancel">
        <i class="fa-solid fa-xmark"></i>
      </div>
    </div>

    <div class="mobile_search_div position-relative">
      <input type="text" class="form-control" />
      <i class="fa-solid fa-rectangle-xmark"></i>
      <i class="fa-solid fa-magnifying-glass"></i>
    </div>
    <!---responsive footer contact--->
    <header>
      <div class="top_header py-2 position-relative">
        <div class="container">
          <div class="row">
            <div class="col-lg-6">
              <div class="left">
                <span>Follow Us</span>
                <ul>
                  <li><a href="{{$webinfo->twiiter}}"><i class="fa-brands fa-twitter"></i></a></li>
                  <li><a href="{{$webinfo->linkedin}}"><i class="fa-brands fa-linkedin-in"></i></a></li>
                  <li><a href="{{$webinfo->youtube}}"><i class="fa-brands fa-youtube"></i></a></li>
                </ul>
              </div>
            </div>

            <div class="col-lg-6">
              <div class="right position-relative">
                <div class="phone">
                  
                </div>

                <div class="email">
                  <span
                    ><i class="fa-solid fa-envelope"></i
                    >&nbsp;{{$webinfo->email}}</span
                  >
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="header py-4">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-lg-4">
              <div class="header-left">
                <div class="logo">
                  <a href="{{route('/')}}"><img
                    src="{{url('/')}}/backend/images/{{$webinfo->logo}}"
                    style="width: 200px"
                  /></a>
                </div>

                <div class="login-sign-btn position-relative">
                  <button class="btn btn">
                    Subjects <span><i class="fa-solid fa-angle-down"></i></span>
                  </button>

                  <div class="dropodown">
                    <ul>

                      @foreach($subjects as $subject)
                      @php 
                      $sub_subject = SubSubject::where('sub_id',$subject->id)->get();
                      @endphp
                      <li>
                        <a href="{{route('subject_search',['slug'=>$subject->subject_name])}}">{{$subject->subject_name}}</a>
                          @if(count($sub_subject)>0)
                        <div class="submenu p-5">
                         
                          <div class="row">
                           @foreach($sub_subject as $subject)
                            <div class="col-lg-6">
                              <ul>

                                <li>
                                    @php
                                    $name = $subject->sub_sub_name;
                                    if(strstr($name, '/')){
                                    $name = substr($name, 0, strpos($name, "/"));
                                    }else{
                                    
                                     $name = $subject->sub_sub_name;
                                    }

                                    @endphp
                                  <a href="{{route('subject_search',['slug'=>$name])}}"
                                    ><img
                                      src="/img/png/pythonicon.png"
                                      style="width: 25px; height: 25px"
                                    />&nbsp;&nbsp;{{$subject->sub_sub_name}}</a
                                  >
                                </li>
                       
                              </ul>
                            </div>
                            @endforeach
                            

               
                          </div>
                        </div>
                        @endif

                      </li>
                      @endforeach


                     
                    </ul>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-lg-4" style="position:relative;top:10px;">
              <div class="search_form">
                <form action="{{route('search')}}" class="position-relative" method="get">
                  <input
                    type="text"
                    class="form-control"
                    name="search"
                    placeholder="Search for tutor by subjects"
                    required
                  />
                  <input type="image" src="https://img.icons8.com/external-dreamstale-lineal-dreamstale/22/000000/external-search-seo-dreamstale-lineal-dreamstale-7.png" style="float:right;position:relative;bottom:30px;right:10px;border:0px solid #ffffff;">
                </form>
              </div>
            </div>

            <div class="col-lg-4">
              <div class="header-right">
                @if(!Session::has('teacher_email') && !Auth::id())
                <div class="login-sign-btn position-relative">
                  <button class="btn btn">
                    Login/Signup
                    <span><i class="fa-solid fa-angle-down"></i></span>
                  </button>
                  <div class="dropodown">
                    <ul>
                      <li>
                        <a href="{{route('student.login')}}"
                          ><i class="fa-solid fa-arrow-right-to-bracket"></i
                          >&nbsp;Student Login</a
                        >
                      </li>
                      <li>
                        <a href="{{route('teacher.login')}}"
                          ><i class="fa-solid fa-arrow-right-to-bracket"></i
                          >&nbsp;Teachers Login</a
                        >
                      </li>
                    </ul>
                  </div>
                </div>
                @else
                <div class="login-sign-btn position-relative">
                  @if(Session::has('teacher_email'))
                  <a href="{{route('teacher.dashboard')}}">{{$teacher->first_name}} {{$teacher->last_name}}</a>
                  @else
                     <a href="{{route('student.dashboard')}}">{{Auth::user()->name}}</a>
                  @endif
               
                </div>
                @endif

                <ul class="usd-inr">
                  <li 
                  @if(Session::has('session_rupee'))
                  style="background:red;"
                  @endif
                  >
                   <a href="{{route('usd')}}" 
                    @if(Session::has('session_rupee'))
                   style="color:#ffffff;"
                   @endif
                   ><i class="fa-sharp fa-solid  fa-dollar-sign"></i><span>USD</span></a>
                  </li>
                  <li
                  @if(Session::has('session_dollar'))
                  style="background:red;"
                  @endif
                  >
                   <a href="{{route('inr')}}"
                   @if(Session::has('session_dollar'))
                   style="color:#ffffff;"
                   @endif
                   ><i class="fa-sharp fa-solid fa-indian-rupee-sign"></i><span>INR</span></a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="mobile_header">
        <div class="container moho">
          <img src="./img/png/large_raincloud_trans.png" style="width: 200px" />

          <img
            class="mobile_search"
            src="https://img.icons8.com/external-dreamstale-lineal-dreamstale/22/000000/external-search-seo-dreamstale-lineal-dreamstale-7.png"
          />
          <div class="line">
            <div></div>
          </div>
        </div>
      </div>
    </header>

    <!---TOP HEADER ENDS--->
    @yield('content')
    @include('frontend.layouts.footer')