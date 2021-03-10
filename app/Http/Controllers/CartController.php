<?php

namespace App\Http\Controllers;

use App\Models\product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add(Request $request){
        $product=product::find($request->product_id);
        Cart::add(['id' => $product->product_id, 'name' => $product->product_name, 'qty' => 1, 'price' => $product->product_price, 'weight' => 550, 'options' => ['img' => $product->product_img]]);
        return response()->json(['success'=>'Thêm sản phẩm vào giỏ hàng thành công!']);
    }
    public function show(){
        $cart = Cart::content();
        return response()->json(['cart'=>$cart]);
    }
   
	
    public function postvnpay(Request $request){
        $vnp_Url = "http://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://localhost:4200/cart/complete";
        $vnp_TmnCode = "M8DBK8I0";//Mã website tại VNPAY
        $vnp_HashSecret = "YUFRDGQABQULFNZCGICWZGNOQXUEKUDU"; //Chuỗi bí mật
        $vnp_TxnRef = date('YmdHis');//Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = $request->user_message;
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
        // $this->add($request);
        return response()->json(['message'=>'success','checkouturl'=>$vnp_Url]);
        
    }
}
