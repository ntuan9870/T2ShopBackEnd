<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\product;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Promotion;
use App\Models\Warehouse;
use App\Models\ProductWH;
use App\Models\FavoriteProduct;
use App\Models\User;
use App\Models\StoreWHInventory;
use App\Models\HangTon;
use App\Models\HistoryPrice;
use App\Models\StoreWarehouse;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class ProductController extends Controller
{
    // public function add(Request $request){
    //     $validator = Validator::make($request->all(),[
    //         'name' => 'required',
    //         'price' => 'required',
    //         'img' => 'required|image',
    //         // 'warranty' => 'required',
    //         // 'accessories' => 'required',
    //         'condition' => 'required',
    //         'description' => 'required',
    //         'featured' => 'required',
    //         'amount'=>'required|gte:0',
    //         'cate' => 'required'
    //     ],[
    //         'name.required' => 'Tên điện thoại là trường bắt buộc!',
    //         'price.required' => 'Giá điện thoại là trường bắt buộc!',
    //         'img.required' => 'Hình ảnh điện thoại là trường bắt buộc!',
    //         'img.image'=>'Vui lòng nhập đúng định dạng ảnh!',
    //         // 'warranty.required' => 'Bảo hành là trường bắt buộc!',
    //         'amount.gte' => 'Số lượng phải lớn hơn 0!',
    //         'amount.required' => 'Số lượng là trường bắt buộc!',
    //         // 'accessories.required' => 'Phụ kiện là trường bắt buộc!',
    //         'condition.required' => 'Trạng thái là trường bắt buộc!',
    //         'description.required' => 'Mô tả là trường bắt buộc!',
    //         'featured.required' => 'Sản phẩm nổi bật là trường bắt buộc!',
    //         'cate.required' => 'Thể loại là trường bắt buộc!'
    //     ]);
    //     if($validator->fails()){
    //         return response()->json(['error'=>$validator->errors()->all()],409);
    //     }
    //     $filename= $request->img->getClientOriginalName();
    //     $p = new product();
    //     $p->product_name = $request->name;
    //     $p->product_price = $request->price;
    //     if($request->warranty!=null){
    //         $p->product_warranty = $request->warranty;
    //     }else{
    //         $p->product_warranty = 'Không';
    //     }
    //     if($request->accessories!=null){
    //         $p->product_accessories = $request->accessories;
    //     }else{
    //         $p->product_accessories = 'Không';
    //     }
    //     $p->product_condition = $request->condition;
    //     if($request->promotion!=null){
    //         $p->product_promotion = $request->promotion;
    //     }else{
    //         $p->product_promotion = 0;
    //     }
    //     $p->product_description = $request->description;
    //     $p->product_featured = $request->featured;
    //     $p->product_amount = $request->amount;
    //     $p->product_cate = $request->cate;
    //     $p->product_img = "http://localhost:8000/storage/prodimages/".$filename;
    //     $request->img->storeAs('prodimages',$filename);
    //     $p->save();
    //     return response()->json(['message'=>"Thêm sản phẩm thành công!"]);
    // }
    public function add(Request $request){
        $validator = Validator::make($request->all(),[
            'product_id' =>['unique:products,product_id'],
            // 'name' => 'required',
            // 'price' => 'required',
            'img' => 'required|image',
            // 'warranty' => 'required',
            // 'accessories' => 'required',
            'condition' => 'required',
            'description' => 'required',
            'featured' => 'required',
            // 'amount'=>'required|gte:0',
            'cate' => 'required'
        ],[
            'product_id.unique' => 'Mã sản phẩm đã tồn tại !',
            // 'name.required' => 'Tên điện thoại là trường bắt buộc!',
            // 'price.required' => 'Giá điện thoại là trường bắt buộc!',
            'img.required' => 'Hình ảnh điện thoại là trường bắt buộc!',
            'img.image'=>'Vui lòng nhập đúng định dạng ảnh!',
            // 'warranty.required' => 'Bảo hành là trường bắt buộc!',
            'amount.gte' => 'Số lượng phải lớn hơn 0!',
            // 'amount.required' => 'Số lượng là trường bắt buộc!',
            // 'accessories.required' => 'Phụ kiện là trường bắt buộc!',
            'condition.required' => 'Trạng thái là trường bắt buộc!',
            'description.required' => 'Mô tả là trường bắt buộc!',
            'featured.required' => 'Sản phẩm nổi bật là trường bắt buộc!',
            'cate.required' => 'Thể loại là trường bắt buộc!'
        ]);
        if($validator->fails()){
            return response()->json(['error'=>$validator->errors()->all()],409);
        }
        $filename= $request->img->getClientOriginalName();
        // $product=ProductWH::where('prod_id',$request->product_id)->first();
        $p = new product();
        // $p->product_id = $request->product_id;
        $p->product_name = $request->product_name;
        $p->product_price = $request->product_price;
        if($request->warranty!=null){
            $p->product_warranty = $request->warranty;
        }else{
            $p->product_warranty = 'Không';
        }
        if($request->accessories!=null){
            $p->product_accessories = $request->accessories;
        }else{
            $p->product_accessories = 'Không';
        }
        $p->product_condition = $request->condition;
        if($request->promotion!='null'){
            $p->product_promotion = $request->promotion;
        }else{
            $p->product_promotion = 0;
        }
        $p->product_description = $request->description;
        $p->product_featured = $request->featured;
        // $p->product_amount = $request->amount;
        $p->product_cate = $request->cate;
        $p->product_img = "http://localhost:8000/storage/prodimages/".$filename;
        $request->img->storeAs('/prodimages',$filename);
        $p->save();
        $h = new HistoryPrice;
        $h->product_id = $p->product_id;
        $h->product_price = $p->product_price;
        $h->save();
        return response()->json(['message'=>"Thêm sản phẩm thành công!"]);
    }
    public function ckeckid(Request $request){
        if(product::where('product_id',$request->id)->exists()){
            return response()->json(['message'=>"Sản phẩm đã tồn tại trong cửa hàng!"]);
        }
    }
    public function update(Request $request){
        $validator = Validator::make($request->all(),[
            'product_name' => 'required',
            'product_price' => 'required',
            'product_condition' => 'required',
            'product_description' => 'required',
            'product_featured' => 'required',
            // 'product_amount' => 'required',
            'product_cate' => 'required',
        ]);
        if($validator->fails()){
            return response()->json(['error'=>$validator->errors()->all()],409);
        }
        $p = product::find($request->product_id);
        $p->product_name = $request->product_name;
        if($p->product_price>$request->product_price){
            $fs = FavoriteProduct::where('product_id', $p->product_id)->get();
            foreach($fs as $f){
                $f->notified = 0;
                $f->save();
            }
        }
        $p->product_price = $request->product_price;
        if($request->product_warranty!=null){
            $p->product_warranty = $request->product_warranty;
        }else{
            $p->product_warranty = 'Không';
        }
        if($request->product_accessories!=null){
            $p->product_accessories = $request->product_accessories;
        }else{
            $p->product_accessories = 'Không';
        }
        $p->product_condition = $request->product_condition;
        $p->product_description = $request->product_description;
        $p->product_featured = $request->product_featured;
        // $p->product_amount = $request->product_amount;
        $p->product_cate = $request->product_cate;
        if($request->product_promotion!=null){
            if($request->product_promotion!=0&&$request->product_promotion!=$p->product_promotion){
                $fs = FavoriteProduct::where('product_id', $p->product_id)->get();
                foreach($fs as $f){
                    $f->notify_promotion = 0;
                    $f->save();
                }
            }
            $p->product_promotion = $request->product_promotion;
        }else{
            $p->product_promotion = 0;
        }
        $p->save();
        if($request->product_img!=null){
            $filename= $request->product_img->getClientOriginalName();
            $p->product_img = "http://localhost:8000/storage/prodimages/".$filename;
            $request->product_img->storeAs('prodimages',$filename);
            $p->save();
        }
        $h = HistoryPrice::where('product_id',$p->product_id)->orderBy('updated_at', 'desc')->first();
        if($h){
            if($p->product_price!=$h->product_price){
                $h = new HistoryPrice;
                $h->product_id = $p->product_id;
                $h->product_price = $p->product_price;
                $h->price_history = $request->oldPrice; 
                $dt = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
                $h->time = $dt;
                $h->save();  
            }
        }
        // $favoriteProduct = FavoriteProduct::where('product_id',$request->product_id)->get();
        // if($favoriteProduct){
        //     foreach($favoriteProduct as $fd){
        //         $user=User::where('user_id',$fd->user_id)->first();
        //         $_SESSION['email'] = $user->user_email;
        //         $data = [
        //             'user_name'=>$user->user_name,
        //             'user_email'=>$user->user_email,
        //             'user_phone'=>$user->user_phone
        //         ];
        //         Mail::send('favoriteproduct', $data, function($message){
        //             $message->from('ntuan9870@gmail.com', 'T2Shop');
        //             $message->to($_SESSION['email']);
        //             $message->subject('Thông báo thông tin về sản phẩm yêu thích');
        //         });
        //     }
        // }
        return response()->json(['success'=>'Cập nhật sản phẩm thành công!']);
    }
    public function delete(Request $request){
        $validator = Validator::make($request->all(),[
            'product_id' => 'required'
        ]);
        if($validator->fails()){
            return response()->json(['error'=>$validator->errors()->all()],409);
        }
        $p = product::find($request->product_id)->delete();
        //upload ảnh
        // $url="http://localhost:8000/storage/";
        // $file = $request->file('img ');
        // $extension = $file->getClientOriginalExtension();
        // $path = $request->file('img')->storeAs('proimages/',$p->id.'.'.$extension);
        // $p->img=$url.$path;
        // $p->save();
        return response()->json(['message'=>'success']);
    }
    public function show(Request $request){
        session(['keys'=>$request->key]);
        session(['id'=>$request->id]);
        if(session('id')!=''){
            if($request->sl_featured!=null){
                session(['sl_featured'=>$request->sl_featured]);
                session(['sl_filter'=>$request->sl_filter]);
                if(session('sl_featured')=='0'){
                    $f = '1';
                }else{
                    $f = '0';
                }
                if(session('sl_filter')=='0'){
                $products = $this->giaGiamDan($f);
                }else{
                    if(session('sl_filter')=='1'){
                        $products = $this->giaTangDan($f);
                    }else{
                        if(session('sl_filter')=='2'){
                            $products = $this->moiNhat($f);
                        }else{
                            $products = $this->cuNhat($f);
                        }
                    }
                }
            }else{
                $products = DB::table('categories')->join('products','products.product_cate','=','categories.category_id')->where(function ($q){
                    $q -> where('products.product_id','LIKE','%'.session('keys').'%')
                        ->orwhere('products.product_name','LIKE','%'.session('keys').'%')
                        // ->orwhere('products.product_price','LIKE','%'.session('keys').'%')
                        ->orwhere('products.product_cate','LIKE','%'.session('keys').'%');
                })->where('products.product_cate','=',session('id'))->select('*')->get();
                // $products=DB:table('promotion')->join('products',$products1->promotion,'=','promotion.promotion_id')->get();
            }
        }else{
            $products=DB::table('products')->join('categories','products.product_cate','=','categories.category_id')->where(function ($q){
                $q -> where('products.product_id','LIKE','%'.session('keys').'%')
                    ->orwhere('products.product_name','LIKE','%'.session('keys').'%')
                    // ->orwhere('products.product_price','LIKE','%'.session('keys').'%')
                    ->orwhere('products.product_cate','LIKE','%'.session('keys').'%');
            })->select('*')->get();
        }
        $promotions = array();
        $ratings = array();
        foreach($products as $p){
            $promotion = Promotion::find($p->product_promotion);
            array_push($promotions,$promotion);
            $tb = DB::table('rating')->where('product_id',$request->product_id)->avg('rating_star');
            if($tb=='') $tb = '0';
            array_push($ratings, $tb);
        }
        
        return response()->json(['products'=>$products,'promotions'=>$promotions,'ratings'=>$ratings]);
        // $promotions = array();
        // foreach($products as $p){
        //     $promotion = Promotion::find($p->product_promotion);
        //     array_push($promotions,$promotion);
        // }
        // return response()->json(['products'=>$products, 'promotions'=>$promotions]);
    }
    public function getEditProduct(Request $request){
        $product = product::where('product_id',$request->id)->join('categories','products.product_cate','=','categories.category_id')->first();
        // $promotions = array();
        // foreach($p as $p1){promotion
            $promotion = Promotion::find($product->product_promotion); 
            // array_push($promotion,$p);
        // }
        $a = StoreWHInventory::where('product_id',$request->id)->sum('amount');
        $b = HangTon::where('product_id', $request->id)->sum('amount');
        $s = $a+$b;    
        return response()->json(['product'=>$product,'promotion'=>$promotion, 'amountmax'=>$s]);
    }
    public function getInforProduct(Request $request){
        $product = product::where('product_id',$request->id)->join('categories','products.product_cate','=','categories.category_id')->first();
        // $promotions = array();
        // foreach($p as $p1){promotion
            $promotion = Promotion::find($product->product_promotion); 
            // array_push($promotion,$p);
        // }
        $a = StoreWHInventory::where('product_id',$request->id)->sum('amount');
        $b = HangTon::where('product_id', $request->id)->sum('amount');
        $s = $a+$b;    
        $store_wh = StoreWarehouse::where('store_id', $request->store_id)->get();
        $tmp = 0;
        foreach($store_wh as $st_wh){
            $store_wh_inventory = StoreWHInventory::where('product_id',$request->id)->where('store_wh_id',$st_wh->store_wh_id)->first();
            if($store_wh_inventory){
                $tmp += $store_wh_inventory->amount;
            }
        }
        return response()->json(['product'=>$product,'promotion'=>$promotion, 'amountmax'=>$tmp]);
    }
    public function getEditProduct1(Request $request){
        $p = product::find($request->id);
        return response()->json($p);
    }

    public function getNewProduct(Request $request){
        if($request->sl!='0'){
            $products = DB::table('products')->latest('updated_at')->limit($request->sl)->get();
        }else{
            $products = DB::table('products')->latest('updated_at')->get();
        }
        $promotions = array();
        $ratings = array();
        foreach($products as $p){
            $promotion = Promotion::find($p->product_promotion);
            array_push($promotions,$promotion);
            $tb = DB::table('rating')->where('product_id',$p->product_id)->avg('rating_star');
            if($tb=='') $tb = '0';
            array_push($ratings, (string)$tb);
        }
        
        return response()->json(['products'=>$products,'promotions'=>$promotions,'ratings'=>$ratings]);
    }
    public function getFeaturedProduct(Request $request){
        if($request->sl!='0'){
            $products = DB::table('products')->latest('updated_at')->limit($request->sl)->where('product_featured','=','1')->get();
        }else{
            $products = DB::table('products')->latest('updated_at')->get();
        }
        $promotions = array();
        $ratings = array();
        foreach($products as $p){
            $promotion = Promotion::find($p->product_promotion);
            array_push($promotions,$promotion);
            $tb = DB::table('rating')->where('product_id',$request->product_id)->avg('rating_star');
            if($tb=='') $tb = '0';
            array_push($ratings, (string)$tb);
        }
        return response()->json(['products'=>$products,'promotions'=>$promotions,'ratings'=>$ratings]);
    }

    public function addComment(Request $request){
        $comment = new Comment();
        $comment->user_id = $request->user_id;
        $comment->product_id = $request->product_id;
        $comment->comment_content = $request->comment_content;
        $comment->save();
        return response()->json(['message'=>'success']);
    }
    public function getComment(Request $request){
        $comments = DB::table('comments')->join('user','comments.user_id','=','user.user_id')->where('product_id',$request->product_id)->get('*');
        return response()->json(['comments'=>$comments]);
    }
    public function removeComment(Request $request){
        Comment::find($request->comment_id)->delete();
        return response()->json(['message'=>'success']);
    }
    public function danhgia(Request $request){
        $r = DB::table('rating')->where('user_id',$request->user_id)->where('product_id',$request->product_id)->first();
        if($r){
            DB::table('rating')->where('user_id',$request->user_id)->where('product_id',$request->product_id)->update(['rating_star'=>$request->rating]);
        }else{
            $rating = new Rating();
            $rating->user_id = $request->user_id;
            $rating->product_id = $request->product_id;
            $rating->rating_star = $request->rating;
            $rating->save();
        }
        return response()->json(['message'=>'success']);
    }
    public function getratingelement(Request $request){
        $r = DB::table('rating')->where('user_id',$request->user_id)->where('product_id',$request->product_id)->first();
        if($r){
            return response()->json(['message'=>$r->rating_star]);
        }
        return response()->json(['message'=>'0']);
    }
    public function getratingproduct(Request $request){
        $tb = DB::table('rating')->where('product_id',$request->product_id)->avg('rating_star');
        if($tb){
            return response()->json(['message'=>$tb]);
        }
        return response()->json(['message'=>'0']);
    }
    public function getratingall(Request $request){
        $count = DB::table('rating')->where('product_id',$request->product_id)->count();
        $countstar1 = DB::table('rating')->where('product_id',$request->product_id)->where('rating_star',1)->count();
        $countstar2 = DB::table('rating')->where('product_id',$request->product_id)->where('rating_star',2)->count();
        $countstar3 = DB::table('rating')->where('product_id',$request->product_id)->where('rating_star',3)->count();
        $countstar4 = DB::table('rating')->where('product_id',$request->product_id)->where('rating_star',4)->count();
        $countstar5 = DB::table('rating')->where('product_id',$request->product_id)->where('rating_star',5)->count();
        $arrcount = array();
        array_push($arrcount,$count);
        array_push($arrcount,$countstar1);
        array_push($arrcount,$countstar2);
        array_push($arrcount,$countstar3);
        array_push($arrcount,$countstar4);
        array_push($arrcount,$countstar5);
        return response()->json(['arrcount'=>$arrcount]);
    }
    public function giaGiamDan($f){
        return DB::table('categories')->join('products','products.product_cate','=','categories.category_id')->where(function ($q){
            $q -> where('products.product_id','LIKE','%'.session('keys').'%')
                ->orwhere('products.product_name','LIKE','%'.session('keys').'%')
                // ->orwhere('products.product_price','LIKE','%'.session('keys').'%')
                ->orwhere('products.product_cate','LIKE','%'.session('keys').'%');
        })->where('products.product_cate','=',session('id'))->where('products.product_featured',$f)->orderBy('products.product_price', 'desc')->select('*')->get();
    }
    public function giaTangDan($f){
        return DB::table('categories')->join('products','products.product_cate','=','categories.category_id')->where(function ($q){
            $q -> where('products.product_id','LIKE','%'.session('keys').'%')
                ->orwhere('products.product_name','LIKE','%'.session('keys').'%')
                // ->orwhere('products.product_price','LIKE','%'.session('keys').'%')
                ->orwhere('products.product_cate','LIKE','%'.session('keys').'%');
        })->where('products.product_cate','=',session('id'))->where('products.product_featured',$f)->orderBy('products.product_price', 'asc')->select('*')->get();
    }
    public function moiNhat($f){
        return DB::table('categories')->join('products','products.product_cate','=','categories.category_id')->where(function ($q){
            $q -> where('products.product_id','LIKE','%'.session('keys').'%')
                ->orwhere('products.product_name','LIKE','%'.session('keys').'%')
                // ->orwhere('products.product_price','LIKE','%'.session('keys').'%')
                ->orwhere('products.product_cate','LIKE','%'.session('keys').'%');
        })->where('products.product_cate','=',session('id'))->where('products.product_featured',$f)->latest('products.updated_at')->select('*')->get();
    }
    public function cuNhat($f){
        return DB::table('categories')->join('products','products.product_cate','=','categories.category_id')->where(function ($q){
            $q -> where('products.product_id','LIKE','%'.session('keys').'%')
                ->orwhere('products.product_name','LIKE','%'.session('keys').'%')
                // ->orwhere('products.product_price','LIKE','%'.session('keys').'%')
                ->orwhere('products.product_cate','LIKE','%'.session('keys').'%');
        })->where('products.product_cate','=',session('id'))->where('products.product_featured',$f)->oldest('products.updated_at')->select('*')->get();
    }
    public function getPromotion(){
        $promotion=Promotion::where('promotion_status',1)->select('promotion_id','promotion_name','promotion_infor')->get();
        return response()->json(['message'=>'success','promotion'=>$promotion]);
    }
    public function getidProduct(Request $request){
        $productWH=ProductWH::where('cate_id',$request->id)->get();
        return response()->json(['message'=>'success','productWH'=>$productWH]);
    }
    public function checkSameName(Request $request){
        $product=Product::where('product_name',$request->product_name)->first();
        if($product){
            return response()->json(['message'=>'same']);
        }
        return response()->json(['message'=>'notsame']);
    }
    public function pushFavoriteProduct(Request $request){
        $favoriteProduct=new FavoriteProduct();
        $favoriteProduct->user_id=$request->user_id;
        $favoriteProduct->product_id=$request->product_id;
        $favoriteProduct->FP_status=1;
        $favoriteProduct->save();
        return response()->json(['message'=>'success']);
    }
    public function showFavoriteProduct(Request $request){
        $favoriteProduct=FavoriteProduct::where('user_id','=',$request->user_id)->join('products','products.product_id','=','favoriteproduct.product_id')->get();
        return response()->json(['favoriteProduct'=>$favoriteProduct]);
    }
    public function removeFavoriteProduct(Request $request){
        FavoriteProduct::find($request->FP_id)->delete();
        return response()->json(['message'=>'success']);
    }
    public function getFavoriteProduct(Request $request){
        $favoriteProduct=FavoriteProduct::where('user_id','=',$request->user_id)->join('products','products.product_id','=','favoriteproduct.product_id')->get();
        $promotions=array();
        $ratings = array();
        foreach($favoriteProduct as $f){
            $promotion = Promotion::find($f->product_promotion);
            array_push($promotions,$promotion);
            $tb = DB::table('rating')->where('product_id',$request->product_id)->avg('rating_star');
            if($tb=='') $tb = '0';
            array_push($ratings, (string)$tb);
        }
        return response()->json(['products'=>$favoriteProduct,'promotions'=>$promotions,'ratings'=>$ratings]);
    }
    public function getFavorite(Request $request){
        $favoriteProduct=FavoriteProduct::where('user_id','=',$request->user_id)->where('product_id',$request->product_id)->get();
        if($favoriteProduct){
            return response()->json(['favoriteProduct'=>$favoriteProduct]);
        }
    }
    public function checkAcceptComment(Request $request){
        $order=DB::table('orders')->join('order_items','orders.order_id','=','order_items.order_id')->where('user_id',$request->user_id)->where('product_id',$request->product_id)->get();
        if($order){
            return response()->json(['order'=>$order]);
        }
    }
    public function getHistoryPrice(Request $request){
        $hps = HistoryPrice::where('product_id', $request->product_id)->get();
        return response()->json(['hps'=>$hps]);
    }
    public function getHistoryPriceNew(Request $request){
        // $products = DB::table('history_price')->join('products','history_price.product_id','=','products.product_id')->limit(1)->orderBy('hp_id','desc')->get();
        $products = DB::table('history_price')->join('products','history_price.product_id','=','products.product_id')->get();
        // $products = HistoryPrice::all();
        return response()->json(['products'=>$products]);
    }

    public function getAllProduct(){
        $products = product::all();
        return response()->json(['products'=>$products]);
    }
    public function getAllProduceReducePrice(Request $request){
        $products = product::join('favoriteproduct', 'products.product_id', '=', 'favoriteproduct.product_id')->where('favoriteproduct.user_id',$request->user_id)->where('favoriteproduct.notified','0')->get();
        foreach($products as $p){
            $f = FavoriteProduct::where('product_id', $p->product_id)->where('user_id', $request->user_id)->first();
            if($f){
                $f->notified = 1;
                $f->save();
            }
        }
        return response()->json(['products'=>$products]);
    }
    public function getAllProductChangePromotion(Request $request){
        $products = product::join('favoriteproduct', 'products.product_id', '=', 'favoriteproduct.product_id')->where('favoriteproduct.user_id',$request->user_id)->where('favoriteproduct.notify_promotion','0')->get();
        foreach($products as $p){
            $f = FavoriteProduct::where('product_id', $p->product_id)->where('user_id', $request->user_id)->first();
            if($f){
                $f->notify_promotion = 1;
                $f->save();
            }
        }
        return response()->json(['products'=>$products]);
    }

}


