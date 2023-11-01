@php
use App\Models\SubSubject;
use App\Models\CurrencyValue;
use App\Models\Commission;
use App\Models\TutorIncomeStatus;
use App\Models\Availability;
use App\Models\ClassStatus;
$rupee = CurrencyValue::value('rupee_value');
$commission = Commission::value('tutor_commission');
$subject = DB::table('teachers')->join('subjects','subjects.id','=','teachers.subject_id')->where('email',Session::get('teacher_email'))->where('deleted','no')->where('status','active')->first();

           $sub_subject_count = SubSubject::where('sub_id',$subject->subject_id)->where('deleted','no')->count();

           $sub_subject = SubSubject::where('id',$subject->sub_subject_id)->where('sub_id',$subject->subject_id)->where('deleted','no')->first();

           $sub_subjects = SubSubject::where('id','<>',$subject->sub_subject_id)->where('sub_id',$subject->subject_id)->where('deleted','no')->get();

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



    <div class="innermain profile_section" style="padding: 100px 0;">
        <div class="container">
            <div class="row">
              <div class="col-lg-3">
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                  <a class="nav-link gh active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">About</a>
                  <!--
                  <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Photo</a>
                -->
                <!--
                  <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">Description</a>
                -->
                <!--
                  <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">Video</a>
                -->
                <!--
                  <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#subject" role="tab" aria-controls="v-pills-settings" aria-selected="false">Subjects</a>
                -->
                
                  <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="true">Booking</a>
                  <a class="nav-link" id="v-pills-income-tab" data-toggle="pill" href="#v-pills-income" role="tab" aria-controls="v-pills-income" aria-selected="true">Income</a>
                   <a class="nav-link" id="v-pills-student-tab" data-toggle="pill" href="#v-pills-student" role="tab" aria-controls="v-pills-student" aria-selected="true">Student Details</a>
                    <a class="nav-link bhalo" id="v-pills-availability-tab" data-toggle="pill" href="#v-pills-availability" role="tab" aria-controls="v-pills-availability" aria-selected="true">Availability</a>
                   {{--
                    <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#backgrounds" role="tab" aria-controls="v-pills-settings" aria-selected="false">Transaction History</a>
                    --}}

                     <a class="nav-link bhalo" id="v-pills-password-tab" data-toggle="pill" href="#v-pills-password" role="tab" aria-controls="v-pills-password" aria-selected="true">Change Password</a>

                     <a href="javascript:void();" class="nav-link" role="tab" style="color:red;" onclick="teacher_logout();">Logout</a>
                  <a class="nav-link" href="javascript:void();" onclick="teacher_delete();">Delete Account</a>
                </div>
              </div>

              <div class="col-lg-9">
                <div class="tab-content" id="v-pills-tabContent">
                  <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                    <div class="profile_Settings account-settings">
                      <div class="heading py-3 px-4" style="background: #f9f9f9;">
                        <h3>Teacher Biodata Section</h3>

                        @if(Session::has('password_update'))

                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                          {{Session::get('password_update')}}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>

                        @endif

                      </div>
                      <div class="body">
                      
                       

                        <div class="form">
                          <form action="{{route('teacher.profile.update')}}" method="post">
                            @csrf
                            <div class="row">
                              <div class="col">
                                <label>First Name</label>
                                <input type="text" name="first_name" class="form-control" value="{{$teacher->first_name}}">
                              </div>
                              <div class="col">
                                <label>Last Name</label>
                                <input type="text" name="last_name" class="form-control" value="{{$teacher->last_name}}">
                              </div>
                            </div>
                            <div class="row">
                              <div class="col">
                                <label for="">Country Origin</label>
                               <select class="form-control" name="country">
                                 <option value="{{$country->id}}">{{$country->country_name}}</option>
                                 @foreach($countries as $country)
                                       <option value="{{$country->id}}">{{$country->country_name}}</option>
                                 @endforeach
                               </select>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col">
                                <label>Language Spoken</label>
                                  <select class="form-control" name="language">
                                 <option value="{{$language->id}}">{{$language->language_name}}</option>
                                 @foreach($languages as $language)
                                       <option value="{{$language->id}}">{{$language->language_name}}</option>
                                 @endforeach
                               </select>
                              </div>
                              <div class="col">
                                <label>Level Name</label>
                                <select class="form-control" name="level">
                                 <option value="{{$level->id}}">{{$level->level_name}}</option>
                                 @foreach($levels as $level)
                                       <option value="{{$level->id}}">{{$level->level_name}}</option>
                                 @endforeach
                               </select>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col">
                                <label>Subject Taught</label>
                                <select class="form-control" name="subject" onchange="subject_value_change(this.value);">
                                 <option value="{{$subject->id}}">{{$subject->subject_name}}</option>
                                 @foreach($subjects as $subject)
                                       <option value="{{$subject->id}}">{{$subject->subject_name}}</option>
                                 @endforeach
                               </select>
                              </div>
                             
                            </div>
                               
                               @if($sub_subject_count>0)
                               <div class="row sub_subject2">
                              <div class="col">
                                <label>Sub Subject Taught</label>
                                <select class="form-control" name="sub_subject">
                                    <option value="{{$sub_subject->id}}">{{$sub_subject->sub_sub_name}}</option>
                                  @foreach($sub_subjects as $subject)
                                  <option value="{{$subject->id}}">{{$subject->sub_sub_name}}</option>
                                  @endforeach
                                 
                               </select>
                              </div>
                             
                            </div>
                            @endif

                             <div class="row sub_subject" style="display:none;">
                              <div class="col">
                                <label>Sub Subject Taught</label>
                                <select class="form-control" id="sub_subject_fetch" name="sub_subject">
                                
                                 
                               </select>
                              </div>
                             
                            </div>

                            <div class="row about-doller">
                              <div class="col-2">
                                <label>Hourly Rate</label>
                                @if($teacher->currency == 'dollar')
                               <span>
                                 <select name='currency'>
                                   <option value='dollar'>&#36;</option>
                                    <option value='inr'>&#8377;</option>
                                 </select>
                               </span>
                                 @else
                                <span>
                                  <select name='currency'>
                                   <option value='inr'>&#8377;</option>
                                   <option value='dollar'>&#36;</option>
                                 </select>
                               </span>
                                 @endif
                               <input type="text" name="rate" class="form-control" value="{{$teacher->hourly_rate}}" />
                              
                              </div>
                             
                            </div>

                            <div class="row">
                              <div class="col">
                                <label>Teaching Experience</label>
                      <textarea name="teaching_experience" class="form-control" id="teaching_experience">@php echo $teacher->teaching_experience; @endphp</textarea>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col">
                                <label>Describe your current situation</label>
                               <textarea name="current_situation" class="form-control" id="current_situation">@php echo $teacher->current_situation; @endphp</textarea>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col">
                                <label>Phone Number</label>
                                <input type="text" name="phone" class="form-control" value="{{$teacher->phone}}">
                              </div>
                            </div>
                           
                            <div class="row pt-3">
                              <div class="col d-flex justify-content-end">
                                <a href=""><button class="btn btn">Update</button></a>
                              </div>
                            </div>
                          </form>
                        </div>
                        
                      </div>
                    </div>
                  </div>


                  {{--starts here--}}


                   <div class="tab-pane fade" id="v-pills-income" role="tabpanel" aria-labelledby="v-pills-income-tab">
                    <div class="profile_Settings account-settings">
                      <div class="heading pl-3" style="background: #f9f9f9;">
                        <h3>Income Details</h3>
                      </div>

                                
                              <table id="booking" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Sl No</th>
                <th>Booking ID</th>
                <th>Reference ID</th>
                <th>Income</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
              @php $i=1; @endphp
             @foreach($bookings as $booking)
             @php 
             $date = Carbon\Carbon::parse($booking->date)->format('d/m/Y h:i A'); 
             $income = ($booking->amount)-($booking->amount*$commission/100);
             $status = TutorIncomeStatus::where('booking_id',$booking->booking_id)->value('income_status');
             $booking_count = Availability::where('id',$booking->duration_id)->where('cancelled','yes')->count();
             $teacher_cancel_status = ClassStatus::where('booking_id',$booking->booking_id)->value('class_status');
             @endphp
             <tr>
              <td>{{$i}}</td>
               <td>{{$booking->booking_id}}</td>
               <td>{{$booking->reference_id}}</td>
               <td>
                @if(Session::has('session_dollar') && ($booking->currency == 'inr'))
                          &#8377;  {{$booking->amount}}
                          @elseif(Session::has('session_rupee') && ($booking->currency == 'inr'))
                          @php
                          $dollar_value = ($booking->amount)/$rupee;
                          $dollar_value_format = round($dollar_value,2);
                           echo "$".$dollar_value_format;
                          @endphp
                           @elseif(Session::has('session_dollar') && ($booking->currency == 'dollar'))
                             @php
                          $dollar_value = ($booking->amount)*$rupee;
                          $dollar_value_format = round($dollar_value,2);
                           echo "&#8377;".$dollar_value_format;
                          @endphp
                            @elseif(Session::has('session_rupee') && ($booking->currency == 'dollar'))
                            ${{$booking->amount}}
                           @elseif(!Session::has('session_rupee') && !Session::has('dollar_rupee'))
                           @if($booking->currency == 'inr')
                           &#8377;
                           @else
                           $
                           @endif
                             {{$income}}
                          @endif

                           

                          <td>
                              @if($booking_count<1)
                              @if($teacher_cancel_status != 'cancelled')
                            @if($status == 'pending')
                          <span style="color:green;">Payment Not yet Received</span>
                          @elseif($status == 'cancelled')
                          <span style="color:red;">Payment Cancelled</span>
                          @else
                          <span style="color:green;">Payment Received</span>
                          @endif
                          @else
                           <span style="color:red;">Not applicable due to cancellation by teacher</span>
                          @endif
                          @else
                          <span style="color:red;">Not applicable due to cancellation by student</span>
                          @endif
                        </td>
              </td>
           
             </tr>
             @php $i++; @endphp
             @endforeach

        </tbody>
    </table>


                    </div>
                  </div>



                  {{--ends here--}}


                  <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                    <div class="profile_Settings account-settings">
                      <div class="heading pl-3" style="background: #f9f9f9;">
                        <h3>Booking Details</h3>
                      </div>

                      <div class="body p-5">
                        <div class="row prodesc">
                          <div class="col">
                            
      
                          
                              <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Booking ID</th>
                <th>Reference ID</th>
                <th>Amount</th>
                <th>Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>

             @foreach($bookings as $booking)
             @php 
             $date = Carbon\Carbon::parse($booking->date)->format('d/m/Y h:i A'); 
             $count = Availability::where('id',$booking->duration_id)->where('cancelled','yes')->count();
             $teacher_cancel_status = ClassStatus::where('booking_id',$booking->booking_id)->value('class_status');
             @endphp
             <tr>
               <td>{{$booking->booking_id}}</td>
               <td>{{$booking->reference_id}}</td>
               <td>
                @if(Session::has('session_dollar') && ($booking->currency == 'inr'))
                          &#8377;  {{$booking->amount}}
                          @elseif(Session::has('session_rupee') && ($booking->currency == 'inr'))
                          @php
                          $dollar_value = ($booking->amount)/$rupee;
                          $dollar_value_format = round($dollar_value,2);
                           echo "$".$dollar_value_format;
                          @endphp
                           @elseif(Session::has('session_dollar') && ($booking->currency == 'dollar'))
                             @php
                          $dollar_value = ($booking->amount)*$rupee;
                          $dollar_value_format = round($dollar_value,2);
                           echo "&#8377;".$dollar_value_format;
                          @endphp
                            @elseif(Session::has('session_rupee') && ($booking->currency == 'dollar'))
                            ${{$booking->amount}}
                           @elseif(!Session::has('session_rupee') && !Session::has('dollar_rupee'))
                           @if($booking->currency == 'inr')
                           &#8377;
                           @else
                           $
                           @endif
                             {{$booking->amount}}
                          @endif
              </td>
               <td>{{$date}}</td>
               <td>
                   @if($count>0)
                   <span style="color:red;">Cancelled by student</span>
                    @elseif($teacher_cancel_status == 'cancelled')
                   <span style="color:red;">Cancelled by teacher</span>
                   @else
                   <span style="color:green;">Confirmed</span>
                   @endif
                   
                   
                  
               </td>
             </tr>
             @endforeach

        </tbody>
    </table>
                               
                          
                          </div>
                        </div>
                        
                      </div>
                    </div>
                  </div>




                         <div class="tab-pane fade" id="v-pills-student" role="tabpanel" aria-labelledby="v-pills-student-tab">
                    <div class="profile_Settings account-settings">
                      <div class="heading pl-3" style="background: #f9f9f9;">
                        <h3>Student Details</h3>
                      </div>

                      <div class="body p-5">
                        <div class="row prodesc">
                          <div class="col">
                            
      
                          
                              <table id="example2" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Student ID</th>
                <th>Name</th>
                <th>Subject</th>
                <th>Date</th>
                <th>Class Timing</th>
                <th>Action</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bookings as $booking)
            @php
            //$count = ClassStatus::where('booking_id',$booking->booking_id)->where('class_status','completed')->where('class_status','cancelled')->count();
            $count = ClassStatus::where([['booking_id','=',$booking->booking_id],['class_status','=','completed']])->orWhere([['booking_id','=',$booking->booking_id],['class_status','=','cancelled']])->count();
             $booking_count = Availability::where('id',$booking->duration_id)->where('cancelled','yes')->count();
            @endphp
            <tr>
              <td>{{$booking->student_id}}</td>
              <td>{{$booking->name}}</td>
              <td>{{$booking->subject_name}}</td>
              <td>{{$booking->date}}</td>
              <td>{{ucfirst($booking->day)}} {{$booking->title}}</td>
              <td>
                  @if($booking_count<1)
                @if($count<1)
                <form action="{{route('chat')}}" method="get">
               
                  <input type="hidden" name="student_id" value="{{$booking->student_id}}">
                  <input type="hidden" name="teacher_id" value="{{$booking->teacher_id}}">
                  <input type="hidden" name="booking_id" value="{{$booking->booking_id}}">
                  <input type="submit" class="btn btn-sm btn-primary" value="Chat">
                </form>
                @else
                <span style="color:red;">Not Applicable</span>
                @endif
                @else
                <span style="color:red;">Not applicable due to cancellation by student</span>
                @endif
              </td>
               <td>
               @if($booking_count<1)
                @if($booking->class_status == 'pending')
                <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#updateModal" onclick="update_status({{$booking->booking_id}});">Update</button>
                @else
                @if($booking->class_status == 'cancelled')
                <button class="btn btn-sm btn-danger">Class has beeen cancelled</button>
                @endif
                 @if($booking->class_status == 'completed')
                <button class="btn btn-sm btn-success">Class is Completed</button>
                @endif
                @endif
                @else
               <span style="color:red;">Not applicable due to cancellation by student</span>
                @endif
              </td>
            </tr>
            @endforeach
        </tbody>
    </table>
                               
                          
                          </div>
                        </div>
                        
                      </div>
                    </div>
                  </div>




                         <div class="tab-pane fade" id="v-pills-availability" role="tabpanel" aria-labelledby="v-pills-availability-tab">
                    <div class="profile_Settings account-settings">
                      <div class="heading pl-3" style="background: #f9f9f9;">
                        <h3>Availability</h3>
                      </div>

                      <div class="body p-5">
                        <div class="row prodesc">
                          <div class="col">
                            
                           {{--
                          <div class="row">
                            <div class="col-sm-2">
                          <button data-toggle="collapse" class="btn btn-sm btn-primary" data-target="#demo">Monday</button>
                          
                          <div id="demo" class="collapse">
                          Lorem ipsum dolor text....
                          </div>
                        </div>
                           <div class="col-sm-2">
                           <button data-toggle="collapse" class="btn btn-sm btn-success"data-target="#demo1">Tuesday</button>

                          <div id="demo1" class="collapse">
                          Lorem ipsum dolor text....
                          </div>
                        </div>
                         <div class="col-sm-2">
                           <button data-toggle="collapse" class="btn btn-sm btn-info"data-target="#demo2">Wednesday</button>

                          <div id="demo2" class="collapse">
                          Lorem ipsum dolor text....
                          </div>
                        </div>

                         <div class="col-sm-2">
                           <button data-toggle="collapse" class="btn btn-sm btn-danger"data-target="#demo3">Thursday</button>

                          <div id="demo3" class="collapse">
                          Lorem ipsum dolor text....
                          </div>
                        </div>

                         <div class="col-sm-2">
                           <button data-toggle="collapse" class="btn btn-sm btn-primary"data-target="#demo4">Friday</button>

                          <div id="demo4" class="collapse">
                          Lorem ipsum dolor text....
                          </div>
                        </div>

                         <div class="col-sm-2">
                           <button data-toggle="collapse" class="btn btn-sm btn-success"data-target="#demo5">Saturday</button>

                          <div id="demo5" class="collapse">
                          Lorem ipsum dolor text....
                          </div>
                        </div>

                      </div>

                      <div class="row" style="margin-top:10px;">

                        <div class="col-sm-2">
                           <button data-toggle="collapse" class="btn btn-sm btn-primary"data-target="#demo7">Sunday</button>

                          <div id="demo7" class="collapse">
                          Lorem ipsum dolor text....
                          </div>
                        </div>
                        
                      </div>
                      --}}

                      @if(Session::has('timing_success'))

                    
                      <div class="alert alert-success alert-dismissible fade show" role="alert">
   {{Session::get('timing_success')}}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>

                      @endif

                        @if(Session::has('checkbox_select'))

                       <div class="alert alert-danger alert-dismissible fade show" role="alert">
   {{Session::get('checkbox_select')}}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>

                      @endif

