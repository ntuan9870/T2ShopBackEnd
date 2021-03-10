<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Models\OrderWarehouse;
use Illuminate\Support\Facades\Validator;

class SupplierController extends Controller
{
    public function add(Request $request){
        $validator = Validator::make($request->all(),[
            'supplier_phone' =>'unique:supplier,supplier_phone|min:9|max:10',
            'supplier_email' =>'unique:supplier,supplier_email',
        ],[
            'supplier_phone.unique' => 'Số điện thoại đã tồn tại !',
            'supplier_email.unique' => 'Email đã tồn tại !',
        ]);
        if($validator->fails()){
            return response()->json(['error'=>$validator->errors()->all()]);
        }
        $s = new Supplier();
        $s->supplier_name = $request->supplier_name;
        $s->supplier_address = $request->supplier_address;
        $s->supplier_phone = $request->supplier_phone;
        $s->supplier_email = $request->supplier_email;
        $s->save();
        return response()->json(['message'=>"success"]);
    }
    public function checkphone(Request $request){
        if(Supplier::where('supplier_phone',$request->phone)->exists()){
            return response()->json(['message'=>'SĐT đã tồn tại trong hệ thống']);
        }
    }
    public function show(){
        $supplier=Supplier::all();
        return response()->json(['message'=>'success','supplier'=>$supplier]);
    }
    public function getedit(Request $request){
        $supplier=Supplier::find($request->supplier_id);
        return response()->json(['message'=>'success','supplier'=>$supplier]);
    }
    public function postedit(Request $request){
        $validator = Validator::make($request->all(),[
            'supplier_phone' =>'min:9|max:10',
        ]);
        if($validator->fails()){
            return response()->json(['error'=>$validator->errors()->all()]);
        }
        $s=Supplier::where('supplier_id','!=',$request->supplier_id)->get();
        foreach($s as $key){
            if($key->supplier_phone==$request->supplier_phone){
                return response()->json(['error'=>'SĐT đã trùng!']);
            }else{
                if($key->supplier_email==$request->supplier_email){
                    return response()->json(['error'=>'Email đã trùng!']);
                }
            }
        }
        $supplier = Supplier::find($request->supplier_id);
        $supplier->supplier_name=$request->supplier_name;
        $supplier->supplier_address=$request->supplier_address;
        $supplier->supplier_phone=$request->supplier_phone;
        $supplier->supplier_email=$request->supplier_email;
        $supplier->save();
        return response()->json(['success'=>'Sửa đổi thông tin thành công!']);
    }
    public function remove(Request $request){
        Supplier::destroy($request->supplier_id);
        return response()->json(['message'=>'success']);
    }
    public function getdetail(Request $request){
        // $supplier = Supplier::find($request->supplier_id);
        $supplier = Supplier::where('supplier_id',$request->supplier_id)->get();
        $cost=OrderWarehouse::where('warehouse_id',$request->supplier_id)->sum('cost');
        $debt=OrderWarehouse::where('warehouse_id',$request->supplier_id)->sum('debt');
        $money=OrderWarehouse::where('warehouse_id',$request->supplier_id)->sum('money');
        return response()->json(['message'=>'success','supplier'=>$supplier,'cost'=>$cost,'debt'=>$debt,'money'=>$money]); 
    }
    public function getorder(Request $request){
        $order=OrderWarehouse::where('warehouse_id',$request->supplier_id)->get();
        return response()->json(['message'=>'success','order'=>$order]); 
    }
}
