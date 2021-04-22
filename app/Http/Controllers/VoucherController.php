<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\UserVoucher;
use App\Models\Voucher;


class VoucherController extends Controller
{
    public function add(Request $request){
        $v = new Voucher();
        $v->voucher_name = $request->voucher_name;
        $v->voucher_score = $request->voucher_score;
        $v->voucher_start = $request->voucher_start;
        $v->voucher_end = $request->voucher_end;
        $v->voucher_total = $request->voucher_total;
        $v->voucher_apply = $request->voucher_apply;
        $v->voucher_price = $request->voucher_price;
        if($request->select_discount=='0'){
            $v->voucher_value = $request->voucher_discount;
        }else{
            $v->voucher_discount = $request->voucher_discount;
        }
        $dt = Carbon::now('Asia/Ho_Chi_Minh');
        // $v->voucher_id = $dt->day.$dt->month.$dt->year.$request->user_id.$dt->hour.$dt->minute.$dt->second;
        $v->save();
        return response()->json(['message'=>'success']);
    }
    public function show(){
        $vs = Voucher::all();
        return response()->json(['vouchers'=>$vs]);
    }
    public function edit(Request $request){
        $v = Voucher::find($request->voucher_id);
        $v->voucher_name = $request->voucher_name;
        $v->voucher_score = $request->voucher_score;
        $v->voucher_price = $request->voucher_price;
        if($request->select_discount=='0'){
            $v->voucher_value = $request->voucher_discount;
            $v->voucher_discount = 0;
        }else{
            $v->voucher_discount = $request->voucher_discount;
            $v->voucher_value = 0;
        }
        $v->voucher_start = $request->voucher_start;
        $v->voucher_end = $request->voucher_end;
        $v->voucher_apply = $request->voucher_apply;
        $v->voucher_total = $request->voucher_total;
        $v->save();
        return response()->json(['message'=>'success']);
    }
    public function getvoucherbyid(Request $request){
        $v = Voucher::find($request->voucher_id);
        return response()->json(['voucher'=>$v]);
    }
    public function checksameuser(Request $request){
        $u = User::find($request->user_id);
        if($u&&$u->user_level=='3'){
            return response()->json(['message'=>'exists']);
        }
        return response()->json(['message'=>'notexists']);
    }
    public function checksamevouchername(Request $request){
        $v = DB::table('vouchers')->where('voucher_name',$request->voucher_name)->first();
        if($v){
            return response()->json(['message'=>'exists']);
        }
        return response()->json(['message'=>'notexists']);
    }
    public function changeapply(Request $request){
        $v = Voucher::find($request->voucher_id);
        if($v->voucher_apply == 'true'){
            $v->voucher_apply = 'false';
        }else{
            $v->voucher_apply = 'true';
        }
        $v->save();
        return response()->json(['message'=>'success']);
    }
    public function getalluservoucher(Request $request){
        $us = DB::table('user')->join('user_voucher','user.user_id','=','user_voucher.user_id')->where('voucher_id',$request->voucher_id)->get();
        return response()->json(['users'=>$us]);
    }
    public function addvoucherformember(Request $request){
        $datausers = json_decode($request->users, true);
        $dataamounts = json_decode($request->amounts, true);
        for($i = 0; $i < sizeof($datausers); $i++){
            $uv = new UserVoucher();
            $uv->voucher_id = $request->voucher_id;
            $uv->user_id = $datausers[$i]['user_id'];
            $u = User::find($datausers[$i]['user_id']);
            $v = Voucher::find($request->voucher_id);
            $u->voucher_user_score -= (int)($dataamounts[$i]*$v->voucher_score);
            $u->save();
            $uv->amount_voucher = $dataamounts[$i];
            $uv->save();
        }
        return response()->json(['message'=>'success']);
    }
    public function getpotentialcustomers(Request $request){
        $v = Voucher::find($request->voucher_id);
        session(['voucher_id'=>$v->voucher_id]);
        $us = DB::table('user')
              ->where('voucher_user_score', '>=', $v->voucher_score)
              ->whereNotExists(function($query)
                {
                    $query->select(DB::raw(1))
                          ->from('user_voucher')
                          ->whereRaw('user_voucher.user_id = user.user_id')
                          ->whereRaw('user_voucher.voucher_id = '.session('voucher_id'));
                })->get();
        return response()->json(['users'=>$us]);
    }
    public function editvoucherforuser(Request $request){
        $uv = DB::table('user_voucher')->where('user_id',$request->user_id)->where('voucher_id',$request->voucher_id)->first();
        $uv = UserVoucher::find($uv->user_voucher_id);
        $old_amount = $uv->amount_voucher;
        $uv->amount_voucher = $request->amount_voucher;
        $u = User::find($uv->user_id);
        $v = Voucher::find($uv->voucher_id);
        $u->voucher_user_score -= (int)(($uv->amount_voucher-$old_amount)*$v->voucher_score);
        $u->save();
        $uv->save();
        return response()->json(['message'=>'success']);
    }
    public function removeUserFromVoucher(Request $request){
        $uv = UserVoucher::find($request->uv_id);
        $u = User::find($uv->user_id);
        $v = Voucher::find($uv->voucher_id);
        $u->voucher_user_score+=(int)($uv->amount_voucher*$v->voucher_score);
        $u->save();
        $uv->delete();
        return response()->json(['message'=>'success']);
    }
    public function removeVoucher(Request $request){
        Voucher::find($request->voucher_id)->delete();
        return response()->json(['message'=>'success']);
    }
    public function getallvoucherforuser(Request $request) {
        $dt = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
        $vs = DB::table('user_voucher')->join('vouchers','user_voucher.voucher_id','=','vouchers.voucher_id')->where('user_id',$request->user_id)->where('voucher_start', '<=', $dt)->where('voucher_end', '>=', $dt)->where('voucher_apply','true')->get('*');
        return response()->json(['vouchers'=>$vs]);
        // return response()->json(['vouchers'=>$dt]);
    }
    public function getdetailvoucher(Request $request){
        $voucher=Voucher::where('voucher_id',$request->voucher_id)->get();
        $user_voucher=DB::table('user_voucher')->where('user_id','=',$request->user_id)->where('voucher_id','=',$request->voucher_id)->get();
        return response()->json(['voucher'=>$voucher,'user_voucher'=>$user_voucher]);
    }

    public function getSumVoucherUser(Request $request){
        $sum=0;
        $uservoucher = UserVoucher::where('voucher_id',$request->voucher_id)->get();
        foreach($uservoucher as $uv){
            $sum+=$uv->amount_voucher;
        }
        return response()->json(['sum'=>$sum]);
    }
}
