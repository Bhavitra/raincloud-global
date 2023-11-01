     @php 
     use Stevebauman\Location\Facades\Location;
     use App\Models\Review;
     use App\Models\CurrencyValue;
     use App\Models\Country;
     
     $url = Request::segment(2);
     Session::put("url",$url);
     
     
     $count = count($subject_teachers);
     /*
       $availabilities_monday = DB::table('availabilities')->join('teachers','teachers.id','=','availabilities.teacher_id')->where('deleted','no')->where('day','monday')->where('booked',null)->get();

        $availabilities_tuesday = DB::table('availabilities')->join('teachers','teachers.id','=','availabilities.teacher_id')->where('deleted','no')->where('day','tuesday')->where('booked',null)->get();

         $availabilities_wednesday = DB::table('availabilities')->join('teachers','teachers.id','=','availabilities.teacher_id')->where('deleted','no')->where('day','wednesday')->where('booked',null)->get();

          $availabilities_thursday = DB::table('availabilities')->join('teachers','teachers.id','=','availabilities.teacher_id')->where('deleted','no')->where('day','thursday')->where('booked',null)->get();

           $availabilities_friday = DB::table('availabilities')->join('teachers','teachers.id','=','availabilities.teacher_id')->where('deleted','no')->where('day','friday')->where('booked',null)->get();

            $availabilities_saturday = DB::table('availabilities')->join('teachers','teachers.id','=','availabilities.teacher_id')->where('deleted','no')->where('day','saturday')->where('booked',null)->get();

             $availabilities_sunday = DB::table('availabilities')->join('teachers','teachers.id','=','availabilities.teacher_id')->where('deleted','no')->where('day','sunday')->where('booked',null)->get();

             $rupee = CurrencyValue::value('rupee_value');
             */
             
                $rupee = CurrencyValue::value('rupee_value');
             
             
$ipInfo = file_get_contents('http://ip-api.com/json/' . $ip);
$ipInfo = json_decode($ipInfo);
$timezone = $ipInfo->timezone;
date_default_timezone_set($timezone);
//echo date_default_timezone_get();
//echo date('Y/m/d H:i:s');



     @endphp
     @extends('frontend.layouts.header')
     @section('content')
    <!---TOP HEADER ENDS--->
   <style>
    
/*  .modal {*/
/*  padding: 0 !important; // override inline padding-right added from js*/
/*}*/
@media (min-width: 576px){
    .modal .modal-dialog{
        max-width: 630px;
    }
}
.modal .modal-dialog {
  /*width: 100%;*/
  /*max-width: none;*/
  /*height: 100%;*/
  /*margin: 0;*/
}
.modal .modal-content {
  /*height: 100%;*/
  /*border: 0;*/
  border-radius: 5px !important;
}
/*.modal .modal-body {*/
/*  overflow-y: auto;*/
/*}*/

td{
  text-align:center;
}


.fc-ltr .fc-axis,
.fc-time-grid-container,
.fc-unthemed .fc-divider{
    display: none;
}
/*.fc-agenda-view .fc-day-grid{*/
/*    height: 170px;*/
/*    overflow: hidden scroll;*/
/*}*/
.fc-day-grid-event{
    margin-bottom: 8px !important;
}
.fc-event, .fc-event-dot {
    padding: 5px 2px !important;
    color: #ffffff !important;
}
.fc-view-container{
    height: 200px;
    overflow: hidden auto;
}
.fc-head{
    position: sticky;
    top: 0;
    left: 0;
    z-index: 99;
    background: #fff;
}
.fc-view-container::-webkit-scrollbar{
    width: 4px;
}
.fc-day-header{
    padding: 0 6px !important;
}

.fc-content span{
    cursor:pointer;
}

