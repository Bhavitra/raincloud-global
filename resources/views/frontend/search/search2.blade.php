     @php 
     use Stevebauman\Location\Facades\Location;
     use App\Models\Review;
     use App\Models\CurrencyValue;
     $count = count($subject_teachers);
       $availabilities_monday = DB::table('availabilities')->join('teachers','teachers.id','=','availabilities.teacher_id')->where('deleted','no')->where('day','monday')->where('booked',null)->get();

        $availabilities_tuesday = DB::table('availabilities')->join('teachers','teachers.id','=','availabilities.teacher_id')->where('deleted','no')->where('day','tuesday')->where('booked',null)->get();

         $availabilities_wednesday = DB::table('availabilities')->join('teachers','teachers.id','=','availabilities.teacher_id')->where('deleted','no')->where('day','wednesday')->where('booked',null)->get();

          $availabilities_thursday = DB::table('availabilities')->join('teachers','teachers.id','=','availabilities.teacher_id')->where('deleted','no')->where('day','thursday')->where('booked',null)->get();

           $availabilities_friday = DB::table('availabilities')->join('teachers','teachers.id','=','availabilities.teacher_id')->where('deleted','no')->where('day','friday')->where('booked',null)->get();

            $availabilities_saturday = DB::table('availabilities')->join('teachers','teachers.id','=','availabilities.teacher_id')->where('deleted','no')->where('day','saturday')->where('booked',null)->get();

             $availabilities_sunday = DB::table('availabilities')->join('teachers','teachers.id','=','availabilities.teacher_id')->where('deleted','no')->where('day','sunday')->where('booked',null)->get();

             $rupee = CurrencyValue::value('rupee_value');



     @endphp
     @extends('frontend.layouts.header')
     @section('content')
    <!---TOP HEADER ENDS--->
   <style>
    
  .modal {
  padding: 0 !important; // override inline padding-right added from js
}
.modal .modal-dialog {
  width: 100%;
  max-width: none;
  height: 100%;
  margin: 0;
}
.modal .modal-content {
  height: 100%;
  border: 0;
  border-radius: 0;
}
.modal .modal-body {
  overflow-y: auto;
}

td{
  text-align:center;
}

