<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use Session;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
         $count = User::where('email',$request->email)->where('deleted','no')->count();
         if($count>0){
        $request->authenticate();
        

        $request->session()->regenerate();
        
        if($request->booking_initiate =="yes"){
            
            return redirect()->route('subject_search6',['slug'=>$request->subject_search]);
        }

        //return redirect()->intended(RouteServiceProvider::HOME);
        if(isset($request->slug) && $request->slug == 'login'){
           $session_url = Session::get('session_full_url');
           return Redirect::to($session_url);
        }else{
        return redirect()->route('student.dashboard');
    }
}else{

    return redirect()->back()->with('login_not_available','Login credentials not available');
}
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        //return redirect('/');
    }
}
