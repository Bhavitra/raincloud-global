     @php 
     use Stevebauman\Location\Facades\Location;
     use App\Models\Review;
     use App\Models\CurrencyValue;
     use App\Models\Country;
     use App\Models\Language;
     @endphp
     @extends('frontend.layouts.header')
     @section('content')
     
     @php
     
    
     $rupee='';
     if(Session::has("session_dollar")){
        $rupee = Session::get("session_dollar");
     }
     
     if(Session::has("session_rupee")){
     $rupee = Session::get("session_rupee");
    
     }
     

     
     @endphp
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
        <h2>Tutor Profile Details</h2>
        <p>You can see the tutor profile details.....
       </p>
      </div>
    </div>

    <div class="innermain" style="padding: 100px 0;">
         <div class="container">
           <div class="row">
             <div class="col-lg-12">
               <div class="book_a_tutor">
                 <h3>Tutor Profile</h3>
               </div>

               <div class="tutor_booking mt-5">
                   
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
                 
                 $language_name = Language::where('id',$teacher->language_id)->value('language_name');

              
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
                      
                      <h6 class="can_speak mb-2">Can Speaks: <span>{{$language_name}}</span></h6>
                      <h6 class="curr_loc mb-1">Current Location - <span>{{$c_name->country_name}}</span>&nbsp;&nbsp;<span>
                         
                          <img src="https://img.icons8.com/color/28/000000/{{$c_name->country_slug}}.png"/>
                          
                          
                          </span></h6>
                      <p class="mb-2 mt-0">I want to help you to learn <span>{{$teacher->subject_name}}</span></p>
  
                      <p class="pro mt-4">{{$teacher->teaching_experience}}</p>
                    </div>
   
                    <div class="right">
                        
                        
                      
                   

                       
                        
                        <p>
 
 
</p>

                        
                     
                    </div>
                   </div>
                 </div>
                



               

              

              
                  

               </div>
           
               
             </div>
           </div>
         </div>
    </div>
   
    <!----cta ends---->










   @endsection