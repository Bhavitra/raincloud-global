<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FullCalenderController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*
Route::get('/', function () {
    return view('welcome');
});
*/

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('clear-cache', function () {
   Artisan::call('cache:clear');
   Artisan::call('route:clear');

   return "Cache cleared successfully";
});

Route::get('/','Frontend\FrontendController@index')->name('/');//route for index page

Route::get('teacher-login','Frontend\TeacherController@index')->name('teacher.login');//route for teacher login

Route::get('teacher-signup','Frontend\TeacherController@signup')->name('teacher.signup');//route for teacher sign up

Route::post('teacher-registration','Frontend\TeacherController@registration')->name('teacher.registration');//route for teacher registration

Route::get('teacher-sub-subject-fetch','Frontend\TeacherController@teacher_sub_subject_fetch');//route for teacher sub subject fetch

Route::get('teacher-login-verify/{id}','Frontend\TeacherController@teacher_login_verify')->name('teacher.login.verify');//route for teacher email verification form

Route::post('teacher-verify-email','Frontend\TeacherController@teacher_verify_email')->name('teacher.verify.email');//route for teacher email verification

Route::post('teacher-logged-in','Frontend\TeacherController@teacher_logged_in')->name('teacher.logged.in');//route for teacher logged in

Route::get('search','Frontend\FrontendController@search')->name('search');

Route::get('teacher-timing','Frontend\FrontendController@teacher_timing');//route for teacher timing

Route::post('book','Frontend\FrontendController@book')->name('book');//route for teacher timing

Route::get('payment-success','Frontend\FrontendController@payment_success')->name('payment_success');//route for payment success

Route::get('student-delete','Frontend\FrontendController@student_delete')->name('student.delete');//route for student delete

Route::get('student-logout','Frontend\FrontendController@student_logout')->name('student.logout');//route for student logout

Route::post('password-update','Frontend\FrontendController@password_update')->name('password.update');//route for student password update

Route::get('usd','Frontend\FrontendController@usd')->name('usd');//route for usd

Route::get('inr','Frontend\FrontendController@inr')->name('inr');//route for inr

Route::get('chat','Frontend\FrontendController@chat')->name('chat');//route for chat

Route::get('get-value','Frontend\FrontendController@get_value')->name('get-value');//route for get value

Route::get('get-value-json','Frontend\FrontendController@get_value_json')->name('get-value-json');//route for get value json

Route::get('testing','Frontend\FrontendController@testing')->name('testing');
Route::get('subject-search/{slug}','Frontend\FrontendController@subject_search')->name('subject_search');
Route::get('subject-search6/{slug}','Frontend\FrontendController@subject_search6')->name('subject_search6');

  Route::get('auth/google/{slug?}', 'Auth\GoogleController@redirectToGoogle');
       //Route::get('auth/google/book', 'Auth\GoogleController@redirectToGoogleBook');
  Route::get('callback', 'Auth\GoogleController@handleGoogleCallback');
  
  
  
  Route::get('teacher-detail-listing','Frontend\FrontendController@teacher_detail_listing')->name('teacher_detail_listing');
    Route::get('teacher-detail-day','Frontend\FrontendController@teacher_detail_day')->name('teacher_detail_day');
    Route::get('teacher-day-time','Frontend\FrontendController@teacher_day_time')->name('teacher_day_time');
    
     Route::post('check','Frontend\FrontendController@check')->name('check');
     
      Route::get('teacher-day-change','Frontend\FrontendController@teacher_day_change')->name('teacher_day_change');
      
       Route::get('fullcalender', [FullCalenderController::class, 'index']);
       Route::post('fullcalenderAjax', [FullCalenderController::class, 'ajax']);
       
         Route::get('fullcalender2', [FullCalenderController::class, 'index2']);
       Route::post('fullcalenderAjax2', [FullCalenderController::class, 'ajax2']);
       
       
        Route::get('teacher-profile/{id}','Frontend\FrontendController@teacher_profile')->name('teacher_profile');