</style>

    <!---TOP BANNER STARTS--->
    <div class="main-banner innersban" style="background:url(./img/jpg/innerbanner.jpg) 0 0 no-repeat"> 
      <div class="inner">
        <h2>Online English Tutors & Teachers for Private Lessons</h2>
        <p>Looking for an online English tutor? Preply is the leading online language learning platform worldwide. You can choose from 558 English teachers with an average rating of 4.87 out of 5 stars given by 3578 customers. Book a lesson with a private English teacher today and start learning. Not entirely happy with your tutor? No worries, Preply offers free tutor replacement till you're 100% satisfied.
       </p>
      </div>
    </div>

    <div class="innermain" style="padding: 100px 0;">
         <div class="container">
           <div class="row">
             <div class="col-lg-12">
               <div class="book_a_tutor">
                 <h3>BOOK A TUTOR FROM TUTOR LISTS</h3>
                 <p>{{$count}} {{strtolower($sub_name)}} 
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

                @foreach($subject_teachers as $teacher)
                @php

                 $ip = request()->ip();

                 $count = DB::table('bookings')->join('class_statuses','class_statuses.booking_id','=','bookings.id')->join('teachers','teachers.id','=','bookings.teacher_id')->where('teachers.id',$teacher->id)->where('class_statuses.class_status_deleted','=','no')->where('class_status','pending')->orWhere('class_status','completed')->count();

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
                      <h6 class="curr_loc mb-1">Current Location - <span>{{$country}}</span>&nbsp;&nbsp;<span><img src="https://img.icons8.com/color/28/000000/india.png"/></span></h6>
                      <p class="mb-2 mt-0">I want to help you to learn <span>{{$teacher->subject_name}}                     
                    <div class="right">
                      @if(count($availabilities_monday)>0 || count($availabilities_tuesday)>0 || count($availabilities_wednesday)>0 || count($availabilities_thursday)>0 || count($availabilities_friday)>0 || count($availabilities_saturday)>0 || count($availabilities_sunday)>0)
                       <h6>Availability</h6>
                      <button class="btn btn-lg btn-warning" data-toggle="modal" data-target="#viewDetailModal">View Details</button>
                      @endif

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
                      @if(count($availabilities_monday)>0 || count($availabilities_tuesday)>0 || count($availabilities_wednesday)>0 || count($availabilities_thursday)>0 || count($availabilities_friday)>0 || count($availabilities_saturday)>0 || count($availabilities_sunday)>0)
                       <select name="day" onchange="teacher_time(this.value,{{$teacher->id}});" required>
                          <option value="">--select day</option>
                           @if(count($availabilities_monday)>0)
                          <option value="monday">Monday</option>
                          @endif

                           @if(count($availabilities_tuesday)>0)
                          <option value="tuesday">Tuesday</option>
                          @endif

                           @if(count($availabilities_wednesday)>0)
                          <option value="wednesday">Monday</option>
                          @endif

                           @if(count($availabilities_thursday)>0)
                          <option value="thursday">Thursday</option>
                          @endif

                           @if(count($availabilities_friday)>0)
                          <option value="friday">Friday</option>
                          @endif

                           @if(count($availabilities_saturday)>0)
                          <option value="saturday">Saturday</option>
                          @endif

                           @if(count($availabilities_sunday)>0)
                          <option value="sunday">Sunday</option>
                          @endif

                        </select>
                        @endif

                        <input type="hidden" name="teacher_id" value="{{$teacher->id}}">
                        <input type="hidden" name="amount" value="{{$teacher->hourly_rate}}">
                        <div id="timing"></div><br>
                        @if(Auth::id())
                        @if(count($availabilities_monday)>0 || count($availabilities_tuesday)>0 || count($availabilities_wednesday)>0 || count($availabilities_thursday)>0 || count($availabilities_friday)>0 || count($availabilities_saturday)>0 || count($availabilities_sunday)>0)
                        <button type="submit" class="btn btn-lg btn-success">Book Now</button>
                      </form>
                        @endif
                        @else
                        <a href="{{route('student.login',['slug'=>'login'])}}" class="btn btn-md btn-primary">Login to Book</a>
                        @endif
                     
                    </div>
                   </div>
                 </div>
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
        <!--
        <table class="table table-bordered table-striped">
                <thead>
                    
                    <tr>
                        @if(count($availabilities_monday) > 0)
                        <th>Monday</th>
                        @endif

                         @if(count($availabilities_tuesday) > 0)
                        <th>Tuesday</th>
                        @endif
                        
                          @if(count($availabilities_wednesday) > 0)
                        <th>Wednesday</th>
                        @endif
                       
                         @if(count($availabilities_thursday) > 0)
                        <th>Thursday</th>
                        @endif

                          @if(count($availabilities_friday) > 0)
                        <th>Friday</th>
                        @endif

                          @if(count($availabilities_saturday) > 0)
                        <th>Saturday</th>
                        @endif

                          @if(count($availabilities_sunday) > 0)
                        <th>Sunday</th>
                        @endif
                    </tr>
                </thead>
                <tbody>

                    <tr>
                    @if(count($availabilities_monday) > 0)
                    @foreach($availabilities_monday as $monday)
                    <tr>
                        <td>{{$monday->duration}}</td>
                       
                    </tr>
                    @endforeach
                    @endif
                  </tr>


                      @if(count($availabilities_tuesday) > 0)
                    @foreach($availabilities_tuesday as $tuesday)
                    <tr>
                        <td>{{$tuesday->duration}}</td>
                       
                    </tr>
                    @endforeach
                    @endif


                      @if(count($availabilities_wednesday) > 0)
                    @foreach($availabilities_wednesday as $wednesday)
                    <tr>
                        <td>{{$wednesday->duration}}</td>
                       
                    </tr>
                    @endforeach
                    @endif


                      @if(count($availabilities_thursday) > 0)
                    @foreach($availabilities_thursday as $thursday)
                    <tr>
                        <td>{{$thursday->duration}}</td>
                       
                    </tr>
                    @endforeach
                    @endif

                     <tr>
                      @if(count($availabilities_friday) > 0)
                    @foreach($availabilities_friday as $friday)
                    <tr>
                        <td>{{$friday->duration}}</td>
                       
                    </tr>
                    @endforeach
                    @endif
                  </tr>


                      @if(count($availabilities_saturday) > 0)
                    @foreach($availabilities_saturday as $saturday)
                    <tr>
                        <td>{{$saturday->duration}}</td>
                       
                    </tr>
                    @endforeach
                    @endif


                      @if(count($availabilities_sunday) > 0)
                    @foreach($availabilities_sunday as $sunday)
                    <tr>
                        <td>{{$sunday->duration}}</td>
                       
                    </tr>
                    @endforeach
                    @endif
                    
                    
                </tbody>
            </table>
          -->
          <!--starts here-->

            <table class="table table-bordered table-striped">
              <thead>
                @if(count($availabilities_monday) > 0)
              <tr>
                <td colspan="6">Monday</td>
              </tr>
              @endif
            </thead>
            <tbody>
               @if(count($availabilities_monday) > 0)
              <tr>
                @foreach($availabilities_monday as $monday)
                <td>{{$monday->duration}}</td>
                  
                         @endforeach
              </tr>
              @endif
            </tbody>
            <thead>
               @if(count($availabilities_tuesday) > 0)
              <tr>
                <td colspan="6">Tuesday</td>
              </tr>
              @endif
            </thead>
            <tbody>
              @if(count($availabilities_tuesday) > 0)
              <tr>
                @foreach($availabilities_tuesday as $tuesday)
                <td>{{$tuesday->duration}}</td>
                  
                         @endforeach
              </tr>
              @endif
            </tbody>
             <thead>
               @if(count($availabilities_wednesday) > 0)
              <tr>
                <td colspan="6">Wednesday</td>
              </tr>
              @endif
            </thead>
            <tbody>
              @if(count($availabilities_wednesday) > 0)
              <tr>
                @foreach($availabilities_wednesday as $wednesday)
                <td>{{$wednesday->duration}}</td>
                  
                         @endforeach
              </tr>
              @endif
            </tbody>
            <thead>
               @if(count($availabilities_thursday) > 0)
              <tr>
                <td colspan="6">thursday</td>
              </tr>
              @endif
            </thead>
            <tbody>
              @if(count($availabilities_thursday) > 0)
              <tr>
                @foreach($availabilities_thursday as $thursday)
                <td>{{$thursday->duration}}</td>
                  
                         @endforeach
              </tr>
              @endif
            </tbody>
            <thead>
               @if(count($availabilities_friday) > 0)
              <tr>
                <td colspan="6">Friday</td>
              </tr>
              @endif
            </thead>
            <tbody>
              @if(count($availabilities_friday) > 0)
              <tr>
                @foreach($availabilities_friday as $friday)
                <td>{{$friday->duration}}</td>
                  
                         @endforeach
              </tr>
              @endif
            </tbody>
            <thead>
               @if(count($availabilities_saturday) > 0)
              <tr>
                <td colspan="6">Wednesday</td>
              </tr>
              @endif
            </thead>
            <tbody>
              @if(count($availabilities_saturday) > 0)
              <tr>
                @foreach($availabilities_saturday as $saturday)
                <td>{{$saturday->duration}}</td>
                  
                         @endforeach
              </tr>
              @endif
            </tbody>
            </table>

          <!--ends here-->
   
      </div>
       <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

   @endsection