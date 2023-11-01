<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdminLogin;
use App\Models\Teacher;
use App\Models\Availability;
use App\Models\CurrencyValue;
use App\Models\Commission;
use App\Models\Subject;
use App\Models\SubSubject;
use App\Models\Level;
use App\Models\Language;
use App\Models\Country;
use App\Models\Slider;
use App\Models\About;
use App\Models\Webinfo;
use App\Models\User;
use App\Models\Booking;
use App\Models\Seo;
use App\Models\Order;
use App\Models\TutorIncomeStatus;
use App\Models\Review;
use App\Models\Chat;
use Carbon\Carbon;
use DB;
use Session;
use Mail;

class AdminController extends Controller
{
    //function for index page
    public function index(){
         if(Session::has('admin_email')){

            return redirect()->route('admin.dashboard');

         }else{
        return view('admin.index');
    }
    }

     //function for login
    public function admin_login(Request $request){

        $request->validate([

            'email' => 'required|email',
            'password' => 'required'

        ]);

        $admin_login = AdminLogin::first();
        $email = $admin_login->email;
        $password = $admin_login->password;

        if($email == $request->email){
            if(password_verify($request->password,$password)){
               
               Session::put('admin_email',$request->email);
               return redirect()->route('admin.dashboard');
            }else{

                 return redirect()->back()->with('password_mismatch','Password mismatch');
            }
        }else{
            return redirect()->back()->with('email_mismatch','Email mismatch');
        }
    }

    
    //function for dashboard
    public function dashboard(){
       $tutor_count = Teacher::orderby('id','desc')->where('teacher_deleted','no')->where('otp_verified','yes')->count();
       $student_count = User::orderby('id','desc')->where('deleted','no')->where('otp_verified','yes')->count();
       $subject_count = Subject::orderby('id','desc')->where('deleted','no')->count();
       $booking_count = Booking::orderby('id','desc')->where('booking_deleted','no')->count();
       return view('admin.dashboard',compact('tutor_count','student_count','subject_count','booking_count'));
    }


    //function for tutor details
    public function tutor_details(){
       $tutor_details = Teacher::where('otp_verified','yes')->where('teacher_deleted','no')->get();
      //$tutor_details = DB::table('teachers')->join('subjects','subjects.id','=','teachers.subject_id')->join('sub_subjects','sub_subjects.id','=','teachers.sub_subject_id')->where('otp_verified','yes')->where('teacher_deleted','no')->get();
       return view('admin.teacher.details',compact('tutor_details'));
    }

     //function for tutor status update
    public function tutor_status_update(Request $request){
        
        $status_check = Teacher::where('id',$request->id)->where('teacher_deleted','no')->value('status');

         $teacher_email = Teacher::where('id',$request->id)->value('email');
         $data = ['otp'=>'1234'];

        if($status_check == 'inactive'){

            Teacher::where('id',$request->id)->where('teacher_deleted','no')->update(['status'=>'active']);

           

            Mail::send('mail_teacher_status_active', $data, function($message) use($teacher_email) {
         $message->to($teacher_email)->subject
            ('Teacher status update from Tutor');
         $message->from('support@raincloud-global.com','Teacher status update from Tutor');
      });


        }else{

            Teacher::where('id',$request->id)->where('teacher_deleted','no')->update(['status'=>'inactive']);


            Mail::send('mail_teacher_status_inactive', $data, function($message) use($teacher_email) {
         $message->to($teacher_email)->subject
            ('Teacher status update from Tutor');
         $message->from('support@raincloud-global.com','Teacher status update from Tutor');
      });

        }
    }


    //function for tutor view
    public function tutor_view(Request $request){

        //$tutor = Teacher::where('id',$request->id)->where('teacher_deleted','no')->first();
        $tutor = DB::table('teachers')->join('subjects','subjects.id','=','teachers.subject_id')->join('sub_subjects','sub_subjects.id','=','teachers.sub_subject_id')->where('teachers.id',$request->id)->where('teacher_deleted','no')->first();
        return response()->json($tutor);

    }


