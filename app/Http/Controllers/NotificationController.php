<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\notifications;

use Session;
use Illuminate\Support\Facades\Storage;

class NotificationController extends Controller
{
    public function delete(Request $request)
    {
        try{
            $all = $request->all();
            if(isset($all['user_id']) && !empty($all['user_id'])){
                
                    $user_id = base64_decode($all['user_id']);

                     notifications::where('user_id',$user_id)->delete();
                    
                   

                Session::flash('error','Notifications has been deleted');
                return 'success';
            }
            return 'failed';
        }catch(\Exception $e){
            return $e->getMessage();
        }
    }
}