</style>


    <!---TOP BANNER STARTS--->
    <div class="main-banner innersban" style="background:url(./img/jpg/innerbanner.jpg) 0 0 no-repeat"> 
      <div class="inner">
        <h2>Online Tutors & Teachers for Private Lessons</h2>
        <p>Looking for an online tutor? Preply is the leading online language learning platform worldwide. You can choose from thouands of teachers with an average rating of 4.87 out of 5 stars given by 3578 customers. Book a lesson with a private teacher today and start learning. Not entirely happy with your tutor? No worries, Preply offers free tutor replacement till you're 100% satisfied.
       </p>
      </div>
    </div>

    <div class="innermain" style="padding: 100px 0;">
         <div class="container">
           <div class="row">
             <div class="col-lg-12">
               <div class="book_a_tutor">
                 <h3>BOOK A TUTOR FROM TUTOR LISTS</h3>
                 <p>{{$count}} 
                 @if($i==1)
                 {{strtolower($sub_name)}} 
                 @else
                 {{strtolower($sub_sub_name)}} 
                 @endif
                  @if($count==1)
                 teacher
                 @elseif($count == 0)
                  no teachers
                 @else
                 teachers 
                 @endif
               available</p>
               </div>

               <div class="tutor_booking mt-5">
                   @php  $i=1;@endphp

                @foreach($subject_teachers as $teacher)
                @php
                
                $c_name = Country::where('id',$teacher->country_id)->first();

                 $ip = request()->ip();
                 
                

                 $count = DB::table('bookings')->join('class_statuses','class_statuses.booking_id','=','bookings.id')->join('teachers','teachers.id','=','bookings.teacher_id')->where('teachers.id',$teacher->id)->where('class_statuses.class_status_deleted','no')->where('class_status','pending')->orWhere('class_status','completed')->count();

                 $review_avg = Review::where('teacher_id',$teacher->id)->avg('rating');
                 $review_avg_round = round($review_avg);
                 $review_count = Review::where('teacher_id',$teacher->id)->count();
                //$apiURL = 'https://freegeoip.app/json/'.$userIp;
                //$locationData = json_decode($apiURL); 

                $country_code = Location::get($ip);
                 
                 $from = Carbon\Carbon::parse($teacher->created_at);
                 $to = Carbon\Carbon::now();

                 $diff_in_days = $from->diffInDays($to);

              
            @endphp
                 <div class="tutor--booking mb-3">
                   <div class="astr">
                    <div class="left">
                      <div class="tutor_img">
                        <img src="{{url('/')}}/frontend/images/user.webp" />
                        <svg class="VerifiedTutorIcon___3rQrC" width="16" height="19" viewBox="0 0 16 19" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M10.538 1.76A11.153 11.153 0 0 1 8.026 0a11.21 11.21 0 0 1-2.53 1.76A11.445 11.445 0 0 1 0 2.983c0 1.69.052 3.076.11 4.059.02.635.08 1.269.177 1.897a13.62 13.62 0 0 0 .972 3.133 12.522 12.522 0 0 0 3.726 4.6 13.745 13.745 0 0 0 3.024 1.759 13.739 13.739 0 0 0 3.03-1.788 12.52 12.52 0 0 0 3.725-4.6c.44-.998.759-2.046.949-3.121.097-.629.156-1.262.178-1.897.057-.984.109-2.37.109-4.06-1.892.055-3.77-.36-5.462-1.207v.002ZM9.05 11.43l-1.385 1.373L6.29 11.43 3.87 8.992l1.373-1.374 2.42 2.443 3.916-3.915 1.391 1.362-3.92 3.921v.001Z" fill="#3BB3BD"></path></svg>
                      </div>
                      <div class="tutor_name">
                        <h6>{{$teacher->first_name}} {{$teacher->last_name}}</h6>
                      </div>
                      
                      <!--
                      <div class="book_btn">
                        <a href="javascript:void(0)"><button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Book trial lesson</button></a>
                      </div>
                    -->

                      <div class="booking_price">
                        <h6>
                          
                          @if(Session::has('session_dollar') && ($teacher->currency == 'inr'))
                          &#8377;{{$teacher->hourly_rate}}
                          @elseif(Session::has('session_rupee') && ($teacher->currency == 'inr'))
                          @php
                          $dollar_value = ($teacher->hourly_rate)/$rupee;
                          $dollar_value_format = round($dollar_value,2);
                           echo "$".$dollar_value_format;
                          @endphp
                           @elseif(Session::has('session_dollar') && ($teacher->currency == 'dollar'))
                             @php
                          $dollar_value = ($teacher->hourly_rate)*$rupee;
                          $dollar_value_format = round($dollar_value,2);
                           echo "&#8377;".$dollar_value_format;
                          @endphp
                            @elseif(Session::has('session_rupee') && ($teacher->currency == 'dollar'))
                            ${{$teacher->hourly_rate}}
                           @elseif(!Session::has('session_rupee') && !Session::has('dollar_rupee'))
                           @if($teacher->currency == 'inr')
                           &#8377;
                           @else
                           $
                           @endif
                           {{$teacher->hourly_rate}}
                          @endif
                          {{--$teacher->hourly_rate--}}
                          <span>Per Hour</span></h6>
                      </div>

                    </div>
   
                    <div class="center">
                      <h6 class="newly mb-2"><span>
                        @if($diff_in_days <=30)
                         Newly Joined
                        @endif
                      </span>
                    {{$count}} active students</h6>
                      <h6 class="can_speak mb-2">Can Speaks: <span>{{$teacher->language_name}}</span></h6>
                      <h6 class="curr_loc mb-1">Current Location - <span>{{$c_name->country_name}}</span>&nbsp;&nbsp;<span>
                         
                          <img src="https://img.icons8.com/color/28/000000/{{$c_name->country_slug}}.png"/>
                          
                          
                          </span></h6>
                      <p class="mb-2 mt-0">I want to help you to learn <span>{{$teacher->subject_name}}</span></p>
  
                      <p class="pro mt-4">{{$teacher->teaching_experience}}</p>
                    </div>
   
                    <div class="right">
                        
                        
                       <h6>Availability</h6>
                      <!--<button class="btn btn-lg btn-warning" data-toggle="modal" data-target="#viewDetailModal" onclick="teacher_details({{$teacher->id}});">View Details</button>-->
                   

                      <form action="{{route('book')}}" method="post">
                        @csrf
                      <div class="star_review">
                       <h6 class="text-center">
                        @if($review_avg_round == 1)
                        <i class="fa-solid fa-star"></i>
                        @endif
                         @if($review_avg_round == 2)
                        <i class="fa-solid fa-star"></i>
                          <i class="fa-solid fa-star"></i>
                        @endif
                        @if($review_avg_round == 3)
                        <i class="fa-solid fa-star"></i>
                          <i class="fa-solid fa-star"></i>
                           <i class="fa-solid fa-star"></i>
                        @endif
                         @if($review_avg_round == 4)
                        <i class="fa-solid fa-star"></i>
                          <i class="fa-solid fa-star"></i>
                           <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                        @endif
                         @if($review_avg_round == 5)
                        <i class="fa-solid fa-star"></i>
                          <i class="fa-solid fa-star"></i>
                           <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                        @endif
                        {{$review_avg_round}}<span>{{$review_count}} Review</span></h6>
                        
                      </div>
                     
                      
                   
                        
                                     
                                     
                                      
                                      
                                   
                                    
                              
                                    @if(Auth::id())
                                    <!--<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal" onclick="day_time({{$teacher->id}});">Select Day and time</button>-->
                                    
                                  @endif
                                        
                                        
                                        <!--<span id="teacher2_day"></span>-->
                                        
                                        <!--<select class="form-control" onfocus="teacher_time(this.value,{{$teacher->id}});" onchange="teacher_time(this.value,{{$teacher->id}})" id="teacher2_day"></select>-->
                                        
                                       
                                        
                                
                                      
                       
                       

                           
                        
                        
                        <input type="hidden" name="teacher_id" id="teacher" value="{{$teacher->id}}">
                        <input type="hidden" name="amount" value="{{$teacher->hourly_rate}}">
                        <div id="timing"></div><br>
                        
                        <div id="day_input"></div>
                        <div id="time_slot"></div>
                        
                     
                        @if(Auth::id())
                        <!--<button type="submit" class="btn btn-lg btn-success">Book Now</button>-->
                        @else
                        <!--<a href="{{route('student.login',['slug'=>'login'])}}" class="btn btn-md btn-primary">Login to Book</a>-->
                        @endif
                      </form>
                       
                        
                        <p>
 
  <!--<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample{{$i}}" aria-expanded="false" aria-controls="collapseExample" onclick="view_details2({{$teacher->id}},{{$i}});">View Details</button>-->
    <!--<button onclick="view_details2({{$teacher->id}},{{$i}});">View Details</button>-->
  <!--  View Details-->
  <!--</button>-->
  
  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#bookingModal{{$i}}" onclick="view_details2({{$teacher->id}},{{$i}});">
  View Details