     //function for tutor availability
    public function tutor_availability(Request $request){

        $availabilities = Availability::where('deleted','no')->where('teacher_id',$request->id)->get(['id','title','start','end']);
        /*
        $html = '';
        foreach($availabilities as $availability){

            $duration = $availability->duration;
           // $time_format_to = Carbon::parse($availability->to)->format('h:i A');

            $html.= '<div class="form-group">
    <label>'.ucfirst($availability->day).'</label>
   <div class="form-control">'.$duration.'</div>
  </div>';
        }
        */

        return response()->json($availabilities);

    }


      //function for currency conversion
    public function currency_conversion(Request $request){

       $currency_value = CurrencyValue::first();
       return view('admin.currency_conversion',compact('currency_value'));
    }


     //function for currency edit
    public function currency_edit(Request $request){

      $currency = CurrencyValue::where('id',$request->id)->value('rupee_value');
      return response()->json($currency);
    }


    //function for currency update
    public function currency_update(Request $request){

         CurrencyValue::where('id',$request->currency_id)->update(['rupee_value'=>$request->rupee]);

         return redirect()->back();
    }


    //function for commission
    public function commission(Request $request){
       $commission = Commission::first();
     return view('admin.commission',compact('commission'));
    }


      //function for commission edit
    public function commission_edit(Request $request){
       $commission = Commission::where('id',$request->id)->value('tutor_commission');
       return response()->json($commission);
    }


     //function for commission update
    public function commission_update(Request $request){
       $commission = Commission::where('id',$request->commission_id)->update(['tutor_commission'=>$request->commission]);
       return redirect()->back();
    }


     //function for tutor income
    public function tutor_income(Request $request){
       $orders = DB::table('bookings')->join('orders','orders.booking_id','=','bookings.id')->join('availabilities','availabilities.id','=','orders.duration_id')->join('teachers','teachers.id','=','bookings.teacher_id')->where('booking_deleted','no')->orderby('bookings.id','desc')->get();
       return view('admin.teacher.income',compact('orders'));
    }

     //function for subjects
    public function subjects(Request $request){
       $subjects = Subject::where('deleted','no')->orderby('id','desc')->get();
       return view('admin.subject.subjects',compact('subjects'));
    }

      //function for subject add
    public function subject_add(Request $request){

        $request->validate([

            'subject' => 'required'

        ]);
       
       $subject = new Subject();
       $subject->subject_name = $request->subject;
       $subject->subject_slug = str_replace(' ','-',strtolower($request->subject));
       $subject->save();

       return redirect()->back();
    }

    
    //function for subject delete
    public function subject_delete(Request $request){
       
       Subject::where('id',$request->subject_id)->update(['deleted'=>'yes']);
       return redirect()->back();

    }


     //function for sub subjects
    public function sub_subjects(Request $request){
       $sub_subjects = SubSubject::where('deleted','no')->orderby('id','desc')->get();
       return view('admin.subject.sub_subject',compact('sub_subjects'));

    }


     //function for sub subject add
    public function sub_subject_add(Request $request){
      $sub_subject = new SubSubject();
      $sub_subject->sub_id = $request->subject;
      $sub_subject->sub_sub_name = $request->sub_subject;
      $sub_subject->sub_sub_slug = str_replace(' ','-',strtolower($request->sub_sub_name));
      $sub_subject->save();

      return redirect()->back();

    }


    //function for sub subject delete
    public function sub_subject_delete(Request $request){
       
       SubSubject::where('id',$request->sub_subject)->update(['deleted'=>'yes']);
       return redirect()->back();

    }


     //function for levels
    public function levels(Request $request){
       
     $levels = Level::where('deleted','no')->orderby('id','desc')->get();
     return view('admin.level.levels',compact('levels'));

    }


