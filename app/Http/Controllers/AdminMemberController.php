<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class AdminMemberController extends Controller
{
    public function show(){
        $user=User::all();
        return response()->json(['users'=>$user]);
    }
    public function getUser(Request $request){
        $user = User::find($request->id);
        return response()->json($user);
    }
    public function postEdit(Request $request){
        $validate = Validator::make($request->all(),
            [
                'user_name'=>'required',
                'user_email'=>'required|email'
            ],
            [
                'user_name.required'=>'Tên hiển thị là trường bắt buộc!',
                'user_email.required'=>'Email là trường bắt buộc!',
                'user_email.email'=>'Vui lòng nhập email đúng định dạng!'
            ]);
        if($validate->fails()){
            return response()->json(['error'=>'Kiểm tra dữ liệu nhập vào!']);
        }else{
            $user = User::find($request->user_id);
            $user->user_name = $request->user_name;
            if($request->user_phone!=null){
                $user->user_phone = $request->user_phone;
            }
            $user->user_email = $request->user_email;
            if($request->user_level!=null){
                $user->user_level = $request->user_level;
            }
            $user->save();
            return response()->json(['success'=>'Sửa đổi thông tin thành công!']);
        }
    }
    public function removeUser(Request $request){
        $user = User::find($request->user_id);
        $user->delete();
        return response()->json(['message'=>'success']);
    }
}
