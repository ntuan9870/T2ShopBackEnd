<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(["namespace"=>"App\Http\Controllers"],function() {
    Route::any('add','ProductController@add');
    Route::any('update','ProductController@update');
    Route::any('delete','ProductController@delete');
    Route::any('show','ProductController@show');
    Route::any('getEditProduct','ProductController@getEditProduct');
    Route::any('getEditProduct1','ProductController@getEditProduct1');
    Route::any('getNewProduct','ProductController@getNewProduct');
    Route::any('getFeaturedProduct','ProductController@getFeaturedProduct');
    Route::any('getComment','ProductController@getComment'); 
    Route::any('addComment','ProductController@addComment');
    Route::any('removeComment','ProductController@removeComment');
    Route::any('danhgia','ProductController@danhgia');
    Route::any('getratingelement','ProductController@getratingelement');
    Route::any('getratingproduct','ProductController@getratingproduct');
    Route::any('getratingall','ProductController@getratingall');
    Route::any('getPromotionProduct','ProductController@getPromotion');
    Route::any('getidProduct','ProductController@getidProduct');
    Route::any('ckeckid','ProductController@ckeckid');
    Route::any('checkSameName','ProductController@checkSameName');
    Route::any('pushFavoriteProduct','ProductController@pushFavoriteProduct');
    Route::any('showFavoriteProduct','ProductController@showFavoriteProduct');
    Route::any('removeFavoriteProduct','ProductController@removeFavoriteProduct');
    Route::any('getFavoriteProduct','ProductController@getFavoriteProduct');
    Route::any('getFavorite','ProductController@getFavorite');
    

    Route::any('category/add','CategoryController@add');
    Route::any('category/checkname','CategoryController@checkname');
    Route::any('category/show','CategoryController@show');
    Route::any('category/remove','CategoryController@remove');
    Route::any('category/getEdit','CategoryController@getedit');
    Route::any('category/postEdit','CategoryController@postedit');

    Route::any('auth/register','UserController@register');
    Route::any('auth/login','UserController@login');
    Route::any('auth/checksameusername','UserController@checksameusername');
    Route::any('auth/checksameemail','UserController@checksameemail');
    Route::any('auth/sendemail','UserController@sendemail');
    Route::any('auth/getcode','UserController@getcode');
    Route::any('auth/sendnewpass','UserController@sendnewpass');
    Route::any('auth/sendwrong','UserController@sendwrong');
    Route::any('auth/checkemailSocial','UserController@checkemailSocial');
   

    Route::any('users/show','AdminMemberController@show');
    Route::any('users/getUser','AdminMemberController@getUser');
    Route::any('users/postEdit','AdminMemberController@postEdit');
    Route::any('users/removeUser','AdminMemberController@removeUser');

    Route::any('cart/add','CartController@add'); 
    Route::any('cart/show','CartController@show');

    Route::any('vnpay','CartController@postvnpay');

    Route::any('order/add','OrderController@add');
    Route::any('order/show','OrderController@show');
    Route::any('order/show/detail','OrderController@detail');
    Route::any('order/show/remove','OrderController@remove');
    Route::any('order/show/orderbyid','OrderController@orderbyid');
    Route::any('order/completeready','OrderController@completeready');
    Route::any('order/completestatus','OrderController@completestatus');
    Route::any('order/getkey','OrderController@getkey');
    Route::any('order/getvnpay','OrderController@getvnpay');
    Route::any('order/getmomo','OrderController@getmomo');
    Route::any('order/show/ordershipbyid','OrderController@ordershipbyid');

    Route::any('currentDate','OrderController@currentDate');
    Route::any('statistical/date','OrderController@date');
    Route::any('statistical/month','OrderController@month');
    Route::any('statistical/year','OrderController@year');

    Route::any('statistical/getRevenueMonth','StatisticalController@getRevenueMonth');

    Route::any('promotion/add','PromotionController@add');
    Route::any('promotion/show','PromotionController@show');
    Route::any('promotion/status','PromotionController@status');
    Route::any('promotion/remove','PromotionController@remove');
    Route::any('promotion/edit','PromotionController@getedit');
    Route::any('promotion/postedit','PromotionController@postedit');
    Route::any('promotion/getproduct','PromotionController@getproduct');


    Route::any('warehouse/show','WarehouseController@show');
    Route::any('warehouse/add','WarehouseController@add');
    // Route::any('warehouse/checkwh_id','WarehouseController@checkwh_id');
    Route::any('warehouse/getSupplier','WarehouseController@getSupplier');
    Route::any('warehouse/addOrder','WarehouseController@addOrder');
    Route::any('warehouse/addOrder1','WarehouseController@addOrder1');
    Route::any('warehouse/getOrderWareHouse','WarehouseController@getOrderWareHouse');
    Route::any('warehouse/getOrderWH/{id}','WarehouseController@getOrderWHID');
    Route::any('warehouse/order/remove','WarehouseController@removeorder');
    Route::any('warehouse/order/update','WarehouseController@updateorder');
    Route::any('warehouse/getdetailOrder','WarehouseController@getdetailOrder');
    Route::any('warehouse/postStatus','WarehouseController@postStatus');
    Route::any('warehouse/search','WarehouseController@search');
    Route::any('warehouse/getCategory','WarehouseController@getCategory');
    Route::any('warehouse/postProductWH','WarehouseController@postProductWH');
    Route::any('warehouse/getProductWH','WarehouseController@getProductWH');
    Route::any('warehouse/updateProductWH/amount','WarehouseController@updateProductWHamount');
    Route::any('warehouse/updateProductWH/price','WarehouseController@updateProductWHprice');
    Route::any('warehouse/addWareHouse','WarehouseController@addWareHouse');
    Route::any('warehouse/getwarehouse','WarehouseController@getwarehouse');
    Route::any('warehouse/addDeliverybill','WarehouseController@addDeliverybill');
    Route::any('warehouse/getDeliverybill','WarehouseController@getDeliverybill');
    Route::any('warehouse/getDetailDeBill','WarehouseController@getDetailDeBill');
    Route::any('warehouse/minusamount','WarehouseController@minusamount');
    Route::any('warehouse/plusamount','WarehouseController@plusamount');
    Route::any('warehouse/checkcapcity','WarehouseController@checkcapcity');
    Route::any('warehouse/checkname','WarehouseController@checkname');
    Route::any('warehouse/getdetailWH','WarehouseController@getdetailWH');
    Route::any('warehouse/EditWareHouse','WarehouseController@EditWareHouse');
    Route::any('warehouse/Removewh','WarehouseController@Removewh');
    Route::any('warehouse/importProductWH','WarehouseController@importProductWH');
    Route::any('warehouse/getAllBI','WarehouseController@getAllBI');
    Route::any('warehouse/getAllBDIByBIID','WarehouseController@getAllBDIByBIID');
    Route::any('warehouse/search2','WarehouseController@search2');
    Route::any('warehouse/getAllBIEligible','WarehouseController@getAllBIEligible');
    Route::any('warehouse/checkOutOfProduct','WarehouseController@checkOutOfProduct');
    Route::any('warehouse/changeAmountElement','WarehouseController@changeAmountElement');
    Route::any('warehouse/addBE','WarehouseController@addBE');
    Route::any('warehouse/getBallotExport','WarehouseController@getBallotExport');
    Route::any('warehouse/getAllDBEByBEID','WarehouseController@getAllDBEByBEID');
    Route::any('warehouse/getAllCTPXLN','WarehouseController@getAllCTPXLN');
    Route::any('warehouse/getAllP','WarehouseController@getAllP');
    
    Route::any('supplier/add','SupplierController@add');
    Route::any('supplier/show','SupplierController@show');
    Route::any('supplier/edit','SupplierController@getedit');
    Route::any('supplier/postedit','SupplierController@postedit');
    Route::any('supplier/remove','SupplierController@remove');
    Route::any('supplier/getdetail','SupplierController@getdetail');
    Route::any('supplier/getorder','SupplierController@getorder');
    Route::any('supplier/checkphone','SupplierController@checkphone');

    Route::any('voucher/add','VoucherController@add');
    Route::any('voucher/show','VoucherController@show');
    Route::any('voucher/edit','VoucherController@edit');
    Route::any('voucher/getvoucherbyid','VoucherController@getvoucherbyid');
    Route::any('voucher/checksameuser','VoucherController@checksameuser');
    Route::any('voucher/checksamevouchername','VoucherController@checksamevouchername');
    Route::any('voucher/changeapply','VoucherController@changeapply');
    Route::any('voucher/getalluservoucher','VoucherController@getalluservoucher');
    Route::any('voucher/addvoucherformember','VoucherController@addvoucherformember');
    Route::any('voucher/getpotentialcustomers','VoucherController@getpotentialcustomers');
    Route::any('voucher/editvoucherforuser','VoucherController@editvoucherforuser');
    Route::any('voucher/removeUserFromVoucher','VoucherController@removeUserFromVoucher');
    Route::any('voucher/removeVoucher','VoucherController@removeVoucher');
    Route::any('voucher/getallvoucherforuser','VoucherController@getallvoucherforuser');
    Route::any('voucher/getdetailvoucher','VoucherController@getdetailvoucher');
    Route::any('voucher/getSumVoucherUser','VoucherController@getSumVoucherUser');

    Route::any('admin/gethome','AdminController@gethome');

    Route::any('shipper/add','ShipperController@add');
    Route::any('shipper/getallshipper','ShipperController@getallshipper');
    Route::any('shipper/remove','ShipperController@remove');
    Route::any('shipper/getdetailSH','ShipperController@getdetailSH');
    Route::any('shipper/edit','ShipperController@edit');
    Route::any('auth/login/shipper','ShipperController@loginshipper');
    Route::any('shipper/showorders','ShipperController@showorders');
    Route::any('shipper/addShip','ShipperController@addShip');
    Route::any('shipper/showship','ShipperController@showship');
    Route::any('shipper/changePassword','ShipperController@changePassword');
    Route::any('shipper/UpdateOrder','ShipperController@UpdateOrder');
    Route::any('shipper/destroyShip','ShipperController@destroyShip');
    Route::any('shipper/getOrderShipper','ShipperController@getOrderShipper');
    Route::any('auth/shipper/forgot','ShipperController@forgot');
   

    Route::any('accessories/add','AccessoriesController@add');
    Route::any('accessories/show','AccessoriesController@show');

    Route::any('chatbot/addMessage','ChatBotController@addMessage');

    Route::any('recommened/add','RecommendedController@add');
    Route::any('recommened/getrecommened','RecommendedController@getrecommened');
    Route::any('recommened/showCate','RecommendedController@showCate');

    Route::any('store/addStore','StoreController@addStore');
    Route::any('store/checkSameName','StoreController@checkSameName');
    Route::any('store/checkSameAddress','StoreController@checkSameAddress');
    Route::any('store/showStore','StoreController@showStore');
    Route::any('store/changeStatus','StoreController@changeStatus');
    Route::any('store/getStore','StoreController@getStore');
    Route::any('store/editStore','StoreController@editStore');
});