{{--
                      <form action="{{route('teacher.availability')}}" method="post">
                        @csrf
  <div class="form-group">
    <label for="exampleInputEmail1">Day</label>
   <select class="form-control" name="day" required>
    <option value="">--Select Day--</option>
    <option value="monday">Monday</option>
    <option value="tuesday">Tuesday</option>
    <option value="wednesday">Wednesday</option>
    <option value="thursday">Thursday</option>
    <option value="friday">Friday</option>
    <option value="saturday">Saturday</option>
    <option value="sunday">Sunday</option>
   </select>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1"><fieldset>
  <legend>Choose your timings</legend>
  <div>
    <input type="checkbox" id="coding" name="services[]" value="6AM-7AM"/>
    <label for="coding">6AM-7AM</label>&nbsp;&nbsp;
    <input type="checkbox" id="music" name="services[]" value="7AM-8AM">
    <label for="music">7AM-8AM</label>&nbsp;&nbsp;
    <input type="checkbox" id="coding" name="services[]" value="8AM-9AM" />
    <label for="coding">8AM-9AM</label>&nbsp;&nbsp;
    <input type="checkbox" id="coding" name="services[]" value="9AM-10AM" />
    <label for="coding">9AM-10AM</label>&nbsp;&nbsp;
    <input type="checkbox" id="coding" name="services[]" value="10AM-11AM" />
    <label for="coding">10AM-11AM</label>&nbsp;&nbsp;
    <input type="checkbox" id="coding" name="services[]" value="11AM-12PM"/>
    <label for="coding">11AM-12PM</label>&nbsp;&nbsp;
     <input type="checkbox" id="coding" name="services[]" value="12PM-1PM" />
    <label for="coding">12PM-1PM</label>&nbsp;&nbsp;
     <input type="checkbox" id="coding" name="services[]" value="1PM-2PM" />
    <label for="coding">1PM-2PM</label>&nbsp;&nbsp;
      <input type="checkbox" id="coding" name="services[]" value="2PM-3PM" />
    <label for="coding">2PM-3PM</label>&nbsp;&nbsp;
      <input type="checkbox" id="coding" name="services[]" value="3PM-4PM" />
    <label for="coding">3PM-4PM</label>&nbsp;&nbsp;
      <input type="checkbox" id="coding" name="services[]" value="4PM-5PM" />
    <label for="coding">4PM-5PM</label>&nbsp;&nbsp;
      <input type="checkbox" id="coding" name="services[]" value="5PM-6PM" />
    <label for="coding">5PM-6PM</label>&nbsp;&nbsp;
      <input type="checkbox" id="coding" name="services[]" value="6PM-7PM" />
    <label for="coding">6PM-7PM</label>&nbsp;&nbsp;
      <input type="checkbox" id="coding" name="services[]" value="7PM-8PM" />
    <label for="coding">7PM-8PM</label>&nbsp;&nbsp;
      <input type="checkbox" id="coding" name="services[]" value="8PM-9PM" />
    <label for="coding">8PM-9PM</label>&nbsp;&nbsp;
      <input type="checkbox" id="coding" name="services[]" value="9PM-10PM" />
    <label for="coding">9PM-10PM</label>&nbsp;&nbsp;
      <input type="checkbox" id="coding" name="services[]" value="10PM-11PM" />
    <label for="coding">10PM-11PM</label>
  </div>
</fieldset>
</label>
   
  </div>
  <button type="submit" class="btn btn-primary">Add</button>
  <a href="#detailsModal" data-toggle="modal" data-target="#detailsModal">Details</a>
</form>
--}}

