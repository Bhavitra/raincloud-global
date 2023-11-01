<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Review;
use App\Models\Availability;
use Carbon\Carbon;
use Hash;
use Auth;
use DB;
use Mail;

class StudentController extends Controller
{
    //function for teacher login
    public function index($slug=""){
      
      return view('frontend.student.index',compact('slug'));
    }

    //function for student signup
    public function signup(Request $request){
        /*
     $student = new Student();
     $student->student_f_name = $request->f_name;
     $student->student_l_name = $request->l_name;
     $student->student_email = $request->email;
     $student->student_password = Hash::make($request->password);
     $student->otp = rand(1,1000);
     $student->save();

     return redirect()->back();
     */

     return view('frontend.student.registration');

    }


    public function registration(Request $request){

        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required'

        ]);

           $user = new User();
           $user->name = $request->name;
           $user->email = $request->email;
           $user->password = Hash::make($request->password);
           $user->otp = rand(1,9999);
           $user->save();

           $id = $user->id;

           return redirect()->route('student.email_verification',['id'=>$id]);

    }


    public function email_verification($id){

        return view('frontend.student.email_verification',compact('id'));
    }


     public function verify_email(Request $request){

          $otp = User::where('id',$request->student_id)->value('otp');

          if($otp == $request->otp){
              return redirect()->route('student.email_verified',['id'=>$request->student_id]);
          }else{
             
             return redirect()->back()->with('otp_mismatch','Otp does not match');
          }
    }


    public function dashboard(){
        $id = Auth::id();
        $image = User::where('id',$id)->value('image');
        $phone = User::where('id',$id)->value('phone');
        $bookings = DB::table('bookings')->join('orders','orders.booking_id','=','bookings.id')->join('teachers','teachers.id','=','bookings.teacher_id')->join('availabilities','availabilities.id','=','bookings.availability_id')->join('class_statuses','class_statuses.booking_id','=','bookings.id')->join('subjects','subjects.id','=','bookings.subject_id')->where('student_id',$id)->orderby('bookings.id','desc')->get();
       return view('frontend.student.dashboard',compact('id','image','phone','bookings'));
    }


     public function profile_update(Request $request){

        $id = Auth::id();
        $name = User::where('id',$id)->value('image');

         if($request->hasFile('image')){

                  $image = $request->file('image');

                $name = $image->getClientOriginalName();

                 $destinationPath = public_path('/frontend/images/');
                 $image->move($destinationPath, $name);
           

               }

        User::where('id',$id)->update(['name'=>$request->name,'phone'=>$request->phone,'image'=>$name]);

        return redirect()->back();
       
           
    }



    public function review_add(Request $request){

             $date = Carbon::now();

             $review = new Review();
             $review->student_id = Auth::id();
             $review->teacher_id = $request->teacher;
             $review->booking_id = $request->booking;
             $review->rating = $request->rating;
             $review->review = $request->review;
             $review->date = $date;
             $review->save();

             return redirect()->back();
    }


       public function otp_verify(Request $request){
         
        return view('frontend.student.verify_email');
    }



     public function otp_verified(Request $request){

         $count = User::where('email',$request->email)->count();

         if($count>0){
            
            $verified = User::where('email',$request->email)->value('otp_verified');
            if($verified == 'yes'){
              return redirect()->back()->with('email_verified','Email is already verified');
            }else{

              $otp = rand(1,10000);
              User::where('email',$request->email)->update(['otp'=>$otp]);
              $data = ['otp'=>$otp];
              $email = $request->email;
               Mail::send('mail', $data, function($message) use($email) {
         $message->to($email)->subject
            ('Email Verification Message from Tutor');
         $message->from('support@raincloud-global.com','Email Verification Message from Tutor');
      });

               return view('frontend.student.otp_verified',compact('email'));
            }

         }else{

          return redirect()->back()->with('email_not_available','Email not available');
         }
    }



       public function otp_updated(Request $request){

     $count = User::where('email',$request->email)->where('otp',$request->otp)->count();
     if($count>0){

      User::where('email',$request->email)->update(['otp_verified'=>'yes']);

      return redirect()->route('student.login')->with('otp_verified','Otp verified...pls login...');

     }else{
      return redirect()->back()->with('otp_mismatch','Otp Mismatch...pls tray again');
     }
    }


     public function password_request(){
        
        return view('frontend.student.password_request');
    }


     public function student_email_verification_password_request(Request $request){

          $email = $request->email;
          $count = User::where('email',$request->email)->count();
          $check_user = User::where('email',$request->email)->value('google_id');
          $rand = bin2hex(openssl_random_pseudo_bytes(10));
          $data = ['reset_link'=>$rand,'email'=>$email];
          if($count>0){
           if($check_user == null){
            User::where('email',$request->email)->update(['password_reset_link'=>$rand]);

              Mail::send('mail2_password_reset', $data, function($message) use($email) {
         $message->to($email)->subject
            ('Password Reset Link from Tutor');
         $message->from('support@raincloud-global.com','Password Reset Link from Tutor');
      });

              return redirect()->back()->with('reset_link_sent','Password Reset Link has been sent to your registered email..pls check email...');
           }else{
               
               return redirect()->back()->with('email_google_exists','This email has google login...you can not change password here....');
           }

          }else{

            return redirect()->back()->with('email_mismatch','Email mismatch');
          }

    }




    public function reset_link($email,$link){
       
           $count = user::where('email',$email)->where('password_reset_link',$link)->count();

           if($count>0){

            return view('frontend.student.new_password');

           }
    }



     public function new_password_update(Request $request){

            User::where('email',$request->email)->where('password_reset_link',$request->token)->update(['password'=>Hash::make($request->new_password)]);

            return redirect()->route('student.login')->with('new_password_update','Password has been updated.....');

    }
    
    
    
    public function booking_cancel(Request $request){
        
       Availability::where('id',$request->id)->update(['cancelled'=>'yes','booked'=>null]);
        
    }






}
