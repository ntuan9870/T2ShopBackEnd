<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function gethome(){
        $countcate = DB::table('categories')->count('category_id');
        $countuser = DB::table('user')->count('user_id');
        $countsuperadmin = DB::table('user')->where('user_level','1')->count('user_id');
        $countadmin = DB::table('user')->where('user_level','2')->count('user_id');
        $countmember = DB::table('user')->where('user_level','3')->count('user_id');
        $countproduct = DB::table('products')->count('product_id');
        $countfeaturedproduct = DB::table('products')->where('product_featured','1')->count('product_id');
        $countorder = DB::table('orders')->count('order_id');
        $countstatustorder1 = DB::table('orders')->where('status','1')->count('order_id');
        $countstatustorder0 = DB::table('orders')->where('status','0')->count('order_id');
        $countcomment = DB::table('comments')->count('comment_id');
        $countrating = DB::table('rating')->count('rating_id');
        return response()->json(['countcate'=>$countcate,
                                 'countuser'=>$countuser,
                                 'countsuperadmin'=>$countsuperadmin,
                                 'countadmin'=>$countadmin,
                                 'countmember'=>$countmember,
                                 'countproduct'=>$countproduct,
                                 'countfeaturedproduct'=>$countfeaturedproduct,
                                 'countorder'=>$countorder,
                                 'countstatustorder1'=>$countstatustorder1,
                                 'countstatustorder0'=>$countstatustorder0,
                                 'countcomment'=>$countcomment,
                                 'countrating'=>$countrating]);
    }
}
