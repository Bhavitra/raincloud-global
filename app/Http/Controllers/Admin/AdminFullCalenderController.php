<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Availability;
use App\Models\Teacher;
use App\Models\Subject;
use App\Models\Currency;
use App\Models\TimezoneTime;
use Carbon\Carbon;
use Session;
use DB;

class AdminFullCalenderController extends Controller{
    
     public function index2(Request $request)
    {
           
      if($request->ajax()) {
         $ip = $this->get_client_ip();  //$_SERVER['REMOTE_ADDR']
         $ipInfo = file_get_contents('http://ip-api.com/json/' . $ip);
         $ipInfo = json_decode($ipInfo);
          $timezone = $ipInfo->timezone;
        
                //$teacher_timezone = Teacher::where('id',$teacher_id)->value('timezone');
                $data='';
                
           
                    
                   // $data = DB::table('availabilities')->join('timezone_times','timezone_times.availability_id','=','availabilities.id')->where('availabilities.teacher_id',$teacher_id)->where('booked',null)->get(['availabilities.id', 'timezone_times.title', 'availabilities.start', 'availabilities.end']);
                    
                
            
             $data= Availability::where('teacher_id',$request->teacher_id)->where('booked',null)
                       ->get(['id', 'teacher_id','title', 'start', 'end']);
                
                       
                       
                       
                       
                       //$data= TimezoneTime::where('teacher_id',$request->teacher_id)
                       //->get(['id', 'title','start','end']);
                       
                    
        
  
             return response()->json($data);
        
}
        
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

?>