<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Accessories;

class AccessoriesController extends Controller
{
    public function add(Request $request){
        $a= new Accessories();
        $a->acc_name = $request->acc_name;
        $filename= $request->acc_img->getClientOriginalName();
        $a->acc_img = "http://localhost:8000/storage/accessories_img/".$filename;
        $request->acc_img->storeAs('accessories_img',$filename);
        $a->save();
        return response()->json(['message'=>"success",'filename'=>$filename]);
    }
    public function show(){
        $accessories=Accessories::all();
        return response()->json(['accessories'=>$accessories]);
    }
}
