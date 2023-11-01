<?php

use Illuminate\Support\Facades\Route;


Route::get('admin','Admin\AdminController@index')->name('admin');//route for index page
Route::post('admin-login','Admin\AdminController@admin_login')->name('admin.login');//route for login page

Route::group(['prefix'=>'admin','as'=>'admin','middleware' => 'admin_check_session'], function(){

	Route::get('dashboard','Admin\AdminController@dashboard')->name('.dashboard');
	Route::get('tutors','Admin\AdminController@tutor_details')->name('.tutor.details');
	Route::get('tutor-status-update','Admin\AdminController@tutor_status_update')->name('.tutor.status.update');
	Route::get('tutor-view','Admin\AdminController@tutor_view')->name('.tutor.view');
	Route::get('tutor-availability','Admin\AdminController@tutor_availability')->name('.tutor.availability');
	Route::get('currency-conversion','Admin\AdminController@currency_conversion')->name('.currency.conversion');
	Route::get('currency-edit','Admin\AdminController@currency_edit')->name('.currency.edit');
	Route::post('currency-update','Admin\AdminController@currency_update')->name('.currency.update');
	Route::get('commission','Admin\AdminController@commission')->name('.commission');
    Route::get('commission-edit','Admin\AdminController@commission_edit')->name('.commission.edit');
    Route::post('commission-update','Admin\AdminController@commission_update')->name('.commission.update');
    Route::get('tutor-income','Admin\AdminController@tutor_income')->name('.tutor.income');
    Route::get('subjects','Admin\AdminController@subjects')->name('.subjects');

    Route::post('subject-add','Admin\AdminController@subject_add')->name('.subject.add');
    Route::post('subject-delete','Admin\AdminController@subject_delete')->name('.subject.delete');
    Route::get('sub-subjects','Admin\AdminController@sub_subjects')->name('.sub.subjects');
    Route::post('sub-subject-add','Admin\AdminController@sub_subject_add')->name('.sub_subject.add');
    Route::post('sub-subject-delete','Admin\AdminController@sub_subject_delete')->name('.sub_subject.delete');
    Route::get('levels','Admin\AdminController@levels')->name('.level');
    Route::post('level-add','Admin\AdminController@level_add')->name('.level.add');
    Route::post('level-delete','Admin\AdminController@level_delete')->name('.level.delete');
    Route::get('languages','Admin\AdminController@languages')->name('.languages');
    Route::post('language-add','Admin\AdminController@language_add')->name('.language.add');
    Route::post('language-delete','Admin\AdminController@language_delete')->name('.language.delete');
    Route::get('countries','Admin\AdminController@countries')->name('.countries');
    Route::post('country-add','Admin\AdminController@country_add')->name('.country.add');
    Route::post('country-delete','Admin\AdminController@country_delete')->name('.country.delete');
    Route::get('slider','Admin\AdminController@banner_slider')->name('.banner.slider');
    Route::post('slider-add','Admin\AdminController@banner_slider_add')->name('.banner.slider.add');
    Route::post('slider-delete','Admin\AdminController@banner_slider_delete')->name('.slider.delete');
    Route::get('about','Admin\AdminController@about')->name('.about');
    Route::post('about-update','Admin\AdminController@about_update')->name('.about.update');

     Route::get('webinfo','Admin\AdminController@webinfo')->name('.webinfo');
     Route::get('seo','Admin\AdminController@seo')->name('.seo');

     Route::post('webinfo-update','Admin\AdminController@webinfo_update')->name('.webinfo.update');

      Route::get('student-details','Admin\AdminController@student_details')->name('.student.details');

       Route::get('student-delete/{id}','Admin\AdminController@student_delete')->name('.student.delete');

       Route::get('student-tutor-bookings','Admin\AdminController@student_tutor_bookings')->name('.student.tutor-bookings');

        Route::get('student-class-history','Admin\AdminController@student_class_history')->name('.student.class-history');

         Route::get('tutor-class-history','Admin\AdminController@tutor_class_history')->name('.tutor.class-history');

          Route::get('booking-history','Admin\AdminController@booking_history')->name('.booking-history');

           Route::get('admin-income','Admin\AdminController@admin_income')->name('.admin-income');

             Route::get('chat-history','Admin\AdminController@admin_chat')->name('.chat');

              Route::get('edit-seo','Admin\AdminController@seo_edit')->name('.seo.edit');

              Route::post('seo-update','Admin\AdminController@seo_update')->name('.seo.update');

               Route::get('reviews','Admin\AdminController@reviews')->name('.reviews');

               Route::get('logout','Admin\AdminController@logout')->name('.logout');

               Route::post('tutor-income-update','Admin\AdminController@tutor_income_update')->name('.tutor.income.update');

               Route::get('status-update','Admin\AdminController@status_update')->name('.status.update');
               Route::get('teacher-delete/{id}','Admin\AdminController@teacher_delete')->name('.teache.delete');
               
               
               Route::get('check','Admin\AdminController@check')->name('check');
               
               //Route::get('fullcalender2', [AdminFullCalenderController::class, 'index2']);
                Route::get('fullcalender2','Admin\AdminFullCalenderController@index2')->name('fullcalender2');
               //Route::post('fullcalenderAjax', [AdminFullCalenderController::class, 'ajax']);
               
               
                Route::get('order-delete/{booking_id}','Admin\AdminController@order_delete')->name('.order_delete');
              

	});

?>