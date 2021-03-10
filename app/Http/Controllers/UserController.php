<?php

namespace App\Http\Controllers;

use App\Models\MaXacNhan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function register(Request $request){
        $validator = Validator::make($request->all(),[
            'user_name' => 'required|unique:user,user_name',
            'user_email' => 'required|unique:user,user_email',
            'user_password' => 'required'
        ]);
        if($validator->fails()){
            return response()->json(['error'=>$validator->errors()->all()],409);
        }
        $u = new User();
        $u->user_name = $request->user_name;
        $u->user_email = $request->user_email;
        $u->user_password = encrypt($request->user_password);
        $u->user_phone = $request->user_phone;
        if($request->user_level){
            $u->user_level = $request->user_level;
        }
        $u->save();
        return response()->json(['success'=>'Đăng ký thành công!']);
    }
    public function login(Request $request){
        $validator = Validator::make($request->all(),[
            'user_email' => 'required',
            'user_password' => 'required'
        ]);
        if($validator->fails()){
            return response()->json(['error'=>$validator->errors()->all()],409);
        }
        $user = User::where('user_email',$request->user_email)->get()->first();
        if(!$user){
            return response()->json(['result'=>'fail']);
        }
        $password = decrypt($user->user_password);
        if($password==$request->user_password){
            return response()->json(['user'=>$user,'result'=>'success']);
        }else{
            return response()->json(['result'=>'fail']);
        }
    }
    public function checksameusername(Request $request){
        $validator = Validator::make($request->all(),[
            'username' => 'required|unique:user,user_name'
        ]);
        if($validator->fails()){
            if($request->username!=''){
                return response()->json(['error'=>'same']);
            }
        }
        return response()->json(['success'=>'notsame']);
    }
    public function checksameemail(Request $request){
        $validator = Validator::make($request->all(),[
            'useremail' => 'required|unique:user,user_email'
        ]);
        if($validator->fails()){
            return response()->json(['error'=>'same']);
        }
        return response()->json(['success'=>'notsame']);
    }

    public function sendemail(Request $request){
        $validator = Validator::make($request->all(),[
                'email' => 'required'
            ],[
                'email.required' => 'Email là trường bắt buộc!'
            ]
        );
        if($validator->fails()){
            return response()->json(['message'=>'fail']);
        }
        $_SESSION['email'] = $request->email;
        $_SESSION['code'] = mt_rand(10000000, 99999999);
        $code = $_SESSION['code'];
        $data = [
            'code'=> $code
        ];
        $user = DB::table('user')->where('user_email','=',$request->email)->get('*')->first();
        $dk = DB::table('maxacnhan')->where('id_user','=',$user->user_id)->get('*')->first();
        if($dk!=null){
            $now = Carbon::now();
            $dt = Carbon::parse($dk->start);
            if($dt->diffInSeconds($now)<360){
                if($dt->diffInSeconds($now)<180){
                    return response()->json(['message'=>'fail2']);
                }
                return response()->json(['message'=>'fail3']);
            }
            DB::table('maxacnhan')->where('id_user','=',$user->user_id)->delete();
        }
        $maxacnhan = new MaXacNhan();
        $maxacnhan->id_user = $user->user_id;
        $maxacnhan->code = $_SESSION['code'];
        $tn = Carbon::now();
        $maxacnhan->start = Carbon::now();
        $maxacnhan->end = $tn->addSeconds(120);
        $maxacnhan->save();
        Mail::send('mailresetpass', $data, function($message){
            $message->from('ntuan9870@gmail.com', 'T2Shop');
            $message->to($_SESSION['email'], $_SESSION['email']);
            $message->subject('Đặt lại mật khẩu!');
        });
        return response()->json(['message'=>'success','code'=>$_SESSION['code']]);
    }

    public function getcode(Request $request){
        $user = DB::table('user')->where('user_email','=',$request->email)->first();
        $code = DB::table('maxacnhan')->where('id_user','=',$user->user_id)->first();
        if($code){
            $now = Carbon::now();
            $dt = Carbon::parse($code->start);
            if($dt->diffInSeconds($now)>180){
                return response()->json(['message'=>'wait']);
            }
            return response()->json(['message'=>'success','time'=>180-$dt->diffInSeconds($now),'code'=>$code->code]);
        }
        return response()->json(['message'=>'error']);
    }

    public function sendnewpass(Request $request){
        $validator = Validator::make($request->all(),
            [
                'user_password'=>'required'
            ],
            [
                'user_password.required'=>'Mật khẩu là trường bắt buộc!'
            ]
        );
        if($validator->fails()){
            return response()->json(['message'=>'error']);
        }
        $us = DB::table('user')->where('user_email',$request->email)->first();
        $user = User::find($us->user_id);
        $user->user_password = encrypt($request->user_password);
        $user->save();
        return response()->json(['message'=>'success']);
    }

    public function sendwrong(Request $request){
        return response()->json(['message'=>$request->message]);
    }
    public function checkemailSocial(Request $request){
        if (User::where('user_email',$request->email)->exists()) {
            $user = User::where('user_email',$request->email)->get()->first();
            return response()->json(['user'=>$user,'result'=>'success']);
        }
        else {
            $u = new User();
            $u->user_name = $request->name;
            $u->user_email = $request->email;
            $u->user_password = encrypt(123456789);
            // $u->user_phone = $request->user_phone;
            $u->user_level = 3;
            $u->save();
            $user = User::where('user_email',$request->email)->get()->first();
            return response()->json(['user'=>$user,'result'=>'success']);
        }
    }

}
