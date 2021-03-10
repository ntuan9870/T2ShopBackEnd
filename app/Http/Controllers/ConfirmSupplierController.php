<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderWarehouse;

class ConfirmSupplierController extends Controller
{
    // public function getConfirm($id){
    //     return view('confirmsupplier');
    // }
    public function postStatus(Request $request){
        $OrderWH=OrderWarehouse::find($request->orderWh_id);
        $OrderWH->status=$request->status;
        $OrderWH->save();
        return view('welcome');
    }
}