     //function for level add
    public function level_add(Request $request){
       
       $request->validate([
        'level' => 'required'
       ]);

       $level = new Level();
       $level->level_name = $request->level;
       $level->level_slug = str_replace(' ','-',strtolower($request->level));
       $level->save();

       return redirect()->back();

    }


     //function for level delete
    public function level_delete(Request $request){
       
       Level::where('id',$request->level)->update(['deleted'=>'yes']);
       return redirect()->back();

    }


     //function for languages
    public function languages(Request $request){
       $languages = Language::where('deleted','no')->orderby('id','desc')->get();
       return view('admin.language.languages',compact('languages'));
    }


     //function for language add
    public function language_add(Request $request){
       $language = new Language();
       $language->language_name = $request->language;
       $language->language_slug = str_replace(' ','-',strtolower($request->language));
       $language->save();
       return redirect()->back();
    }


     //function for language delete
    public function language_delete(Request $request){
       
       Language::where('id',$request->language)->update(['deleted'=>'yes']);
       return redirect()->back();

    }



     //function for countries
    public function countries(Request $request){
       $countries = Country::where('deleted','no')->orderby('id','desc')->get();
       return view('admin.country.countries',compact('countries'));
    }


     //function for country add
    public function country_add(Request $request){
       $country = new Country();
       $country->country_name = $request->country;
       $country->country_slug = str_replace(' ','-',strtolower($request->country));
       $country->save();
       return redirect()->back();
    }


     //function for country delete
    public function country_delete(Request $request){
       
       Country::where('id',$request->country)->update(['deleted'=>'yes']);
       return redirect()->back();

    }


     //function for banner slider
    public function banner_slider(Request $request){
       $sliders = Slider::where('deleted','no')->orderby('id','desc')->get();
       return view('admin.slider.sliders',compact('sliders'));
    }



      //function for banner slider add
    public function banner_slider_add(Request $request){

        $request->validate([
            'title' =>'required',
            'desc' => 'required',
            'image' => 'required'
        ]);

        $slider = new Slider();
        $slider->title = $request->title;
        $slider->description = $request->desc;

        $name = '';

          if($request->hasFile('image')){

                  $image = $request->file('image');

                $name = $image->getClientOriginalName();

                 $destinationPath = public_path('/backend/banner/');
                 $image->move($destinationPath, $name);
           

               }

               $slider->image = $name;
               $slider->save();

               return redirect()->back();
    }



      //function for banner slider delete
    public function banner_slider_delete(Request $request){
       
       Slider::where('id',$request->slider)->update(['deleted'=>'yes']);
       $image = Slider::where('id',$request->slider)->value('image');
       $file_path = public_path('/backend/banner/'.$image);
       unlink($file_path);
       return redirect()->back();

    }



      //function for about
    public function about(Request $request){
       $about = About::first();
       return view('admin.about.abouts',compact('about'));
    }


      //function for about update
    public function about_update(Request $request){

        $name = About::where('id',$request->about_id)->value('image');

          if($request->hasFile('image')){
             
              $file_path = public_path('/backend/about/'.$name);
              unlink($file_path);

                  $image = $request->file('image');

                $name = $image->getClientOriginalName();

                 $destinationPath = public_path('/backend/about/');
                 $image->move($destinationPath, $name);
           

               }

       About::where('id',$request->about_id)->update(['title'=>$request->title,'description'=>$request->desc,'image'=>$name]);
       return redirect()->back();
    }


      //function for webinfo
    public function webinfo(Request $request){
        $webinfo = Webinfo::first();
       return view('admin.webinfo.webinfo',compact('webinfo'));
    }


      //function for seo
    public function seo(Request $request){
        $seos = Seo::get();
       return view('admin.seo.seo',compact('seos'));
    }


