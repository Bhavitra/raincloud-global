<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\About;
use App\Models\Teacher;
use App\Models\Subject;
use App\Models\Availability;
use App\Models\Booking;
use App\Models\SubSubject;
use App\Models\Order;
use App\Models\User;
use App\Models\ClassStatus;
use App\Models\Chat;
use App\Models\CurrencyValue;
use App\Models\TutorIncomeStatus;
use App\Models\Commission;
use App\Models\TimezoneTime;
use Carbon\Carbon;
use DateTime;
use DateTimeZone;
use DB;
use Auth;
use Hash;
use Session;

class FrontendController extends Controller
{
    //function for index page
    public function index(){
        //starts here
        
        $ip = $this->get_client_ip();  //$this->get_client_ip();  //$_SERVER['REMOTE_ADDR']
$ipInfo = file_get_contents('http://ip-api.com/json/' . $ip);
$ipInfo = json_decode($ipInfo);
 $timezone = $ipInfo->timezone;

//date_default_timezone_set($timezone);
//echo date_default_timezone_get();
//echo date('Y/m/d H:i:s');
$availabilities = Availability::where('booked',null)->get();

foreach($availabilities as $availability){
    
    $teacher_timezone = Teacher::where('id',$availability->teacher_id)->value('timezone');
 
    
    //if($teacher_timezone != $timezone){
        
        $id = 0;
        
        if(Auth::id()){
            
            $id = Auth::id();
        }else{
            
            $id=0;
        }
        
        $param1 = $this->converToTz($availability->title1,$timezone,$teacher_timezone);
        $param2 = $this->converToTz($availability->title2,$timezone,$teacher_timezone);
        $param12 = ltrim($param1, '0');
        $param26 = ltrim($param2, '0');
        $title = $param12.'-'.$param26;
        $time = new TimezoneTime();
        $time->availability_id = $availability->id;
        $time->ip_address = $ip;
        $time->user_id = $id;
        $time->title = $title;
        $time->start = $availability->start;
        $time->end = $availability->end;
        $time->teacher_id = $availability->teacher_id;
        $time->timezone = $timezone;
        $count = TimezoneTime::where('ip_address',$ip)->where('availability_id',$availability->id)->count();
        if($count<1){
        $time->save();
        }
        
   //}
   
   
}



        
        //ends here
      $sliders = Slider::where('deleted','no')->orderby('id','desc')->get();
      $about = About::first();
      $teachers = DB::table('teachers')->join('subjects','subjects.id','=','teachers.subject_id')->select('teachers.id','teachers.first_name','teachers.last_name','subjects.subject_name','teachers.teaching_experience')->where('otp_verified','yes')->where('teacher_deleted','no')->where('status','active')->get();
      return view('frontend.index',compact('sliders','about','teachers'));
    }
    
    
    function converToTz($time="",$toTz='',$fromTz='')
    {   
        // timezone by php friendly values
        $date = new DateTime($time, new DateTimeZone($fromTz));
        $date->setTimezone(new DateTimeZone($toTz));
        $time= $date->format('h:i A');
        return $time;
    }


    function get_client_ip() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
       $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}


