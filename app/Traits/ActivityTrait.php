<?php
  
namespace App\Traits;

use App\Activity;
use Auth;
use App\Jobs\ActivityLogJob;
use Illuminate\Support\Facades\Log;

trait ActivityTrait {

    private $get_id;

    public function activityLog($model,$type, $request) {
        
        $get_user = Auth::user();
        $get_user_ip = ($request->ip());
        $causer_info['causer_ip'] = $request->ip();
        $causer_info['causer_device'] = $request->header('User-Agent');
        //echo($causer_info['causer_ip']);

        if ($request->method() == 'GET'){
            $parameters = null;
        }

        else{
            $parameters = json_decode($model);
        }
    
        $data = [
            'causer'        => json_encode($get_user),
            'causer_info'   => json_encode($causer_info),
            'causer_type'   => $type,
            'path'          => $request->fullUrl(),
            'method'        => $request->method(),
            'parameters'    => json_encode($parameters),
            
            //'previous_data' => json_encode($previous_data),
                            
        ];

        ActivityLogJob::dispatch($data)->onQueue('activity');
     
    }
  
}