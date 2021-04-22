<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\product;
use App\Models\User as ModelsUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Carbon;
use App\Models\UserVoucher;
use App\Models\Voucher;
use App\Models\Ship;
use App\Models\Shipper;

class OrderController extends Controller
{
    public function add(Request $request){
        $validate = Validator::make($request->all(),
        [
            'user_id'=>'required',
            'user_name_receive'=>'required',
            'user_email'=>'required|email',
            'user_phone'=>'required',
            'user_address'=>'required',
            'total'=>'required'
        ],
        [
            'user_id.required'=>'Id là bắt buộc',
            'user_name_receive.required'=>'Tên người nhận là trường bắt buộc!',
            'user_email.required'=>'Email là trường bắt buộc!',
            'user_email.email'=>'Vui lòng nhập email đúng định dạng',
            'user_address.required'=>'Địa chỉ là trường bắt buộc!',
            'total.required'=>'Tổng tiền là bắt buộc'
        ]);
        if($validate->failed()){
            return response()->json('error','Lỗi');
        }
        $data = json_decode($request->cart, true);
        $order = new Order();
        $order->user_id = $request->user_id;
        $order->user_name = $request->user_name_receive;
        $u = User::find($request->user_id);
        // $u->user_phone = $request->user_phone;
        // $u->save();
        $order->phone = $request->user_phone;
        if($request->user_message){
            $order->message = $request->user_message;
        }
        $order->address = $request->user_address;
        $order->total = $request->total;
        $order->form = $request->form;
        $order->ship = 0;
        if($request->select_voucher!='null'){
            $order->voucher_id = $request->select_voucher;
            $voucher = Voucher::find($request->select_voucher);
            $uv = new UserVoucher();
            $uv = UserVoucher::where('user_id',$request->user_id)->where('voucher_id',$request->select_voucher)->first();
            $uv->amount_voucher-= 1;
            $uv->voucher_used+= 1;
            if($uv->amount_voucher==0){
                $uv->delete();
            }
            $uv->save();
        }
        $order->save();
        foreach($data as $prod){
            $orderitem = new OrderItem();
            $orderitem->product_id = $prod['product']['product_id'];
            $orderitem->product_price = $prod['product']['product_price'];
            $orderitem->product_amount = $prod['num'];
            $orderitem->product_promotion = $prod['promotion'];
            $orderitem->order_id = $order->order_id;
            $orderitem->save();
        }

        $user = User::find($request->user_id);
        $_SESSION['email'] = $user->user_email;
        $data2 = [
            'data' => $data,
            'user_name'=>$u->user_name,
            'user_email'=>$u->user_email,
            'user_phone'=>$u->user_phone,
            'user_address'=>$request->user_address,
            'order_id'=>$order->order_id,
            'total'=>$order->total
        ];
        Mail::send('mailorder', $data2, function($message){
            $message->from('ntuan9870@gmail.com', 'T2Shop');
            $message->to($_SESSION['email']);
            $message->subject('Cảm ơn quí khách đã đặt hàng!');
        });
        $user->voucher_accumulation+=5;
        $user->voucher_user_score+=5;
        $user->save();
        
        $dt = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
        $voucher=Voucher::where('voucher_id',4)->where('voucher_start', '<=', $dt)->where('voucher_end', '>=', $dt)->where('voucher_apply','true')->first();
        if( $voucher){
            $sum=0;
            $user_voucher=UserVoucher::where('voucher_id',4)->get();
            foreach($user_voucher as $uv){
                $sum+=$uv->amount_voucher;
            }
            if($voucher->voucher_total-$sum>0){
                $amountUser=UserVoucher::where('voucher_id',4)->where('user_id',$request->user_id)->first();
                if(isset($amountUser)){
                    $amountUser->amount_voucher+=1;
                    $amountUser->save();
                }else{
                    $newUV= new UserVoucher();
                    $newUV->voucher_id=4;
                    $newUV->user_id=$request->user_id;
                    $newUV->amount_voucher=1;
                    $newUV->save();
                }
            }
        }
        return response()->json(['success'=>'Xác nhận thanh toán thành công!']);
    }
   

    public function getmomo(){
        $momoUrl = 'https://test-payment.momo.vn/gw_payment/payment/qr?';
        $partnerCode='MOMOYIMX20201024';//cái này tạo tài khoản là có
        $accessKey='Ggmn1C0s9XwBHMgL';//cái này tạo tài khoản là có
        $requestId='MM79875';//tạo tùy ý mà nên khác nhau
        $amount=1100;//này là giá
        $orderId='MM79875';//này tạo tùy ý nên khác nhau
        $requestType='captureMoMoWallet';//này viết là vậy luôn :v
        $returnUrl='http://localhost:4200';
        $notifyUrl='http://localhost:4200';
        $extraData='Thong tin them';
        $orderInfo='Thong tin them';
        $signature=$this->getkey('KsZMvfGNOiYlXROFzZcsaMBRAI7v7hos','partnerCode='.$partnerCode.'&accessKey='.$accessKey.'&requestId='.$requestId.'&amount='.$amount.'&orderId='.$orderId.'&orderInfo='.$orderInfo
        .'&returnUrl='.$returnUrl.'&notifyUrl='.$notifyUrl.'&extraData='.$extraData);//này taoh bằng thuật toán
        $url = $momoUrl.'partnerCode='.$partnerCode.'&accessKey='.$accessKey.'&requestId='.$requestId.'&amount='.$amount.'&orderId='.$orderId.'&signature='.$signature.'&requestType='.$requestType;
        return response()->json(['success'=>$url]);
     }

