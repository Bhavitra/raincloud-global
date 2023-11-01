@php 
use App\Models\Availability; 
use App\Models\Order;
use App\Models\Booking;
use App\Models\Currency;
use App\Models\CurrencyValue;
use App\Models\TimezoneTime;
use App\Models\User;
use App\Models\Teacher;
use app\Http\Controllers\Frontend\FrontendController;

  $rupee = CurrencyValue::value('rupee_value');
@endphp
@extends('frontend.layouts.header')
@section('content')

<h2>Booking Details</h2>
<table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">Booking ID</th>
      <th scope="col">Reference ID</th>
      <th scope="col">Teacher Name</th>
       <th scope="col">Subject</th>
    </tr>
  </thead>
  <tbody>
   @foreach($bookings as $booking)
    <tr>
      <td>{{$booking->booking_id}}</td>
      <td>{{$booking->reference_id}}</td>
      <td>{{$booking->first_name}} {{$booking->last_name}}</td>
      <td>{{$booking->subject_name}} > {{$booking->sub_sub_name}}</td>
    </tr>
    @endforeach
  </tbody>
</table>


<h2>Order Details</h2>
<table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">Order ID</th>
      <th scope="col">Class Date</th>
      <th scope="col">Day</th>
      <th scope="col">Duration</th>
      <th scope="col">Amount</th>
       <th scope="col">Booking Date</th>
        <th scope="col">Order Status</th>
    </tr>
  </thead>
  <tbody>
   @foreach($bookings as $booking)
   @php
  
    $ip = $ip_address;   //$ip_address;
$ipInfo = file_get_contents('http://ip-api.com/json/' . $ip);
$ipInfo = json_decode($ipInfo);
$timezone = $ipInfo->timezone;
date_default_timezone_set($timezone);
$duration='';
if($booking->timezone != $timezone){
   $duration = TimezoneTime::where('availability_id',$booking->duration_id)->value('title');
   }else{
   $duration = Availability::where('id',$booking->duration_id)->value('title');
   }
   $date_format = Order::where('id',$booking->id)->value('created_at');
   $date_format2 = Carbon\Carbon::parse($date_format)->format('h:i A');
   $date_format6 =  Carbon\Carbon::parse($date_format)->format('d-m-Y');
   $c = new FrontendController();
   $date_gh = $c->converToTz($date_format2,$timezone,$booking->timezone);
   $currency = Currency::where('currency_slug',$booking->currency)->value('currency_name');
   @endphp
    <tr>
     <td>{{$booking->id}}</td>
     <td>{{$booking->date}}</td>
     <td>{{Ucfirst($booking->day)}}</td>
     <td>{{$duration}}</td>
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
     <td>{{$date_format6}} {{ltrim($date_gh, '0');}}</td>
     <td>{{$booking->order_status}}</td>
    </tr>
    @endforeach
  </tbody>
</table>

@php

$order = DB::table('bookings')->join('orders','orders.booking_id','=','bookings.id')->join('subjects','subjects.id','bookings.subject_id')->join('availabilities','availabilities.id','orders.duration_id')->join('teachers','teachers.id','=','bookings.teacher_id')->where('is_seen','no')->join('users','users.id','=','bookings.student_id')->where('booking_deleted','no')->first();

$teacher_email = Teacher::where('id',$order->teacher_id)->value('email');

//date_default_timezone_set($timezone);

$ip = $ip_address;
$ipInfo = file_get_contents('http://ip-api.com/json/' . $ip);
$ipInfo = json_decode($ipInfo);
$timezone = $ipInfo->timezone;
date_default_timezone_set($timezone);

$date_format = Carbon\Carbon::parse($order->date)->format('d/m/Y h:i A');

$name = $order->first_name." ".$order->last_name;

$data = ['booking_id'=>$order->booking_id,'teacher_name'=>$name,'subject'=>$order->subject_name,'day'=>$order->day,'duration'=>$order->title,'date'=>$date_format];

Booking::where('student_id',Auth::id())->update(['is_seen'=>'yes']);

$email = User::where('id',Auth::id())->value('email');

 Mail::send('mail_student_booking', $data, function($message) use($email) {
         $message->to($email)->subject
            ('Order Details Message from Tutor');
         $message->from('support@raincloud-global.com','Order Details Message from Tutor');
      });


 $data_teacher = ['booking_id'=>$order->booking_id,'student_name'=>$order->name,'day'=>$order->day,'duration'=>$order->title,'date'=>$date_format];


  Mail::send('mail_teacher_booking', $data_teacher, function($message) use($teacher_email) {
         $message->to($teacher_email)->subject
            ('Order Details Message from Tutor');
         $message->from('support@raincloud-global.com','Order Details Message from Tutor');
      });



@endphp


@endsection