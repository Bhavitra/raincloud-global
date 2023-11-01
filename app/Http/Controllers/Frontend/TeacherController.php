<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\Language;
use App\Models\Level;
use App\Models\Subject;
use App\Models\Currency;
use App\Models\Teacher;
use App\Models\SubSubject;
use App\Models\Availability;
use App\Models\Booking;
use App\Models\ClassStatus;
use App\Models\Order;
use App\Models\TutorIncomeStatus;
use Hash;
use Session;
use Mail;
use DB;

class TeacherController extends Controller
{
    //function for teacher login
    public function index(){
      
      return view('frontend.teacher.index');
    }


     //function for teacher signup
    public function signup(){
        
      
        
      $countries = Country::where('deleted','no')->get();
      $languages = Language::where('deleted','no')->get();
      $levels = Level::where('deleted','no')->get();
      $subjects = Subject::where('deleted','no')->get();
      $currencies = Currency::get();
      return view('frontend.teacher.index_signup',compact('countries','languages','levels','subjects','currencies'));

    }


    //function for teacher registration
    public function registration(Request $request){
        
          $ip = $this->get_client_ip(); //$_SERVER['REMOTE_ADDR']
        $ipInfo = file_get_contents('http://ip-api.com/json/' . $ip);
        $ipInfo = json_decode($ipInfo);
        $timezone = $ipInfo->timezone;
      
      $request->validate([

        'f_name' => 'required|regex:/^[a-zA-Z ]+$/',
        'l_name' => 'required|regex:/^[a-zA-Z ]+$/',
        'email' => 'required|email',
        'password' => 'required|confirmed',
        'password_confirmation' => 'required',
         'country' => 'required',
         'language' => 'required',
         'level' => 'required',
         'subject' => 'required',
         'currency' => 'required',
         'rate' => 'required|regex:/^[0-9 ]+$/',
         'teaching_experience' =>'required',
         'current_situation' =>'required',
         'phone' => 'required|regex:/^[0-9 ]+$/'

      ],[
        'f_name.required' => 'First name is required',
        'l_name.required' => 'Last name is required',
        'email.required' => 'Email is required',
        'password.required' => 'Password is required',
        'password_confirmation.required' => 'Password confirmation is required',
        'rate.required' => 'Rate is required',
        'f_name.regex' => 'First name can not contain letters',
        'l_name.regex' => 'Last name can not contain letters',
        'password.confirmed' => 'Password does not match',
        'password.min' => 'Password length must be minimum 6 characters',
        'password.regex' => 'Password must contain Uppercase letters,numbers,special characters',
        'phone.regex' => 'Phone number can not contain letters',
        'rate.regex' => 'Rate can not contain letters',
        'currency.required' => 'Currency is required',
        'teaching_experience.required' => 'Teaching experience is required',
        'current_situation.required' => 'Current situation is required',
        'subject.required' => 'Subject is required',
        'level.required' => 'Level is required',
        'language.required' => 'Language is required',
        'country.required' => 'Country is required',

      ]);

      $check_email = Teacher::where('email',$request->email)->where('teacher_deleted','no')->count();

      if($check_email<1){

          $teacher = new Teacher();
          $teacher->country_id = $request->country;
          $teacher->language_id = $request->language;
          $teacher->level_id = $request->level;
          $teacher->subject_id = $request->subject;
          $teacher->sub_subject_id = $request->sub_subject;
          $teacher->first_name = $request->f_name;
          $teacher->last_name = $request->l_name;
          $teacher->email = $request->email;
          $teacher->password = Hash::make($request->password);
          $teacher->hourly_rate = $request->rate;
          $teacher->currency = $request->currency;
          $teacher->teaching_experience = $request->teaching_experience;
          $teacher->current_situation = $request->current_situation;
          $teacher->phone = $request->phone;
          $teacher->timezone = $timezone;
          $teacher->otp = rand(1,9999);
          $teacher->save();

          $id = $teacher->id;

          //return view('frontend.teacher.login_verify',compact('id'));
          return redirect()->route('teacher.login.verify',['id'=>$id]);
      }else{

        return redirect()->back()->with('email_exists','Email already exists..Try another email....');
      }

          

    }
    
    
    public function get_client_ip() {
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

    
    //function for teacher sub subject
    public function teacher_sub_subject_fetch(Request $request){

        $sub_subjects = SubSubject::where('sub_id',$request->id)->get();

        $html = '';
         
         if(count($sub_subjects)>0){
        foreach($sub_subjects as $sub){

            $html.= '<option value="'.$sub->id.'">'.$sub->sub_sub_name.'</option>';
        }
    }else{

        $html = '';
    }

        return response()->json($html);

    }


    public function teacher_login_verify($id){

        return view('frontend.teacher.login_verify',compact('id'));

    }


      public function teacher_verify_email(Request $request){

        $otp = Teacher::where('id',$request->teacher_id)->where('teacher_deleted','no')->value('otp');

          if($otp == $request->otp){

            Teacher::where('id',$request->teacher_id)->where('teacher_deleted','no')->update(['otp_verified'=>'yes']);

            return redirect()->route('teacher.signup')->with('teacher_login','Your Registration as a Teacher has been successful...You will have to wait for the Admin to approve..We will notify you when verified...');
          }else{

            return redirect()->back()->with('otp_mismatch','Otp mismatch....');
          }

    }


    public function teacher_logged_in(Request $request){

           $teacher = Teacher::where('email',$request->email)->where('teacher_deleted','no')->first();
           $teacher_count = Teacher::where('email',$request->email)->where('teacher_deleted','no')->count();

           if($teacher_count>0){

            if($teacher->otp_verified == 'yes'){

                if($teacher->status == 'active'){
                      if(password_verify($request->password,$teacher->password)){

                             Session::put('teacher_email',$request->email);
                              return redirect()->route('teacher.dashboard');
                      }else{

                        return redirect()->back()->with('login_fail','Password mismatch....');
                      }
                  

                }else{

                      return redirect()->back()->with('login_fail','You have no authorize to login...');
                }

            }else{

                  return redirect()->back()->with('login_fail','Otp has not verified for this email....');

            }


           }else{

            return redirect()->back()->with('login_fail','The email which you have entered is unavailable....');
           }
    }

    public function teacher_dashboard(){
         $subject = DB::table('teachers')->join('subjects','subjects.id','=','teachers.subject_id')->where('email',Session::get('teacher_email'))->where('deleted','no')->where('status','active')->where('teacher_deleted','no')->first();
           $subjects = Subject::where('deleted','no')->where('id','<>',$subject->subject_id)->get();
           $level = DB::table('teachers')->join('levels','levels.id','=','teachers.level_id')->where('email',Session::get('teacher_email'))->where('deleted','no')->where('status','active')->where('teacher_deleted','no')->first();
           $levels = Level::where('deleted','no')->where('id','<>',$level->level_id)->get();
           $language = DB::table('teachers')->join('languages','languages.id','=','teachers.language_id')->where('email',Session::get('teacher_email'))->where('deleted','no')->where('status','active')->where('teacher_deleted','no')->first();
           $languages = Language::where('deleted','no')->where('id','<>',$language->language_id)->get();
           $country = DB::table('teachers')->join('countries','countries.id','=','teachers.country_id')->where('email',Session::get('teacher_email'))->where('deleted','no')->where('status','active')->where('teacher_deleted','no')->first();
           $countries = Country::where('deleted','no')->where('id','<>',$country->country_id)->get();

           $teacher = Teacher::where('status','active')->where('email',Session::get('teacher_email'))->where('teacher_deleted','no')->first();
           
          // $sub_subject = SubSubject::where('id',$subject->sub_subject_id)->where('deleted','no')->first();

           //$sub_subject_count = SubSubject::where('id',$subject->sub_subject_id)->where('deleted','no')->count();

           //$sub_subjects = SubSubject::where('id','<>',$subject->sub_subject_id)->where('sub_id',$subject->subject_id)->where('deleted','no')->get();
            $bookings = DB::table('bookings')->join('orders','orders.booking_id','=','bookings.id')->join('teachers','teachers.id','=','bookings.teacher_id')->join('availabilities','availabilities.id','=','orders.duration_id')->join('class_statuses','class_statuses.booking_id','=','bookings.id')->join('subjects','subjects.id','=','bookings.subject_id')->join('users','users.id','=','bookings.student_id')->where('bookings.teacher_id',$teacher->id)->where('teacher_deleted','no')->orderby('bookings.id','desc')->get();
            $booking_id = Booking::where('teacher_id',$teacher->id)->where('booking_deleted','no')->latest()->value('id');;
           return view('frontend.teacher.dashboard.index',compact('subjects','subject','levels','level','languages','language','countries','country','teacher','bookings','booking_id'));
    }


    public function teacher_profile_update(Request $request){

             Teacher::where('email',Session::get('teacher_email'))->where('teacher_deleted','no')->update(['first_name'=>$request->first_name,'last_name'=>$request->last_name,'country_id'=>$request->country,'language_id'=>$request->language,'level_id'=>$request->level,'subject_id'=>$request->subject,'sub_subject_id'=>$request->sub_subject,'hourly_rate'=>$request->rate,'currency'=>$request->currency,'teaching_experience'=>$request->teaching_experience,'current_situation'=>$request->current_situation,'phone'=>$request->phone]);

             return redirect()->back();

    }


    public function subjectwise_subsubject(Request $request){

      $sub_subjects = SubSubject::where('sub_id',$request->id)->get();
      $html = '';
      $html8=0;
      if(count($sub_subjects)>0){
      foreach($sub_subjects as $subject){

        $html.='<option value="'.$subject->id.'">'.$subject->sub_sub_name.'</option>';
        $html8=0;
      }
  }else{

    $html='';
    $html8=1;
  }

      return response()->json(['html'=>$html,'html8'=>$html8]);

    }


    public function availability(Request $request){
      
      if($request->services != ''){
      $availabilities = $request->services;

      foreach($availabilities as $availability){

        if($availability == ''){

        return redirect()->back()->with('checkbox_select','You have to select atleast one time duration');
      }

           $id = Teacher::where('email',Session::get('teacher_email'))->where('teacher_deleted','no')->value('id');

           $avail = new Availability();
           $avail->teacher_id = $id;
           $avail->day = $request->day;
           $avail->duration = $availability;
           $avail->status = 'active';
           $avail->save();

      }

      return redirect()->back()->with('timing_success','Timing set successfully');
    }else{
      return redirect()->back()->with('checkbox_select','You have to select atleast one time duration');
    }
    }

    public function fetch_availabilities(Request $request){

      $id = Teacher::where('email',Session::get('teacher_email'))->where('teacher_deleted','no')->value('id');
      $day = ucfirst($request->day);
      $html = '<h4>Availabilities for '.$day.'</h4>';
      $avails = Availability::where('day',$request->day)->where('teacher_id',$id)->where('deleted','no')->get();

      foreach($avails as $avail){

        $html.=$avail->duration."<a href='javascript:void();' onclick='timing_delete($avail->id);'><i class='fa fa-trash' style='color:red;'></i></a><br>";
      }

      return response()->json($html);
      

    }


    public function logout(){

         if(Session::has('teacher_email')){

          Session::forget('teacher_email');
          Session::regenerate();
         }

         //return redirect()->route('teacher.login');
    }


    public function timing_delete(Request $request){

      $id = Teacher::where('email',Session::get('teacher_email'))->where('teacher_deleted','no')->value('id');
      $day = Availability::where('id',$request->id)->where('deleted','no')->value('day');

      Availability::where('id',$request->id)->where('deleted','no')->update(['deleted'=>'yes']);

      $html = '<h4>Availabilities for '.ucfirst($day).'</h4>';
      $avails = Availability::where('day',$day)->where('teacher_id',$id)->where('deleted','no')->get();
      
      if(count($avails) >0){
      foreach($avails as $avail){

        $html.=$avail->duration."<a href='javascript:void();' onclick='timing_delete($avail->id);'><i class='fa fa-trash' style='color:red;'></i></a><br>";
      }
    }else{
      $html = '';
    }

      return response()->json($html);


    }


    public function teacher_student_update(Request $request){
         
         ClassStatus::where('booking_id',$request->booking_id)->where('class_status_deleted','no')->update(['class_status'=>$request->status]);

         $duration_id = Order::where('booking_id',$request->booking_id)->where('order_deleted','no')->value('duration_id');
         Availability::where('id',$duration_id)->where('deleted','no')->update(['booked'=>null]);

         return redirect()->back();
    }


    public function otp_verify(Request $request){
         
        return view('frontend.teacher.verify_email');
    }


     public function otp_verified(Request $request){

         $count = Teacher::where('email',$request->email)->where('teacher_deleted','no')->count();

         if($count>0){
            
            $verified = Teacher::where('email',$request->email)->where('teacher_deleted','no')->value('otp_verified');
            if($verified == 'yes'){
              return redirect()->back()->with('email_verified','Email is already verified');
            }else{

              $otp = rand(1,10000);
              Teacher::where('email',$request->email)->where('teacher_deleted','no')->update(['otp'=>$otp]);
              $data = ['otp'=>$otp];
              $email = $request->email;
               Mail::send('mail', $data, function($message) use($email) {
         $message->to($email)->subject
            ('Email Verification Message from Tutor');
         $message->from('support@raincloud-global.com','Email Verification Message from Tutor');
      });

               return view('frontend.teacher.otp_verified',compact('email'));
            }

         }else{

          return redirect()->back()->with('email_not_available','Email not available');
         }
    }


    public function otp_updated(Request $request){

     $count = Teacher::where('email',$request->email)->where('otp',$request->otp)->where('teacher_deleted','no')->count();
     if($count>0){

      Teacher::where('email',$request->email)->where('teacher_deleted','no')->update(['otp_verified'=>'yes']);

      return redirect()->route('teacher.login')->with('otp_verified','Otp verified...pls wait until Admin will approve you....We will notify you when approved...');

     }else{
      return redirect()->back()->with('otp_mismatch','Otp Mismatch...pls tray again');
     }
    }


    public function password_request(){
        
        return view('frontend.teacher.password_request');
    }

    public function teacher_email_verification_password_request(Request $request){

          $email = $request->email;
          $count = Teacher::where('email',$request->email)->where('teacher_deleted','no')->count();
          $email_exists_count = Teacher::where('email',$request->email)->count();
          $rand = bin2hex(openssl_random_pseudo_bytes(10));
          $data = ['reset_link'=>$rand,'email'=>$email];
          if($count>0){
            if($email_exists_count>0){
            Teacher::where('email',$request->email)->where('teacher_deleted','no')->update(['password_reset_link'=>$rand]);

              Mail::send('mail_password_reset', $data, function($message) use($email) {
         $message->to($email)->subject
            ('Password Reset Link from Tutor');
         $message->from('support@raincloud-global.com','Password Reset Link from Tutor');
      });

              return redirect()->back()->with('reset_link_sent','Password Reset Link has been sent to your registered email..pls check email...');
            }else{
                
                 return redirect()->back()->with('email_mismatch','Email mismatch');
            }

          }else{

            return redirect()->back()->with('email_mismatch','Email not available');
          }

    }


    public function reset_link($email,$link){
       
           $count = Teacher::where('email',$email)->where('password_reset_link',$link)->where('teacher_deleted','no')->count();

           if($count>0){

            return view('frontend.teacher.new_password');

           }
    }


    public function new_password_update(Request $request){

            Teacher::where('email',$request->email)->where('password_reset_link',$request->token)->where('teacher_deleted','no')->update(['password'=>Hash::make($request->new_password)]);

            return redirect()->route('teacher.login')->with('new_password_update','Password has been updated.....');

    }



     public function account_delete(Request $request){
              
           
              if(Session::has('teacher_email')){
                $email = Session::get('teacher_email');
                  $id = Teacher::where('email',$email)->value('id');
                  $order_booking_id = Booking::where('teacher_id',$id)->value('id');
                  Availability::where('teacher_id',$id)->update(['deleted'=>'yes']);
                  Booking::where('teacher_id',$id)->update(['booking_deleted'=>'yes']);
                  Order::where('booking_id',$order_booking_id)->update(['order_deleted'=>'yes']);
                  ClassStatus::where('booking_id',$order_booking_id)->update(['class_status_deleted'=>'yes']);

                  TutorIncomeStatus::where('booking_id',$order_booking_id)->update(['tutor_income_status_deleted'=>'yes']);

                  Session::forget('teacher_email');

                  Session::regenerate();

                Teacher::where('email',$email)->update(['teacher_deleted'=>'yes']);

              }
         

    }



    public function teacher_new_password_update(Request $request){

      $request->validate([
         'password'=>'required|confirmed',
         'password_confirmation'=>'required'
      ]);

      $email = '';

      if(Session::has('teacher_email')){
        $email = Session::get('teacher_email');
      }

      $hashed_password = Hash::make($request->password);

      Teacher::where('email',$email)->update(['password'=>$hashed_password]);

      return redirect()->back()->with('password_update','Password has been updated');


    }


}