    public function show(Request $request){
        $orders = DB::table('orders')->where('user_id',$request->user_id)->orderBy('order_id','desc')->get('*');
        if($request->user_id==''){
            $orders = DB::table('orders')->orderBy('order_id','desc')->get('*');
        }
        return response()->json(['orders'=>$orders]);
    }
    public function detail(Request $request){
        $orderitems = DB::table('products')->join('order_items','order_items.product_id','=','products.product_id')->where('order_id',$request->order_id)->get('*');
        return response()->json(['orderitems'=>$orderitems]);
    }
    public function remove(Request $request){
        $order = Order::find($request->order_id);
        // $order->delete();
        $order->status = 2;
        $order->save();
        return response()->json(['message'=>'success']);
    }
    public function completeready(Request $request){
        $order = Order::find($request->order_id);
        $order->ready = 1;
        $order->save();
        return response()->json(['message'=>'success']);
    }
    public function completestatus(Request $request){
        $order = Order::find($request->order_id);
        $order->status = 1;
        $order->save();
        return response()->json(['message'=>'success']);
    }
    public function orderbyid(Request $request){
        $order = Order::find($request->order_id);
        return response()->json($order);
    }
    public function getkey($key, $data){
        $sig = hash_hmac('sha256', $data, $key);
        return $sig;
    }

    public function getvnpay(Request $request){
        $vnp_Url = "http://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://localhost:4200/cart/complete";
        $vnp_TmnCode = "M8DBK8I0";//Mã website tại VNPAY
        $vnp_HashSecret = "YUFRDGQABQULFNZCGICWZGNOQXUEKUDU"; //Chuỗi bí mật
        $vnp_TxnRef = date('YmdHis');//Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        if($request->user_message){
            $vnp_OrderInfo = $request->user_message;
        }else{
            $vnp_OrderInfo = 'No message';
        }
        $vnp_OrderType = 'send';
        $vnp_Amount = $request->total * 100;
        $vnp_Locale = 'VN';
        $vnp_IpAddr = $request->user_address;
        $inputData = array(
            "vnp_Version" => "2.0.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        );
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . $key . "=" . $value;
            } else {
                $hashdata .= $key . "=" . $value;
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash = hash('sha256',$vnp_HashSecret . $hashdata);
            $vnp_Url .= 'vnp_SecureHashType=SHA256&vnp_SecureHash=' . $vnpSecureHash;
        }
        $this->add($request);
        return response()->json(['message'=>'success','checkouturl'=>$vnp_Url]);
    }

    public function currentDate(){
        $date=getdate();
        $orders=Order::whereDay('created_at',$date['mday'])->whereMonth('created_at',$date['mon'])->whereYear('created_at',$date['year'])->get();
        $total=Order::whereDay('created_at',$date['mday'])->whereMonth('created_at',$date['mon'])->whereYear('created_at',$date['year'])->sum('total');
        return response()->json(['orders'=>$orders,'sumtotal'=>$total]);
    }
    public function date(Request $request){
        $orders=Order::whereDate('created_at',$request->date)->get();
        $sum_day=Order::whereDate('created_at',$request->date)->sum('total');
        return response()->json(['orders'=>$orders,'sum_day'=>$sum_day]);
    }
    // public function month (Request $request){
    //     $time=explode('-', $request->month);
    // 	$orders=Order::whereMonth('created_at',$time[1])->whereYear('created_at',$time[0])->get();
    // 	$sum_day=Order::whereMonth('created_at',$time[1])->whereYear('created_at',$time[0])->sum('total');
    //     return response()->json(['orders'=>$orders,'sum_day'=>$sum_day]);
    // }
    public function year (Request $request){
        $arrorder = array();
        for($i = 1; $i <= 12; $i++){
            $order=Order::whereYear('created_at',$request->year)->whereMonth('created_at',$i)->sum('total');
            array_push($arrorder,$order);
        }
        $orders=Order::whereYear('created_at',$request->year)->get();
        $sum_day=Order::whereYear('created_at',$request->year)->sum('total');
        return response()->json(['pipe'=>$arrorder,'sum_day'=>$sum_day,'orders'=>$orders]);
    }
    public function month(Request $request){
        $dt = Carbon::now('Asia/Ho_Chi_Minh');
        $time=explode('-', $request->month);
        $sumday = 0;
        switch($time[1]){
            case 1: case 3: case 5: case 7: case 8: case 10: case 12:
                $sumday = 31;
            break;
            case 02:
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
            $barcher=Order::whereYear('created_at',$time[0])->whereMonth('created_at',$time[1])->whereDay('created_at',$i)->sum('total');
            array_push($arrorder,$barcher);
        }
    	$orders=Order::whereMonth('created_at',$time[1])->whereYear('created_at',$time[0])->get();
    	$sum_day=Order::whereMonth('created_at',$time[1])->whereYear('created_at',$time[0])->sum('total');
        return response()->json(['orders'=>$orders,'sum_day'=>$sum_day,'result'=>$arrorder,'sumday'=>$sumday]);
    }
    public function ordershipbyid(Request $request){
        $ship=Ship::where('order_id',$request->order_id)->first();
        $shipper=Shipper::find($ship->shipper_phone);
        return response()->json(['shipper'=>$shipper,'ship'=>$ship]);
    }
}