</button>

</p>
<div class="collapse" id="collapseExample{{$i}}">
  <div class="card card-body">
   <div class="container">
 
    <div class='calendar{{$i}}'></div>
</div>

  </div>
</div>
                        
                     
                    </div>
                   </div>
                 </div>
                 
                 <div class="modal fade" id="bookingModal{{$i}}" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title fs-5" id="bookingModalLabel">Book Teacher</h5>
        <button type="button" class="btn" data-dismiss="modal" aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
      </div>
      <div class="modal-body">
        <div class='calendar{{$i}}'></div>
      </div>
      <div class="modal-footer" style="text-align: center;background: #f5f5f5;display:initial;">
          The calender is in your time zone<br>
         {{$timezone}}
      </div>
    </div>
  </div>
</div>
                 @php $i++;@endphp
                 @endforeach



               

              

              
                   @if($subject_teachers->hasPages())
                 <div class="pagination">
                  <ul>
                    <li>{{$subject_teachers->links()}}</li>
                  </ul>
                </div>
                @endif

               </div>
           
               
             </div>
           </div>
         </div>
    </div>
   
    <!----cta ends---->



    <div class="modal fade" id="viewDetailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Teacher Availability</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      
          <!--starts here-->

            <table class="table table-bordered table-striped" id="teacher_view">
  
            </table>

          <!--ends here-->
   
      </div>
       <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>




