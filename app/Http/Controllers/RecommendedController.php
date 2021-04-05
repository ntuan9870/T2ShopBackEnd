<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recommended_Product;
use Illuminate\Support\Facades\DB;
use App\Models\Promotion;
use App\Models\Category;
use App\Models\product;

class RecommendedController extends Controller
{
    public function add(Request $request){
        $r = new Recommended_Product();
        $r->user_id = $request->user_id;
        $r->product_id = $request->product_id;
        $r->save();
        return response()->json(['message'=>"success"]);
    }
   
    public function getrecommened(Request $request){
        if($request->user_id){
            $category = Recommended_Product::where('user_id',$request->user_id)->select('product_id')->orderBy('recommend_id','asc')->get();
            $products = array();
            $product = array();
            foreach($category as $c){
                $product = DB::table('products')->join('categories','products.product_cate','=','categories.category_id')->where('category_name','LIKE','%'.$c->product_id.'%')->get();
                array_push($products,$product);
            }
            $promotions = array();
            for($i=0; $i<count($products);$i++){
                foreach($products[$i] as $promo){
                    $promotion = Promotion::find($promo->product_promotion);
                    array_push($promotions,$promotion);
                }
            }
            if($product){
                return response()->json(['products'=>$product,'promotions'=>$promotions]);
            }
        }
    }
    public function showCate(Request $request){
        $product = DB::table('products')->where('product_name',$request->key)->select('product_cate')->first();
        $productCate=Category::find($product);
        return response()->json(['productCate'=>$productCate]);
    }
}
