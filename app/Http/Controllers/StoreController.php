<?php

namespace App\Http\Controllers;
use App\Models\Store;

use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function addStore(Request $request){
        $s = new Store();
        $s->store_name = $request->store_name;
        $s->store_address = $request->store_address;
        $s->store_ward = $request->store_ward;
        $s->store_district = $request->store_district;
        $s->store_status = 1;
        $s->save();
        return response()->json(['message'=>'success']);
    }
    public function checkSameName(Request $request){
        $s = Store::where('store_name',$request->store_name)->first();
        if($s){
            return response()->json(['message'=>'same']);
        }else{
            return response()->json(['message'=>'notsame']);
        }
    }
    public function checkSameAddress(Request $request){
        $s = Store::where('store_address',$request->store_address)->where('store_ward',$request->store_ward)->where('store_district',$request->store_district)->first();
        if($s){
            return response()->json(['message'=>'same']);
        }else{
            return response()->json(['message'=>'notsame']);
        }
    }
    public function showStore(){
        $stores = Store::all();
        return response()->json(['message'=>'success','stores'=>$stores]);
    }
    public function changeStatus(Request $request){
        $s = Store::find($request->store_id);
        if($s->store_status==0){
            $s->store_status=1;
        }else{
            $s->store_status=0;
        }
        $s->save();
        return response()->json(['message'=>'success']);
    }
    public function getStore(Request $request){
        $s = Store::find($request->store_id);
        return response()->json(['message'=>'success','store'=>$s]);
    }
    public function editStore(Request $request){
        $s = Store::find($request->store_id);
        $s->store_name = $request->store_name;
        $s->store_address = $request->store_address;
        $s->store_ward = $request->store_ward;
        $s->store_district = $request->store_district;
        if($request->store_status=='true'){
            $s->store_status = 1;
        }else{
            $s->store_status = false;
        }
        $s->save();
        return response()->json(['message'=>'success','store'=>$s]);
    }
}
