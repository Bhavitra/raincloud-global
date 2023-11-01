<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Availability;
use App\Models\Teacher;
use App\Models\Subject;
use App\Models\Currency;
use App\Models\TimezoneTime;
use Carbon\Carbon;
use Session;
use DB;


class FullCalenderController extends Controller
{
     public function index(Request $request)
    {
        
         $email = Session::get('teacher_email');
         $teacher_id = Teacher::where('email',$email)->value('id');

    if($request->ajax()) {
             $data = Availability::whereDate('start', '>=', $request->start)
                       ->whereDate('end',   '<=', $request->end)->where('teacher_id',$teacher_id)->where('booked',null)
                       ->get(['id', 'title', 'start', 'end']);
  
             return response()->json($data);
        }

        
         
          $n = 1; //nth dash
$str = $request->title;  

$pieces = explode('-', $str);
$part1 = implode('-', array_slice($pieces, 0, $n));
$part2 = $pieces[$n];
  
        return view('fullcalender');

          switch ($request->type) {
           case 'add':
              $event = Availability::create([
                  'teacher_id' => $teacher_id,
                  'title' => $request->title,
                  'title1' => $part1,
                  'title2' =>$part2,
                  'start' => $request->start,
                  'end' => $request->end,
                  'status' =>'active'

              ]);
 
              return response()->json($event);
             break;
  
           case 'update':
              $event = Availability::find($request->id)->update([
                  'title' =>$request->title,
                  'title1' => $part1,
                   'title2' => $part2,
                  'start' => $request->start,
                  'end' => $request->end,
              ]);
 
              return response()->json($event);
             break;
  
           case 'delete':
              $event = Availability::find($request->id)->delete();
               return response()->json($event);
             break;
             
           default:
             # code...
             break;
        }
    }

     public function ajax(Request $request)
    {
            $email = Session::get('teacher_email');
         $teacher_id = Teacher::where('email',$email)->value('id');
         
         if(($request->type == 'add') || ($request->type == 'update')){
         $n = 1; //nth dash
$str = $request->title;  

$pieces = explode('-', $str);
$part1 = implode('-', array_slice($pieces, 0, $n));
$part2 = $pieces[$n];
}

//echo $part1; //abc-def-ghi-jkl
//echo $part2; //mno

         switch ($request->type) {
           case 'add':
              $event = Availability::create([
                  'teacher_id' => $teacher_id,
                  'title' => $request->title,
                  'title1' => $part1,
                  'title2' => $part2,
                  'start' => $request->start,
                  'end' => $request->end,
                  'status' =>'active'
              ]);
 
              return response()->json($event);
             break;
  
           case 'update':
              $event = Availability::find($request->id)->update([
                  'title' => $request->title,
                  'title1' => $part1,
                  'title2' => $part2,
                  'start' => $request->start,
                  'end' => $request->end,
              ]);
               return response()->json($event);
             break;
  
           case 'delete':
              $event = Availability::find($request->id)->delete();
  
              return response()->json($event);
             break;
             
           default:
             # code...
             break;
         }

    }
    
    
    
    
    
    
    
    
     public function index2(Request $request)
    {

    if($request->ajax()) {
         $ip = $this->get_client_ip();  //$_SERVER['REMOTE_ADDR']
         $ipInfo = file_get_contents('http://ip-api.com/json/' . $ip);
         $ipInfo = json_decode($ipInfo);
          $timezone = $ipInfo->timezone;
        
                $teacher_timezone = Teacher::where('id',$request->teacher_id)->value('timezone');
                $data='';
                
                if($teacher_timezone != $timezone){
                    
                    $data = DB::table('availabilities')->join('timezone_times','timezone_times.availability_id','=','availabilities.id')->where('availabilities.teacher_id',$request->teacher_id)->where('booked',null)->where('ip_address',$ip)->get(['availabilities.id', 'timezone_times.title', 'availabilities.start', 'availabilities.end']);
                
                }else{
            
             $data= Availability::whereDate('start', '>=', $request->start)
                       ->whereDate('end',   '<=', $request->end)->where('teacher_id',$request->teacher_id)->where('booked',null)
                       ->get(['id', 'title', 'start', 'end']);
                }
                       
                       
                       
                       
                       //$data= TimezoneTime::where('teacher_id',$request->teacher_id)
                       //->get(['id', 'title','start','end']);
                       
                    
        
  
             return response()->json($data);
        }
/*
         $email = Session::get('teacher_email');
         $teacher_id = Teacher::where('email',$email)->value('id');
         
          $n = 1; //nth dash
$str = $request->title;  

$pieces = explode('-', $str);
$part1 = implode('-', array_slice($pieces, 0, $n));
$part2 = $pieces[$n];
  
        return view('fullcalender');

          switch ($request->type) {
  
           case 'book':
              $event = Availability::find($request->id)->delete();
               return response()->json($event);
             break;
             
           default:
             # code...
             break;
        }
        */
        
    }

     public function ajax2(Request $request)
    {
        
         $ip = $this->get_client_ip();  //$_SERVER['REMOTE_ADDR']
$ipInfo = file_get_contents('http://ip-api.com/json/' . $ip);
$ipInfo = json_decode($ipInfo);
 $timezone = $ipInfo->timezone;
        
       $availability = Availability::where('id',$request->id)->first();
       
       $date = Carbon::parse($availability->start)->format('d-m-Y');
       
       $day = Carbon::createFromFormat('Y-m-d', $availability->start)->format('l');
       
       $teacher_id = Availability::where('id',$request->id)->value('teacher_id');
       
       $teacher_timezone = Teacher::where('id',$request->id)->value('timezone');
        
       $hourly_rate = Teacher::where('id',$teacher_id)->value('hourly_rate');
       
       $currency = Teacher::where('id',$teacher_id)->value('currency');
       
       $teacher_first_name = Teacher::where('id',$teacher_id)->value('first_name');
       $teacher_last_name = Teacher::where('id',$teacher_id)->value('last_name');
       
       $teacher_name = $teacher_first_name.' '.$teacher_last_name;
       
       $currency_name = Currency::where('currency_slug',$currency)->value('currency_value');
       $title='';
       if($teacher_timezone != $timezone){
       $title = TimezoneTime::where('availability_id',$request->id)->value('title');
       }else{
           $title = Availability::where('id',$request->id)->value('title');
       }
        
        
         //$event = Availability::find($request->id)->delete();
         //$event = $request->id;
  
              return response()->json(['date'=>$date,'availability'=>$availability,'day'=>$day,'amount'=>$hourly_rate,'teacher_name'=>$teacher_name,'currency'=>$currency_name,'teacher_id'=>$teacher_id,'id'=>$request->id,'cu'=>$currency,'title'=>$title]);
              
            /*  
            $email = Session::get('teacher_email');
         $teacher_id = Teacher::where('email',$email)->value('id');
         
         $n = 1; //nth dash
$str = $request->title;  

$pieces = explode('-', $str);
$part1 = implode('-', array_slice($pieces, 0, $n));
$part2 = $pieces[$n];

//echo $part1; //abc-def-ghi-jkl
//echo $part2; //mno

         switch ($request->type) {
       
  
           case 'book':
              $event = Availability::find($request->id)->delete();
  
              return response()->json($event);
             break;
             
           default:
             # code...
             break;
         }
         */

    }
    
    
       function get_client_ip() {
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
    
}
