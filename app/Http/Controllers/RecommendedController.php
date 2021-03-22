<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recommended_Product;
use Illuminate\Support\Facades\DB;
use App\Models\Promotion;

class RecommendedController extends Controller
{
    public function add(Request $request){
        $r = new Recommended_Product();
        $r->user_id = $request->user_id;
        $r->product_id = $request->product_id;
        $r->save();
        return response()->json(['message'=>"success"]);
    }
   
    public function get(Request $request){
        $category = Recommended_Product::where('user_id',$request->id)->select('product_id')->get();
        $products = array();
        foreach($category as $c){
            $product = DB::table('products')->join('categories','products.product_cate','=','categories.category_id')->where('category_name','LIKE','%'.$c->product_id.'%')->get();
            array_push($products,$product);
        }
        $promotions = array();
        // foreach($productsrecommend as $p){
        //     $promotion = Promotion::find($p->product_promotion);
        //     array_push($promotions,$p);
        // }
        for($i=0; $i<count($products);$i++){
            // array_push($promotions,$productsrecommend[$i]);
            foreach($products[$i] as $promo){
                $promotion = Promotion::find($promo->product_promotion);
                array_push($promotions,$promotion);
            }
        }
        return response()->json(['products'=>$products,'promotions'=>$promotions]);
    }
}
