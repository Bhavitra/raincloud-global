<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Socialite;
use Auth;
use Exception;
use App\Models\User;
use Session;

//$url = request()->segment(1);

class GoogleController extends Controller
{
    
     public function redirectToGoogle($slug=null)
    {
         Session::put('s_slug',$slug);
         //Session::put('v_slug',$vendor_slug);
        return Socialite::driver('google')->stateless()->redirect();
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleGoogleCallback(Request $request)
    {
        try {

             $url = Session::get('s_slug');
             //$vendor_slug = Session::get('v_slug');
    
            $user = Socialite::driver('google')->stateless()->user();
            
            $session_url = Session::get('session_full_url');
     
            $finduser = User::where('google_id', $user->id)->where('deleted','no')->first();
     
            if($finduser){
     
                Auth::login($finduser);
                
                if($url == 'book'){

                     //Session::forget('s_slug');

                    

                    return redirect()->to($session_url);
                }else{
                return redirect('/student/dashboard');
            }
     
            }else{
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id' => $user->id,
                    'otp_verified' =>'yes',
                    'deleted' => 'no',
                    'password' => encrypt('123456dummy')
                ]);
    
                Auth::login($newUser);
                
               
                if($url == 'book'){

                    //Session::forget('s_slug');

                     return redirect()->to($session_url);


                }else{
                return redirect('/student/dashboard');
            }

            }
    
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