      //function for webinfo update
    public function webinfo_update(Request $request){

        $name = Webinfo::value('logo');

         if($request->hasFile('logo')){
             
              $file_path = public_path('/backend/images/'.$name);
              unlink($file_path);

                  $image = $request->file('logo');

                $name = $image->getClientOriginalName();

                 $destinationPath = public_path('/backend/images/');
                 $image->move($destinationPath, $name);
           

               }

                $id = Webinfo::value('id');
                Webinfo::where('id',$id)->update(['email'=>$request->email,'address'=>$request->address,'facebook'=>$request->facebook,'twitter'=>$request->twitter,'linkedin'=>$request->linkedin,'youtube'=>$request->youtube,'logo'=>$name]);

               return redirect()->back();


    }

    
    //function for student details
    public function student_details(){
        $students = User::where('deleted','no')->get();
        return view('admin.student.details',compact('students'));
    }


      //function for student delete
    public function student_delete($id){
        $check_googlke_user_count =  User::where('id',$id)->where('google_id',null)->count();
         if($check_googlke_user_count>0){ 
       User::where('id',$id)->update(['deleted'=>'yes']);
         }else{
                 User::where('id',$id)->delete();
         }
       return redirect()->back();
    }


     //function for student tutor bookings
    public function student_tutor_bookings(){
       $bookings = Booking::orderby('bookings.id','desc')->join('teachers','teachers.id','=','bookings.teacher_id')->
       join('orders','orders.booking_id','=','bookings.id')->join('availabilities','availabilities.id','=','orders.duration_id')->
       join('users','users.id','=','bookings.student_id')->where('booking_deleted','no')->
       select('bookings.id','bookings.student_id','bookings.teacher_id','users.name','teachers.first_name','teachers.last_name','orders.booking_id','bookings.created_at')->
       get();
       return view('admin.student.tutor_bookings',compact('bookings'));
    }

    
     //function for student class history
    public function student_class_history(){
       $bookings = DB::table('bookings')->join('orders','orders.booking_id','=','bookings.id')->join('class_statuses','class_statuses.booking_id','=','bookings.id')->join('availabilities','availabilities.id','=','orders.duration_id')->join('users','users.id','=','bookings.student_id')->where('booking_deleted','no')->orderby('bookings.id','desc')->get();
       return view('admin.student.class_history',compact('bookings'));
    }

