<?php

namespace App\Http\Controllers;
use App\Models\Store;
use App\Models\StoreWarehouse;
use App\Models\StoreWHInventory;
use App\Models\User;

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
        $s->admin_id = $request->admin_id;
        // $s->wh_capacity = $request->wh_capacity;
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
        // $s->wh_capacity = $request->wh_capacity;
        if($request->store_status=='true'){
            $s->store_status = 1;
        }else{
            $s->store_status = false;
        }
        $s->admin_id = $request->admin_id;
        $s->save();
        return response()->json(['message'=>'success','store'=>$s]);
    }
    public function getAllProductInWH(Request $request){
        // $s = Store::find($request->store_id);
        // $s->store_name = $request->store_name;
        // $s->store_address = $request->store_address;
        // $s->store_ward = $request->store_ward;
        // $s->store_district = $request->store_district;
        // if($request->store_stsatus=='true'){
        //     $s->store_status = 1;
        // }else{
        //     $s->store_status = false;
        // }
        // $s->save();
        // return response()->json(['message'=>'success','store'=>$s]);
    }

    public function showStoreWarehouse(Request $request){
        $s = StoreWarehouse::where('store_id', $request->store_id)->get();
        return response()->json(['message'=>'success','warehouses'=>$s]);
    }
    public function addStoreWareHouse(Request $request){
        $s = new StoreWarehouse();
        $s->store_id = $request->store_id;
        $s->wh_capacity = $request->wh_capacity;
        $s->wh_empty = $request->wh_capacity;
        $s->wh_unit = $request->wh_unit;
        $s->save();
        return response()->json(['message'=>'success']);
    }
    public function getStoreWarehouseByID(Request $request){
        $s = StoreWarehouse::find($request->store_wh_id);
        return response()->json(['message'=>'success', 'store_warehouse'=>$s]);
    }
    public function editWH(Request $request){
        $s = StoreWarehouse::find($request->store_wh_id);
        $s->wh_capacity = $request->wh_capacity;
        $s->wh_unit = $request->wh_unit;
        $s->save();
        return response()->json(['message'=>'success']);
    }
    public function getAllP(Request $request){
        $ps = StoreWHInventory::join('products','products.product_id','=','store_wh_inventories.product_id')->where('store_wh_id',$request->store_wh_id)->get();
        return response()->json(['message'=>'success', 'ps'=>$ps]);
    }
    public function getAllStoreWarehouseByStoreID(Request $request){
        $storeWHs = StoreWarehouse::where('store_id', $request->store_id)->get();
        return response()->json(['message'=>'success', 'storeWHs'=>$storeWHs]);
    }
    public function getAdmin(Request $request){
        $admin = User::where('user_level',2)->select('user_id','user_name')->get();
        return response()->json(['admin'=>$admin]);
    }
}
