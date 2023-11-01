@php
use App\Models\Review;
use App\Models\CurrencyValue;
use App\Models\ClassStatus;
use App\Models\TimezoneTime;
use App\Models\Availability;
use App\Http\Controllers\Frontend\FrontendController;
use App\Models\User;
$rupee = CurrencyValue::value('rupee_value');
$check_password = User::where('id',Auth::id())->value('google_id');

$ip2 = new FrontendController();
  $ip = $ip2->get_client_ip(); //$_SERVER['REMOTE_ADDR']
$ipInfo = file_get_contents('http://ip-api.com/json/' . $ip);
$ipInfo = json_decode($ipInfo);
 $timezone = $ipInfo->timezone;
 
 
@endphp
@extends('frontend.layouts.header')
@section('content')

        <script>sessionStorage.setItem("storage", "<?php echo $id; ?>");</script>
      
 

    <div class="innermain profile_section" style="padding: 100px 0;">
        <div class="container">
            <div class="row">
              <div class="col-lg-3">
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                  <a class="nav-link gh active" id="v-pills-account-tab" data-toggle="pill" href="#v-pills-account" role="tab" aria-controls="v-pills-account" aria-selected="true">Account</a>
                  
                   @if($check_password == null)
                  <a class="nav-link" id="v-pills-password-tab" data-toggle="pill" href="#v-pills-password" role="tab" aria-controls="v-pills-password" aria-selected="true">Password</a>
                  @endif
                  
                   <a class="nav-link" id="v-pills-class-tab" data-toggle="pill" href="#v-pills-class" role="tab" aria-controls="v-pills-class" aria-selected="true">Class History</a>
                    <a class="nav-link" id="v-pills-booking-tab" data-toggle="pill" href="#v-pills-booking" role="tab" aria-controls="v-pills-booking" aria-selected="true">Booking History</a>

                    
                     <form action ="javascript:void(0);" onclick="student_logout();">
                         <input type="submit" class="nav-link" style="color:red;cursor:pointer;" value="Logout">
                     </form>
                </div>
              </div>

              <div class="col-lg-9">
                <div class="tab-content" id="v-pills-tabContent">
                  <div class="tab-pane fade show active" id="v-pills-account" role="tabpanel" aria-labelledby="v-pills-account-tab">
                    <div class="profile_Settings account-settings">
                      <div class="heading py-3 px-4" style="background: #f9f9f9;">
                        <h3>Student Biodata Section</h3>

                           @if(Session::has('password_update'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                          {{Session::get('password_update')}}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif


                      </div>
                      <div class="body">
                      
                         <h4>Account Settings</h4>
                                    <hr>
                                    <form action="{{route('student.profile.update')}}" class="form" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="mb-3 row justify-content-between">
                                            <label for="staticEmail" class="col-sm-2 col-form-label">Profile image</label>
                                            <div class="col-sm-8">
                                              <div class="d-flex">
                                                <img class="mr-2 rounded" src="{{url('/')}}/frontend/images/{{Auth::user()->image}}" alt="" width="100" height="100">
                                                <input type="file" name="image" id="upload" class="">
                                              </div>
                                            </div>
                                          </div>
                                        <div class="mb-3 row justify-content-between">
                                            <label for="staticEmail" class="col-sm-2 col-form-label">Name</label>
                                            <div class="col-sm-8">
                                              <input type="text" class="form-control" name="name" id="staticEmail" value="{{Auth::user()->name}}">
                                            </div>
                                          </div>
                                        <div class="mb-3 row justify-content-between">
                                            <label for="staticEmail" class="col-sm-2 col-form-label text-nowrap">Phone number</label>
                                            <div class="col-sm-8">
                                              <input type="text" name="phone" class="form-control" id="staticEmail" value="{{Auth::user()->phone}}">
                                            </div>
                                          </div>
                                          <div class="row justify-content-center">
                                            <button class="btn btn-info mr-3" type="submit">Save settings</button>
                                            <button class="btn btn-danger" type="button" onclick="delete_account();">Delete account</button>
                                          </div>
                                    </form>
                      
                      
                        
                      </div>
                    </div>
                  </div>

                    
                  <div class="tab-pane fade" id="v-pills-password" role="tabpanel" aria-labelledby="v-pills-password-tab">
                    <div class="profile_Settings account-settings">

                     
                                    <form action="{{route('password.update')}}" method="post">
                                        @csrf
                                        <div class="my-5 row justify-content-between">
                                            <label for="staticEmail" class="col-sm-2 col-form-label">New password</label>
                                            <div class="col-sm-8">
                                              <input type="password" class="form-control" name="password" required>
                                              <span style="color:red;">{{$errors->first('password')}}</span>
                                            </div>

                                          </div>
                                        <div class="my-5 row justify-content-between">
                                            <label for="staticEmail" class="col-sm-2 col-form-label">Verify password</label>
                                            <div class="col-sm-8">
                                              <input type="password" class="form-control" name="password_confirmation" required>
                                               <span style="color:red;">{{$errors->first('password_confirmation')}}</span>
                                            </div>
                                          </div>
                                          <div class="row justify-content-center">
                                            <button class="btn btn-info mr-3" type="submit">Save settings</button>
                                          </div>
                                    </form>


                    </div>
                  </div>
                 




                         <div class="tab-pane fade" id="v-pills-class" role="tabpanel" aria-labelledby="v-pills-class-tab">
                    <div class="profile_Settings account-settings">



                    <table class="table table-striped mt-3" id="booking">
                                        <thead>
                                            <tr>
                                                <th>Teacher Name</th>
                                                <th>Subject</th>
                                                <th>Date</th>
                                                <th>Class Timing</th>
                                                <th>Action</th>
                                                <th>Status</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $time=''; @endphp
                                            @foreach($bookings as $booking)
                                            @php
                                               $book_count = Availability::where('id',$booking->duration_id)->where('cancelled','yes')->count();
                                            @endphp
                                            @if($booking->timezone != $timezone)
                                            @php 
                                            $time = TimezoneTime::where('availability_id',$booking->availability_id)->value('title');
                                            @endphp
                                            @else
                                              @php $time = Availability::where('id',$booking->availability_id)->value('title'); @endphp
                                            @endif
                                            @php
                                             $count = ClassStatus::where([['booking_id','=',$booking->booking_id],['class_status','=','completed']])->orWhere([['booking_id','=',$booking->booking_id],['class_status','=','cancelled']])->count();
                                            $review_count = Review::where('booking_id',$booking->booking_id)->count();

                                            @endphp
                                            <tr>
                                                <td>{{$booking->first_name}} {{$booking->last_name}}</td>
                                                <td>{{$booking->subject_name}}</td>
                                                <td>{{$booking->date}}</td>
                                                <td>{{ucfirst($booking->day)}} {{$time}}</td>
                                                
                                                <td>
                                                  @if($count<1)
                                                <form action="{{route('chat')}}" method="get" id="myForm">
               
                  <input type="hidden" name="student_id" value="{{$booking->student_id}}">
                  <input type="hidden" name="teacher_id" value="{{$booking->teacher_id}}">
                  <input type="hidden" name="booking_id" value="{{$booking->booking_id}}">
                  @if($book_count<1)
                  <input type="submit" class="btn btn-sm btn-primary" value="Chat with Teacher">
                      @else
                      <span style="color:red;">Not applicable due to cancellation by student</span>
                      @endif
                </form>
                @else
                <span style="color:red;">Not Applicable</span>
                @endif
                                                </td>
                                                
                                                
                                                <td>
                                                    @if($book_count<1)
                                                    @if($booking->class_status == 'pending')
                                                    <span style="color:green;">
                                                    Class Yet Not Started
                                                </span>
                                                @elseif($booking->class_status == 'cancelled')
                                                    <span style="color:red;">
                                                    Class has been cancelled
                                                </span>
                                                @else
                                                <span style="color:green;">
                                                    Class Completed
                                                </span>&nbsp;&nbsp;
                                                 @if($review_count>0)
                                                 <span style="color:red;">Reviewed</span>
                                                 @else
                                                <a href="" style="color:blue;" data-toggle="modal" data-target="#reviewModal" onclick="review_teacher({{$booking->teacher_id}},{{$booking->booking_id}});">Review</a>
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




                      <div class="tab-pane fade" id="v-pills-booking" role="tabpanel" aria-labelledby="v-pills-booking-tab">
                    <div class="profile_Settings account-settings">


                    <table class="table table-striped mt-3" id="example2">
                                        <thead>
                                            <tr>
                                                <th>Booking ID</th>
                                                <th>Reference ID</th>
                                                <th>Amount</th>
                                                <th>Date</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($bookings as $booking)
                                            @php
                                            $date = Carbon\Carbon::parse($booking->created_at)->format('d-m-Y h:i A'); 
                                            $start = Carbon\Carbon::now();
                                            $end = $booking->date;
                                            $difference = $start->diffInHours($end) . ':' . $start->diff($end)->format('%I:%S');
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
                                                <td>{{$booking->order_status}}</td>
                                                <td>
                                                    @if($difference>=24)
                                                     @if($count<1 && $teacher_cancel_status !='cancelled')
                                                    <a href="javascript:void(0);" style="color:green;" onclick="booking_cancel({{$booking->duration_id}})";>Cancel</a>
                                                   @endif
                                                    @endif
                                                    
                                                     @if($count>0)
                                                    <span style="color:red;">Cancelled by student</span>
                                                    @elseif($teacher_cancel_status =='cancelled')
                                                    <span style="color:red;">Cancelled by teacher</span>
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


<div class="modal fade" id="reviewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Teacher Review</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('student.review.add')}}" method="post">
            @csrf
  <div class="form-group">
    <label for="rating">Rating</label>
    <input type="text" class="form-control" name="rating" id="rating" placeholder="Enter rating here....">
  </div>
  <input type="hidden" name="teacher" id="teacher">
  <input type="hidden" name="booking" id="booking_review">
    <div class="form-group">
    <label for="review">Review</label>
    <textarea class="form-control" name="review" id="review" placeholder="Enter review here...."></textarea>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
      </div>
    </div>
  </div>
</div>

    @endsection