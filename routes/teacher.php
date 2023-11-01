<?php

use Illuminate\Support\Facades\Route;

Route::get('teacher-otp-verify','Frontend\TeacherController@otp_verify')->name('teacher.otp.verify');//route for teacher verify email

Route::get('teacher-otp-veried','Frontend\TeacherController@otp_verified')->name('teacher.otp.verified');//route for teacher verify email

Route::post('teacher-otp-updated','Frontend\TeacherController@otp_updated')->name('teacher.otp.updated');//route for teacher otp updated

Route::get('teacher-password-request','Frontend\TeacherController@password_request')->name('teacher.password.request');//route for teacher password request

Route::get('teacher-reset-link/{email}/{link}','Frontend\TeacherController@reset_link')->name('teacher.reset.link');//route for teacher password request

Route::post('teacher-verify-email-password-request','Frontend\TeacherController@teacher_email_verification_password_request')->name('teacher.verify.email.password.request');//route for teacher otp updated

Route::post('teacher-new-password-update','Frontend\TeacherController@new_password_update')->name('teacher.new.password.update');//route for teacher new password update

Route::group(['prefix'=>'teacher','as'=>'teacher','middleware' => 'teacher_check_session'], function(){
Route::get('teacher-dashboard','Frontend\TeacherController@teacher_dashboard')->name('.dashboard');//route for teacher dashboard

Route::post('teacher-profile-update','Frontend\TeacherController@teacher_profile_update')->name('.profile.update');//route for teacher profile update

Route::get('subjectwise-subsubject','Frontend\TeacherController@subjectwise_subsubject')->name('.subjectwise.subsubject');//route for teacher dashboard

Route::post('availability','Frontend\TeacherController@availability')->name('.availability');//route for teacher dashboard

Route::get('fetch-availabilities','Frontend\TeacherController@fetch_availabilities')->name('.fetch.availabilities');//route for teacher fetch availabilities

Route::get('logout','Frontend\TeacherController@logout')->name('.logout');//route for teacher logout

Route::get('timing-delete','Frontend\TeacherController@timing_delete')->name('.timing.delete');//route for teacher timing delete

Route::post('teacher-student-status-update','Frontend\TeacherController@teacher_student_update')->name('.student.status.update');//route for teacher student update

Route::get('account-delete','Frontend\TeacherController@account_delete')->name('.account.delete');//route for teacher account delete


Route::post('teacher-new-password-update','Frontend\TeacherController@teacher_new_password_update')->name('.new.password.update');



});

?>