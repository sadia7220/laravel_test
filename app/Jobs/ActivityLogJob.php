<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use App\Activity;
use Auth;

class ActivityLogJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    // public $model, $type, $user, $path, $method, $causer_type, $activity;
    
    protected $data;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        
        $this->data = $data;
        //$this->handle();
        Log::info("Job starting", $this->data);
        //$this->handle();

       
        //$this->$activity = $activity;
        // $this->causer_type  = $type;
        // $this->user  = Auth::user()->id;
        // $this->path  = $request->path();
        // $this->method  = $request->method();
        //$this->requestObject = $request;


        // echo( $this->method);
        // echo( $this->path);
        //$this->request_method = $request->method();
 

    }


    public function handle()

    {
        //echo('Jobs');
         //new Activity->fill($this->data)->save();
         Log::info("Job is being handle");

         $activity = new Activity;
         Log::info("Activity opened");

         $activity->fill(($this->data));
         $activity->save();
         Log::info("Activity Saved");

         
         
         
         //$this->activityLog($menu,'ironman-user', $request);

        //$parameters = json_decode($this->data);
        
        //$activity->data =json_encode($parameters);
      
        //$activity->save();


        // $this->activity = json_decode($this->activity);
        // $this->activity->save();
        //echo($this->type);
        //if ($this->type  == 'GET' ){
        // if ($this->method == 'GET' ) {
        //     $activity = new Activity;
        //     $activity->causer_type = $this->causer_type;
        //     $activity->causer_id = $this->user;
        //     $activity->path = $this->path;
        //     $activity->method = $this->method;
        //     $activity->save();
        // }
    
        // else {
        //     $activity = new Activity;
        //     $activity->causer_type = $this->causer_type;
        //     $activity->causer_id = $this->user;
        //     $activity->path = $this->path;
        //     $activity->method = $this->method;
        //     // DECODING BRAND 
           
        //     $parameters = json_decode($this->model);
        //     if ($activity->method != 'GET'){
        //         $activity->parameters =json_encode($parameters);
        //     }
        //     $activity->save();
        // }

    }
}