<div class="container">
    <h1>Availability Calender</h1>
    <div id='calendar'></div>
</div>
                               
                          
                          </div>
                        </div>
                        
                      </div>
                    </div>
                  </div>



                  <!--starts herew-->


                       <div class="tab-pane fade" id="v-pills-password" role="tabpanel" aria-labelledby="v-pills-password-tab">
                    <div class="profile_Settings account-settings">
                      <div class="heading pl-3" style="background: #f9f9f9;">
                        <h3>Change Password</h3>
                      </div>

                      <div class="body p-5">
                        <div class="row prodesc">
                          <div class="col">
                            
      
                          <form action="{{route('teacher.new.password.update')}}" method="post">
                            @csrf
  <div class="form-group">
    <label for="new_password">New Password</label>
    <input type="password" class="form-control" name="password" placeholder="Enter new password" required>
    <span style="color:red;">{{$errors->first('password')}}</span>
  </div>
  <div class="form-group">
    <label for="confirm_new_password">Confirm New Password</label>
    <input type="password" class="form-control"  name="password_confirmation" placeholder="Confirm New Password" required>
    <span style="color:red;">{{$errors->first('confirm_password')}}</span>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
                            
                               
                          
                          </div>
                        </div>
                        
                      </div>
                    </div>
                  </div>


                  <!--ends here-->
           
             
             
                </div>
              </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="detailsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Timing Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <select name="day" id="day" onchange="day(this.value);">
          <option value="">--Select Day--</option>
          <option value="monday">Monday</option>
          <option value="tuesday">Tuesday</option>
          <option value="wednesday">Wednesday</option>
          <option value="thursday">Thursday</option>
          <option value="friday">Friday</option>
          <option value="saturday">Saturday</option>
          <option value="sunday">Sunday</option>
        </select>
        <div id="fetch_value"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Class Status</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <form action="{{route('teacher.student.status.update')}}" method="post">
        @csrf
  <div class="form-group">
    <label>Status</label>
      <select name="status" required>
        <option value="">--Select Status--</option>
        <option value="cancelled">Cancelled</option>
        <option value="completed">Completed</option>
      </select>
      <input type="hidden" name="booking_id" id="status">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
      </div>
      
    </div>
  </div>
</div>
    @endsection