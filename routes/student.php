<?php

use Illuminate\Support\Facades\Route;

Route::get('student-login/{slug?}','Frontend\StudentController@index')->name('student.login');//route for student login
Route::get('student-signup','Frontend\StudentController@signup')->name('student.signup');//route for student sign up
Route::post('student-registration','Frontend\StudentController@registration')->name('student.registration');//route for student registration
Route::get('student-email-verification/{id}','Frontend\StudentController@email_verification')->name('student.email_verification');//route for student email verification
Route::post('student-verify-email','Frontend\StudentController@verify_email')->name('student.verify_email');//route for student verify email

Route::get('student-otp-verify','Frontend\StudentController@otp_verify')->name('student.otp.verify');//route for student verify email

Route::get('student-otp-veried','Frontend\StudentController@otp_verified')->name('student.otp.verified');//route for student verify email

Route::get('student-password-request','Frontend\StudentController@password_request')->name('student.password.request');//route for student password request

Route::post('student-otp-updated','Frontend\StudentController@otp_updated')->name('student.otp.updated');//route for teacher otp updated

Route::post('student-verify-email-password-request','Frontend\StudentController@student_email_verification_password_request')->name('student.verify.email.password.request');//route for student otp updated

Route::get('student-reset-link/{email}/{link}','Frontend\StudentController@reset_link')->name('student.reset.link');//route for student password request

Route::post('student-new-password-update','Frontend\StudentController@new_password_update')->name('student.new.password.update');//route for student new password update

Route::group(['prefix'=>'student','as'=>'student','middleware' => 'student_check_session'], function(){

           Route::get('dashboard','Frontend\StudentController@dashboard')->name('.dashboard');
           Route::post('profile-update','Frontend\StudentController@profile_update')->name('.profile.update');
           Route::post('review-add','Frontend\StudentController@review_add')->name('.review.add');
           Route::get('booking-cancel','Frontend\StudentController@booking_cancel')->name('.booking_cancel');

          

	});


?>