<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recommended_Product;

class RecommendedController extends Controller
{
    public function add(Request $request){
        $r = new Recommended_Product();
        $r->user_id = $request->user_id;
        $r->product_id = $request->product_id;
        $r->save();
        return response()->json(['message'=>"success"]);
    }
}