<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Your Booking details:</h4>
      </div>
      <div class="modal-body">
       <form action="{{route('book')}}" method="post">
           @csrf
         
          <div class="form-group">
    <label for="teacher_name">Teacher Name:</label>
      <span id="teacher_name"></span>
  </div>
  
  <div class="form-group">
    <label for="date">Date:</label>
      <span id="date"></span>
  </div>
  
  <div class="form-group">
    <label for="day">Day:</label>
      <span id="day"></span>
  </div>
  
   <div class="form-group">
    <label for="time">Time:</label>
      <span id="time"></span>
  </div>
  
    <div class="form-group">
    <label for="amount">Amount:</label>
      <span id="currency"></span><span id="amount"></span>
  </div>
  
  
  
  
 
  
  
  
  
                        <input type="hidden" name="teacher_id" id="teacher_id">
                        <input type="hidden" name="date" id="date2">
                        <input type="hidden" name="day" id="day2">
                        <input type="hidden" name="time" id="time2">
                        <input type="hidden" name="amount" id="amount2">
                        <input type="hidden" name="currency" id="currency2">
                        <input type="hidden" name="id" id="id">
  
  <button type="submit" class="btn btn-lg btn-success">Book Now</button>
    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
</form>
      </div>
      
     
    </div>

  </div>
</div>

<div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title fs-5" id="bookingModalLabel">Book a 50-min trial lesson</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div id="picker"></div>
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
        <input type="hidden" name="" id="selected-date"> <!-- get the selected date -->
        <input type="hidden" name="" id="selected-time"> <!-- get the selected time -->
        <button type="button" class="btn btn-primary">Confirm time</button>
      </div>
    </div>
  </div>
</div>

   @endsection