      //function for tutor class history
    public function tutor_class_history(){
       $bookings = DB::table('bookings')->join('orders','orders.booking_id','=','bookings.id')->join('class_statuses','class_statuses.booking_id','=','bookings.id')->join('availabilities','availabilities.id','=','orders.duration_id')->join('teachers','teachers.id','=','bookings.teacher_id')->where('booking_deleted','no')->get();
       return view('admin.teacher.class_history',compact('bookings'));
    }
    
    
    //function for ip address
    public function getIp(){
    foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key){
        if (array_key_exists($key, $_SERVER) === true){
            foreach (explode(',', $_SERVER[$key]) as $ip){
                $ip = trim($ip); // just to be safe
                if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false){
                    return $ip;
                }
            }
        }
    }
}


     //function for booking history
    public function booking_history(){
    
       $bookings = DB::table('bookings')->join('orders','orders.booking_id','=','bookings.id')->join('users','users.id','=','bookings.student_id')->join('subjects','subjects.id','=','bookings.subject_id')->join('teachers','teachers.id','=','bookings.teacher_id')->join('sub_subjects','sub_subjects.id','=','bookings.sub_subject_id')->join('class_statuses','class_statuses.booking_id','=','bookings.id')->join('availabilities','availabilities.id','=','orders.duration_id')->orderby('bookings.id','desc')->where('booking_deleted','no')->select('bookings.id','reference_id','name','subject_name','first_name','last_name','title','orders.currency','duration_id','orders.date','amount','sub_sub_name','orders.booking_id','order_status','bookings.created_at')->get();
       return view('admin.booking_history',compact('bookings'));
    }


    //function for admin income
    public function admin_income(){
        
        // $orders = Order::orderby('id','desc')->get();
         $orders = DB::table('bookings')->join('orders','orders.booking_id','=','bookings.id')->join('availabilities','availabilities.id','=','orders.duration_id')->join('teachers','teachers.id','=','bookings.teacher_id')->where('booking_deleted','no')->orderby('bookings.id','desc')->get();
        return view('admin.income',compact('orders'));
    }


     //function for admin chat
    public function admin_chat(){
        $chats = Chat::orderby('id','desc')->get();
        return view('admin.chat',compact('chats'));
    }


     //function for edit seo
    public function seo_edit(Request $request){

        $seo = Seo::where('id',$request->id)->first();

        return response()->json($seo);
       
    }


     //function for seo update
    public function seo_update(Request $request){

       Seo::where('id',$request->seo_id)->update(['seo_title'=>$request->seo_title,'seo_description'=>$request->seo_description,'seo_keywords'=>$request->seo_keywords,'canonical_url'=>$request->canonical_url,'seo_json'=>$request->seo_json]);

        return redirect()->back();
       
    }



      //function for reviews
    public function reviews(Request $request){

       //$reviews = Review::orderby('id','desc')->get();
        $reviews = DB::table('reviews')->join('teachers','teachers.id','=','reviews.teacher_id')->join('users','users.id','=','reviews.student_id')->orderby('reviews.id','desc')->get();

        return view('admin.review',compact('reviews'));
       
    }


  //function for logout
    public function logout(Request $request){

         Session::forget('admin_email');
         Session::regenerate();

        return redirect()->route('admin');
       
    }



    //function for status update
    public function status_update(Request $request){
       
       $booking_id = $request->id;

       return response()->json($booking_id);
    }

   

   //function for tutor income update
    public function tutor_income_update(Request $request){

          
        TutorIncomeStatus::where('booking_id',$request->booking_id)->where('tutor_income_status_deleted','no')->update(['income_status'=>$request->status]);

        return redirect()->back();
       
    }
    
    
    public function teacher_delete($id){
        
        Teacher::where('id',$id)->update(['teacher_deleted'=>'yes']);
        
        return redirect()->back();
    }
    

    
    public function check(){
        
        $ip = '100.128.0.0';  //$_SERVER['REMOTE_ADDR']
$ipInfo = file_get_contents('http://ip-api.com/json/' . $ip);
$ipInfo = json_decode($ipInfo);
$timezone = $ipInfo->timezone;
date_default_timezone_set($timezone);
 $timezone = date_default_timezone_get();
 //$country = $ipInfo->geoplugin_countryName;
  //echo date('Y/m/d H:i A');
  //$date = Booking::value('created_at');
 //echo Carbon::parse('4PM')->format('h:i A');
 
 $ipdat = @json_decode(file_get_contents(
    "http://www.geoplugin.net/json.gp?ip=" . $ip));
   
echo 'Country Name: ' . $ipdat->geoplugin_countryName . "\n";
//echo 'City Name: ' . $ipdat->geoplugin_city . "\n";
//echo 'Continent Name: ' . $ipdat->geoplugin_continentName . "\n";
//echo 'Latitude: ' . $ipdat->geoplugin_latitude . "\n";
//echo 'Longitude: ' . $ipdat->geoplugin_longitude . "\n";
//echo 'Currency Symbol: ' . $ipdat->geoplugin_currencySymbol . "\n";
//echo 'Currency Code: ' . $ipdat->geoplugin_currencyCode . "\n";
//echo 'Timezone: ' . $ipdat->geoplugin_timezone;


    }
    
    
    
    
     public function order_delete($booking_id){
        
     Booking::where('id',$booking_id)->update(['booking_deleted'=>'yes']);
     Order::where('booking_id',$booking_id)->update(['order_deleted'=>'yes']);
     
     return redirect()->back();
     
    }


}
