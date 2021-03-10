<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use Carbon\Carbon;

class StatisticalController extends Controller
{
    public function getRevenueMonth(Request $request){
        $dt = Carbon::now('Asia/Ho_Chi_Minh');
        $sumday = 0;
        switch($request->month){
            case 1: case 3: case 5: case 7: case 8: case 10: case 12:
                $sumday = 31;
            break;
            case 2:
                if($dt->year%400==0){
                    $sumday = 29;
                }
                $sumday = 28;
            break;
            default:
                $sumday = 30;
            break;
        }
        $arrorder = array();
        for($i = 1; $i <= $sumday; $i++){
            if($i<10){
                $i = '0'.$i;
            }
            $order = DB::table('orders')->where('updated_at','like','%-'.$request->month.'-'.$i.'%')->count('order_id');
            array_push($arrorder,$order);
        }
        return response()->json(['result'=>$arrorder]);
    }
}
