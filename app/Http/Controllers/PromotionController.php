<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Promotion;
use Illuminate\Support\Facades\Validator;
use App\Models\product;

class PromotionController extends Controller
{
    public function add(Request $request){
        $p = new Promotion();
        $p->promotion_name = $request->promotion_name;
        $p->promotion_status = $request->promotion_status;
        $p->start_date = $request->start_date;
        $p->end_date = $request->end_date;
        $p->promotion_infor = $request->promotion_infor;
        $p->save();
        return response()->json(['message'=>"success"]);
    }

    public function show(Request $request){
        $promotion=Promotion::all();
        return response()->json(['promotion'=>$promotion]);
    }
    public function status(Request $request){
        $promotion = Promotion::find($request->promotion_id);
        $promotion->promotion_status = 1;
        $promotion->save();
        return response()->json(['message'=>'success']);
    }
    public function remove (Request $request){
        Promotion::destroy($request->promotion_id);
        return response()->json(['message'=>'success']);
    }
    public function getedit(Request $request){
        $promotion=Promotion::find($request->promotion_id);
        return response()->json(['message'=>'success','promotion'=>$promotion]);
    }
    public function postedit(Request $request){
        $promotion = Promotion::find($request->promotion_id);
        $promotion->promotion_name=$request->promotion_name;
        $promotion->promotion_status=$request->promotion_status;
        $promotion->promotion_infor=$request->promotion_infor;
        $promotion->start_date=$request->start_date;
        $promotion->end_date=$request->end_date;
        $promotion->save();
        return response()->json(['success'=>'Sửa đổi thông tin thành công!']);
    }
    public function getproduct(){
        $products=Promotion::where('promotion_status','=',1)->join('products','products.product_promotion','=','promotion.promotion_id')->orderBy('promotion_infor','desc')->limit(5)->get();
        // $products=array();
        // foreach($promotion1 as $p){
        //     $product=product::where('product_promotion','=',$p->promotion_id)->get();
        //     array_push($products,$product);
        // }
        // $promotions = array();
        // for($i=0; $i<count($products);$i++){
        //     foreach($products[$i] as $pr){
        //         $promotion = Promotion::find($pr->product_promotion);
        //         array_push($promotions,$promotion);
        //     }
        // }
        return response()->json(['products'=>$products]);
    }
}
