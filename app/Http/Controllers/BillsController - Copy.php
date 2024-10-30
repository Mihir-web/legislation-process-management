<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\bills;
use App\Models\user;
use App\Models\votes;
use App\Models\notifications;
use App\Http\Requests\AddBillRequest;
use App\Http\Requests\UpdateBillRequest;

use Session;
use Illuminate\Support\Facades\Storage;

class BillsController extends Controller
{
    

    public function index(Request $request)
    {
        $filter = $request->all();
        $bills = bills::where(function($q)use($filter){
                    if(isset($filter['search']) && !empty($filter['search'])){
                        $q->where('name','LIKE','%'.$filter['search'].'%');
                    }
                })->where(function($q)use($filter){
                    if(isset($filter['status']) ){
                        $q->where('is_active',$filter['status']);
                    }
                })->orderBy('created_at','asc')->get();
        $bills_total = bills::count();
        

        

        return view('bills.list',compact('bills','bills_total','filter'));
    }

    public function create()
    {
        
        return view('bills.create');
    }

    public function store(AddBillRequest $request)
    {
        try{
                $all = $request->all();
                
                $bills = bills::create($all);
                return redirect()->route('bills')->with('success','New car added successfully!');
            }catch(\Exception $e){
                echo "<pre>"; print_r($e->getMessage()); exit;
                return redirect()->back()->with('error',$e->getMessage());
        }
    }

    public function edit($id)
    {
        $id = base64_decode($id);
        $bill = bills::find($id);
        
        return view('bills.edit',compact('bill'));
    }

    public function update(UpdateBillRequest $request)
    {
        try{
            $all = $request->all();
        //    echo "<pre>"; print_r($all); exit;
           
           
            bills::find(base64_decode($all['bid']))->update($all);
            

            
                return redirect()->route('bills')->with('success','Inventory updated successfully');
           
        }catch(\Exception $e){
            
            return redirect()->back()->with('error',$e->getMessage());
        }
    }

    public function statuschange(Request $request)
    {
        try{
            $inputs = $request->all();
            $record = bills::find(base64_decode($inputs['id']));
            
          


            if(!empty($record)){
              
                    $record->update(['status'=>$inputs['status']]);
                    
                    if($inputs['status'] == 5){
                        $mps = user::where('role_id', 2)->get();
                       
                        foreach($mps as $mp_data){
                            $notification['user_id'] =  $mp_data->id;
                            $notification['message'] =  "Voting session started for the bill '".$record->title."'."; 
                            notifications::create($notification);
                        }   
                    }
                    
                
                return 'success';
            }
            return 'Record not found';
        }catch(\Exception $e){
            return $e->getMessage();
        }
    }

    public function voting(Request $request)
    {
        try{
            $inputs = $request->all();

            $vote['bill_id'] = base64_decode($inputs['bill_id']);
            $vote['user_id'] = $inputs['user_id'];
            $vote['vote'] = $inputs['vote'];
            
           
            $record = votes::create($vote);
            
            if(!empty($record)){
                return 'success';
            }
            return 'Record not found';
        }catch(\Exception $e){
            return $e->getMessage();
        }
    }

    public function delete(Request $request)
    {
        try{
            $all = $request->all();
            if(isset($all['id']) && !empty($all['id'])){
                
                    $id = base64_decode($all['id']);

                    $inventory = bills::find($id);
                    
                   
                    $inventory->delete();

                Session::flash('error','A record has been deleted');
                return 'success';
            }
            return 'failed';
        }catch(\Exception $e){
            return $e->getMessage();
        }
    }
}