public function getCountry($ipadr) {
    if(isset($ipadr)) {
        $details = file_get_contents('http://www.geoplugin.net/json.gp?ip=' . $ipadr);
        $json = json_decode($details);
        if($json->geoplugin_status == '200')
            return $json->geoplugin_countryName;
        else
            return 'Error getting country name.';
    } else {
        return 'IP is empty.';
    }
}
    

    //function for search
    public function search(Request $request){
        
        $currenturl = url()->full();
        
        Session::put('session_full_url',$currenturl);
        
        $ip = $this->getIp();
        $ipdat = @json_decode(file_get_contents(
    "http://www.geoplugin.net/json.gp?ip=" . $ip));
   
        $country2 = $ipdat->geoplugin_countryName;
        $subject_teachers = '';
        $subject_count = Subject::where('subject_name','LIKE','%'.$request->search.'%')->count();
        $i=0;
        if($subject_count>0){
            $i=1;
        $subject_teachers = DB::table('subjects')->join('teachers','teachers.subject_id','=','subjects.id')->join('currencies','currencies.currency_slug','=','teachers.currency')->join('languages','languages.id','=','teachers.language_id')->where('subject_name','LIKE','%'.$request->search.'%')->select('teachers.id','subjects.subject_name','teachers.created_at','teachers.first_name','teachers.last_name','currencies.currency_name','teachers.hourly_rate','languages.language_name','teachers.teaching_experience','teachers.currency','teachers.country_id')->where('teachers.teacher_deleted','no')->where('otp_verified','yes')->where('status','active')->where('subjects.deleted','no')->paginate(10);
        }else{
            $i=2;
           $subject_teachers = DB::table('sub_subjects')->join('subjects','subjects.id','=','sub_subjects.sub_id')->join('teachers','teachers.sub_subject_id','=','sub_subjects.id')->join('currencies','currencies.currency_slug','=','teachers.currency')->join('languages','languages.id','=','teachers.language_id')->where('sub_sub_name','LIKE','%'.$request->search.'%')->select('teachers.id','sub_subjects.sub_sub_name','teachers.created_at','teachers.first_name','teachers.last_name','currencies.currency_name','teachers.hourly_rate','languages.language_name','teachers.teaching_experience','teachers.currency','teachers.country_id','subjects.subject_name')->where('teachers.teacher_deleted','no')->where('otp_verified','yes')->where('status','active')->where('subjects.deleted','no')->where('sub_subjects.deleted','no')->paginate(10);  
        }
         $ip_address = $this->getIp();
         $ip = $ip_address;
         $country = $this->getCountry($ip);


        $sub_name = Subject::where('subject_name','LIKE','%'.$request->search.'%')->value('subject_name');
        $sub_sub_name = SubSubject::where('sub_sub_name','LIKE','%'.$request->search.'%')->value('sub_sub_name');

       

        return view('frontend.search.search',compact('subject_teachers','sub_name','country2','sub_sub_name','i','ip'));
    }

    
    //function for teacher timing
    public function teacher_timing(Request $request){
           $html = '';
           if($request->day != null){
           $teacher_timings = Availability::where('day',$request->day)->where('teacher_id',$request->id)->where('deleted','no')->where('booked',null)->get();
             
            if(count($teacher_timings)>0){
           foreach($teacher_timings as $timing){

              $html.="<input type='radio' name='timing' value='".$timing->duration."' required>".$timing->duration."&nbsp;&nbsp;";
           }
         }else{
          $html = '';
         }
       }else{
        $html = '';
       }

           return response()->json($html);
    }


     //function for ip
    public function getIp(){
     $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
       $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}


     
     //function for booking
    public function book(Request $request){
        $ip_address = $this->getIp();
          $ip = $ip_address;
   $ipInfo = file_get_contents('http://ip-api.com/json/' . $ip);
   $ipInfo = json_decode($ipInfo);
   $timezone = $ipInfo->timezone;
   date_default_timezone_set($timezone);
   
      $subject_id = Teacher::where('id',$request->teacher_id)->value('subject_id');
      $sub_subject_id = Teacher::where('id',$request->teacher_id)->value('sub_subject_id');
      //$duration_id = Availability::where('teacher_id',$request->teacher_id)->where('day',$request->day)->where('duration',$request->timing)->where('deleted','no')->value('id');

      Availability::where('id',$request->id)->update(['booked'=>'yes']);
      
      $commission = Commission::value('tutor_commission');
      
      $teacher_commission = ($request->amount)-($request->amount*$commission/100);
      $admin_commission = $request->amount*$commission/100;

      $booking = new Booking();
      $booking->reference_id = rand(1,10000);
      $booking->teacher_id = $request->teacher_id;
      $booking->student_id = Auth::id();
      $booking->subject_id = $subject_id;
      $booking->sub_subject_id = $sub_subject_id;
      $booking->availability_id = $request->id;
      $booking->teacher_commission = $teacher_commission;
      $booking->admin_commission = $admin_commission;
      $booking->save();

      $id = $booking->id;

      $class_status = new ClassStatus();
      $class_status->booking_id = $id;
      $class_status->save();

      $income = new TutorIncomeStatus;
      $income->booking_id = $id;
      $income->income_status = 'pending';
      $income->save();

      $order = new Order();
      $order->booking_id = $id;
      $order->duration_id = $request->id;
      $order->amount = $request->amount;
      $order->currency = $request->currency;
      $order->date = $request->date;
      $order->day = $request->day;
      $order->order_status = "Completed";
      $order->save();

      $ip_address = $this->getIp();
      $ip = $ip_address;
      $ipInfo = file_get_contents('http://ip-api.com/json/' . $ip);
       $ipInfo = json_decode($ipInfo);
       //$timezone = $ipInfo->timezone;

      return redirect()->route('payment_success');

    }
    
    
    
      


    //function for payment success
    public function payment_success(){
        $ip_address = $this->getIp();
       $bookings = DB::table('bookings')->join('orders','orders.booking_id','=','bookings.id')->join('teachers','teachers.id','=','bookings.teacher_id')->join('sub_subjects','sub_subjects.id','=','bookings.sub_subject_id')->join('subjects','subjects.id','=','teachers.subject_id')->where('student_id',Auth::id())->where('is_seen','no')->select('orders.booking_id','orders.id','teachers.first_name','teachers.last_name','subjects.subject_name','sub_subjects.sub_sub_name','bookings.reference_id','orders.duration_id','orders.day','orders.amount','orders.order_status','teachers.currency','bookings.created_at','orders.date','timezone')->get();
       return view('frontend.payment_success',compact('bookings','ip_address'));
    }


    public function student_delete(){
           $id = Auth::id();
                  $order_booking_id = Booking::where('student_id',$id)->value('id');
                  Booking::where('student_id',$id)->update(['booking_deleted'=>'yes']);
                  Order::where('booking_id',$order_booking_id)->update(['order_deleted'=>'yes']);
                  ClassStatus::where('booking_id',$order_booking_id)->update(['class_status_deleted'=>'yes']);

                  Auth::logout();
                  Session::regenerate();

          User::where('id',$id)->update(['deleted'=>'yes']);
    }


     public function student_logout(){
          Auth::logout();
          Session::regenerate();
    }

    public function password_update(Request $request){

                $request->validate([
                    'password' => 'required|confirmed',
                    'password_confirmation' => 'required'
                ]);

                User::where('id',Auth::id())->update(['password'=>Hash::make($request->password)]);

                return redirect()->back()->with('password_update',"Password updated successfully");
    }


    public function usd(){

        $currecy_value_usd = CurrencyValue::first();
        $rupees = $currecy_value_usd->rupee_value;

        Session::put('session_rupee',$rupees);

         Session::forget('session_dollar');

        return redirect()->back();
    }


     public function inr(){

        $currecy_value_rupee = CurrencyValue::first();
        $dollar = $currecy_value_rupee->rupee_value;

        Session::put('session_dollar',$dollar);

        Session::forget('session_rupee');

        return redirect()->back();
    }


    public function chat(Request $request){

          $booking_id = $request->booking_id;
          $student_id = $request->student_id;
          $teacher_id = $request->teacher_id;

         return view('frontend.chat.chat',compact('booking_id','student_id','teacher_id'));

    }


    public function get_value(Request $request){
       
       parse_str($_GET['values'], $searcharray);
         //echo json_encode($searcharray['booking_id']);

       $chat = new Chat();
       $chat->booking_id = $searcharray['booking_id'];
       $chat->sender_id = $searcharray['teacher_id'];
       $chat->recepient_id = $searcharray['student_id'];
       $chat->chat = $searcharray['message'];
       $chat->save();

       $chats = Chat::get();
       $html = '';
       foreach($chats as $chat){
        if($chat->sender_id == $searcharray['teacher_id'] && $chat->recepient_id == $searcharray['student_id'] && $chat->booking_id == $searcharray['booking_id']){
           
           $html.='<div class="d-flex justify-content-end align-items-center mb-2">
                        <div class="px-3 py-2 outgoing-text">
                          <p class="m-auto">'.$chat->chat.'</p>
                        </div>
                      </div>';
        }else if($chat->sender_id == $searcharray['student_id'] && $chat->recepient_id == $searcharray['teacher_id'] && $chat->booking_id == $searcharray['booking_id']){

            $html.='<div class="d-flex justify-content-start align-items-center mb-2">
                        <div class="px-3 py-2 bg-light incoming-text">
                          <p class="m-auto">'.$chat->chat.'</p>
                        </div>
                      </div>';
        }
       }

       echo json_encode($html);

    }


    public function get_value_json(Request $request){
       
       //parse_str($_GET['booking_id'], $searcharray);
         //echo json_encode($searcharray['booking_id']);

       

       $chats = Chat::get();
       $html = '';
       foreach($chats as $chat){
        if($chat->sender_id == $request->teacher_id && $chat->recepient_id == $request->student_id && $chat->booking_id == $request->booking_id){
           
           $html.='<div class="d-flex justify-content-end align-items-center mb-2">
                        <div class="px-3 py-2 outgoing-text">
                          <p class="m-auto">'.$chat->chat.'</p>
                        </div>
                      </div>';
        }else if($chat->sender_id == $request->student_id && $chat->recepient_id == $request->teacher_id && $chat->booking_id == $request->booking_id){

            $html.='<div class="d-flex justify-content-start align-items-center mb-2">
                        <div class="px-3 py-2 bg-light incoming-text">
                          <p class="m-auto">'.$chat->chat.'</p>
                        </div>
                      </div>';
        }
       }

       echo json_encode($html);

    }


    public function testing(){

            $teachers = Teacher::get();

        return view('frontend.test_chat',compact('teachers'));
    }
    
    
        //function for subject search
    public function subject_search($slug){
        $id='';
        if(Auth::id()){
          $id = Auth::id();
        }
        $ip = $this->getIp();
        $ipdat = @json_decode(file_get_contents(
    "http://www.geoplugin.net/json.gp?ip=" . $ip));
   
        $country2 = $ipdat->geoplugin_countryName;
        $subject_teachers = '';
        $subject_count = Subject::where('subject_name','LIKE','%'.$slug.'%')->count();
        $i=0;
        if($subject_count>0){
            $i=1;
        $subject_teachers = DB::table('subjects')->join('teachers','teachers.subject_id','=','subjects.id')->join('currencies','currencies.currency_slug','=','teachers.currency')->join('languages','languages.id','=','teachers.language_id')->where('subject_name','LIKE','%'.$slug.'%')->select('teachers.id','subjects.subject_name','teachers.created_at','teachers.first_name','teachers.last_name','currencies.currency_name','teachers.hourly_rate','languages.language_name','teachers.teaching_experience','teachers.currency','teachers.country_id')->where('teachers.teacher_deleted','no')->where('otp_verified','yes')->where('status','active')->paginate(10);
        }else{
            $i=2;
           $subject_teachers = DB::table('sub_subjects')->join('subjects','subjects.id','=','sub_subjects.sub_id')->join('teachers','teachers.sub_subject_id','=','sub_subjects.id')->join('currencies','currencies.currency_slug','=','teachers.currency')->join('languages','languages.id','=','teachers.language_id')->where('sub_sub_name','LIKE','%'.$slug.'%')->select('teachers.id','sub_subjects.sub_sub_name','teachers.created_at','teachers.first_name','teachers.last_name','currencies.currency_name','teachers.hourly_rate','languages.language_name','teachers.teaching_experience','teachers.currency','teachers.country_id','subjects.subject_name')->where('teachers.teacher_deleted','no')->where('otp_verified','yes')->where('status','active')->paginate(10);  
        }
         $ip_address = $this->getIp();
         $ip = $ip_address;
         $country = $this->getCountry($ip);


        $sub_name = Subject::where('subject_name','LIKE','%'.$slug.'%')->value('subject_name');
        $sub_sub_name = SubSubject::where('sub_sub_name','LIKE','%'.$slug.'%')->value('sub_sub_name');

       

        return view('frontend.search.search',compact('subject_teachers','sub_name','country2','sub_sub_name','i','ip','id'));
    }
    
    
    
    
        public function subject_search6($slug){
        $id='';
        if(Auth::id()){
          $id = Auth::id();
        }
        $ip = $this->getIp();
        $ipdat = @json_decode(file_get_contents(
    "http://www.geoplugin.net/json.gp?ip=" . $ip));
   
        $country2 = $ipdat->geoplugin_countryName;
        $subject_teachers = '';
        $subject_count = Subject::where('subject_name','LIKE','%'.$slug.'%')->count();
        $i=0;
        if($subject_count>0){
            $i=1;
        $subject_teachers = DB::table('subjects')->join('teachers','teachers.subject_id','=','subjects.id')->join('currencies','currencies.currency_slug','=','teachers.currency')->join('languages','languages.id','=','teachers.language_id')->where('subject_name','LIKE','%'.$slug.'%')->select('teachers.id','subjects.subject_name','teachers.created_at','teachers.first_name','teachers.last_name','currencies.currency_name','teachers.hourly_rate','languages.language_name','teachers.teaching_experience','teachers.currency','teachers.country_id')->where('teachers.teacher_deleted','no')->where('otp_verified','yes')->where('status','active')->paginate(10);
        }else{
            $i=2;
           $subject_teachers = DB::table('sub_subjects')->join('subjects','subjects.id','=','sub_subjects.sub_id')->join('teachers','teachers.sub_subject_id','=','sub_subjects.id')->join('currencies','currencies.currency_slug','=','teachers.currency')->join('languages','languages.id','=','teachers.language_id')->where('sub_sub_name','LIKE','%'.$slug.'%')->select('teachers.id','sub_subjects.sub_sub_name','teachers.created_at','teachers.first_name','teachers.last_name','currencies.currency_name','teachers.hourly_rate','languages.language_name','teachers.teaching_experience','teachers.currency','teachers.country_id','subjects.subject_name')->where('teachers.teacher_deleted','no')->where('otp_verified','yes')->where('status','active')->paginate(10);  
        }
         $ip_address = $this->getIp();
         $ip = $ip_address;
         $country = $this->getCountry($ip);


        $sub_name = Subject::where('subject_name','LIKE','%'.$slug.'%')->value('subject_name');
        $sub_sub_name = SubSubject::where('sub_sub_name','LIKE','%'.$slug.'%')->value('sub_sub_name');

       

        return view('frontend.search.search6',compact('subject_teachers','sub_name','country2','sub_sub_name','i','ip','id'));
    }
    
    
        //function for teacher detail listing
        public function teacher_detail_listing(Request $request){
        
              $availabilities_monday = Availability::where('teacher_id',$request->id)->where('deleted','no')->where('day','monday')->where('booked',null)->get();
              $availabilities_tuesday = Availability::where('teacher_id',$request->id)->where('deleted','no')->where('day','tuesday')->where('booked',null)->get();
              $availabilities_wednesday = Availability::where('teacher_id',$request->id)->where('deleted','no')->where('day','wednesday')->where('booked',null)->get();
              $availabilities_thursday = Availability::where('teacher_id',$request->id)->where('deleted','no')->where('day','thursday')->where('booked',null)->get();
              $availabilities_friday = Availability::where('teacher_id',$request->id)->where('deleted','no')->where('day','friday')->where('booked',null)->get();
              $availabilities_saturday = Availability::where('teacher_id',$request->id)->where('deleted','no')->where('day','saturday')->where('booked',null)->get();
              $availabilities_sunday = Availability::where('teacher_id',$request->id)->where('deleted','no')->where('day','sunday')->where('booked',null)->get();
              
                 $html = '<thead>';
                 if(count($availabilities_monday) > 0){
                     
                     $html.=' <tr>
                <td colspan="6">Monday</td>
              </tr>';
              
                 }
                 
                 $html.='</thead>';
                 
                 $html.='<tbody>';
                 if(count($availabilities_monday) > 0){
                     $html.='<tr>';
                    foreach($availabilities_monday as $monday){
                        
                        $html.='<td>'.$monday->duration.'</td>';
                    }
                    $html.='</tr>';
              
                 }
                 
                 $html.='</tbody>';
                 
                 
                  $html .= '<thead>';
                 if(count($availabilities_tuesday) > 0){
                     
                     $html.=' <tr>
                <td colspan="6">Tuesday</td>
              </tr>';
              
                 }
                 
                 $html.='</thead>';
                 
                 $html.='<tbody>';
                 if(count($availabilities_tuesday) > 0){
                     $html.='<tr>';
                    foreach($availabilities_tuesday as $tuesday){
                        
                        $html.='<td>'.$tuesday->duration.'</td>';
                    }
                    $html.='</tr>';
              
                 }
                 
                 $html.='</tbody>';
                 
                 
                  $html .= '<thead>';
                 if(count($availabilities_wednesday) > 0){
                     
                     $html.=' <tr>
                <td colspan="6">Wednesday</td>
              </tr>';
              
                 }
                 
                 $html.='</thead>';
                 
                 $html.='<tbody>';
                 if(count($availabilities_wednesday) > 0){
                     $html.='<tr>';
                    foreach($availabilities_wednesday as $wednesday){
                        
                        $html.='<td>'.$wednesday->duration.'</td>';
                    }
                    $html.='</tr>';
              
                 }
                 
                 $html.='</tbody>';
                 
                 
                 
                 
                 
                  $html.= '<thead>';
                 if(count($availabilities_thursday) > 0){
                     
                     $html.=' <tr>
                <td colspan="6">Thursday</td>
              </tr>';
              
                 }
                 
                 $html.='</thead>';
                 
                 $html.='<tbody>';
                 if(count($availabilities_thursday) > 0){
                     $html.='<tr>';
                    foreach($availabilities_thursday as $thursday){
                        
                        $html.='<td>'.$thursday->duration.'</td>';
                    }
                    $html.='</tr>';
              
                 }
                 
                 $html.='</tbody>';
                 
                 
                 
                 
                  $html.= '<thead>';
                 if(count($availabilities_friday) > 0){
                     
                     $html.=' <tr>
                <td colspan="6">Friday</td>
              </tr>';
              
                 }
                 
                 $html.='</thead>';
                 
                 $html.='<tbody>';
                 if(count($availabilities_friday) > 0){
                     $html.='<tr>';
                    foreach($availabilities_friday as $friday){
                        
                        $html.='<td>'.$friday->duration.'</td>';
                    }
                    $html.='</tr>';
              
                 }
                 
                 $html.='</tbody>';
                 
                 
                 
                 
                  $html.= '<thead>';
                 if(count($availabilities_saturday) > 0){
                     
                     $html.=' <tr>
                <td colspan="6">Saturday</td>
              </tr>';
              
                 }
                 
                 $html.='</thead>';
                 
                 $html.='<tbody>';
                 if(count($availabilities_saturday) > 0){
                     $html.='<tr>';
                    foreach($availabilities_saturday as $saturday){
                        
                        $html.='<td>'.$saturday->duration.'</td>';
                    }
                    $html.='</tr>';
              
                 }
                 
                 $html.='</tbody>';
                 
                 
                 
                  $html.= '<thead>';
                 if(count($availabilities_sunday) > 0){
                     
                     $html.=' <tr>
                <td colspan="6">Sunday</td>
              </tr>';
              
                 }
                 
                 $html.='</thead>';
                 
                 $html.='<tbody>';
                 if(count($availabilities_sunday) > 0){
                     $html.='<tr>';
                    foreach($availabilities_sunday as $sunday){
                        
                        $html.='<td>'.$sunday->duration.'</td>';
                    }
                    $html.='</tr>';
              
                 }
                 
                 $html.='</tbody>';
                 
              
              return response()->json($html);
              
       }
       
       
       public function teacher_detail_day(Request $request){
           
          $availabilities =  Availability::where('teacher_id',$request->id)->where('deleted','no')->where('booked',null)->select('day')->distinct()->get();
          
         //$html='<select name="day" id="hello" class="form-control" onfocus="teacher_time(this.value,'.$request->id.');" onchange="teacher_time(this.value,'.$request->id.');">';
         $html='';
          $day = '';
          if(count($availabilities)>0){
          foreach($availabilities as $availability){
             
              
              //$html.='<option value="'.$availability->day.'">'.ucfirst($availability->day).'</option>';
              
              //$day.=$availability->day;
              
              $html.='<input type="text" value="5">';
              
              
          }
         // $html.='</select>';
          }
          
          //return response()->json(['html'=>$html,'id'=>$request->id,'day'=>$day]);
          return response()->json($html);
           
       }
       
       
       public function teacher_day_time(Request $request){
           
            $availabilities =  Availability::where('teacher_id',$request->id)->where('deleted','no')->where('booked',null)->orderby('id','desc')->select('day')->distinct()->get();
            $day='<select class="form-control" name="day" id="days" onchange="day_change(this.value,'.$request->id.');" required>';
            $day.='<option value="">--Select Day--</option>';
            foreach($availabilities as $availability){
                $day.='<option>'.ucfirst($availability->day).'</option>';
                
               
            }
            $day.='</select>';
             
             
              $amount = Teacher::where('id',$request->id)->value('hourly_rate');
              
                $availabilities_time =  Availability::where('teacher_id',$request->id)->where('deleted','no')->where('booked',null)->orderby('id','desc')->select('duration')->distinct()->get();
           
            $time='<select class="form-control" name="timing" id="timings">';
            foreach($availabilities_time as $availability){
                $time.='<option>'.$availability->duration.'</option>';
            }
            $time.='</select>';
            
            return response()->json(['day'=>$day,'time'=>$time,'id'=>$request->id,'amount'=>$amount]);
           
       }
       
       
       
       public function check(Request $request){
           
           echo $request->day;
       }
       
       
       
         public function teacher_day_change(Request $request){
           
              
           $availabilities_time =  Availability::where('teacher_id',$request->id)->where('deleted','no')->where('day',$request->day)->where('booked',null)->orderby('id','desc')->select('duration')->distinct()->get();
           
            $time='<select class="form-control" name="timing" id="timings">';
            foreach($availabilities_time as $availability){
                $time.='<option>'.$availability->duration.'</option>';
            }
            $time.='</select>';
            
            return response()->json(['time'=>$time]);
           
       }
       
       
       
       
       public function teacher_profile($id){
           
          $teacher = Teacher::where('id',$id)->first();
           return view('frontend.teacher_profile',compact('teacher'));
           
       }
       
       
       
    
       
       
       
}
