<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        //return view('auth.register');

        return view('frontend.student.registration');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'otp' => rand(1,9999),
        ]);

        $id = $user->id;

        //event(new Registered($user));

        //Auth::login($user);

       // return redirect(RouteServiceProvider::EMILVERIFICATION);

        return redirect()->route('student.email_verification',['id'=>$id]);
    }


    public function email_verified($id)
    {
       $user2 = User::where('id',$id)->where('deleted','no')->first();
        //User::where('id',$id)->update(['deleted'=>'yes']);
       User::where('id',$id)->delete();
        $user = User::create([
            'name' => $user2->name,
            'email' => $user2->email,
            'password' => $user2->password,
            'otp' => $user2->otp,
            'otp_verified' => 'yes'
        ]);

        event(new Registered($user));

        Auth::login($user);

       // return redirect(RouteServiceProvider::EMILVERIFICATION);

        return redirect()->route('student.dashboard');
    }
}
