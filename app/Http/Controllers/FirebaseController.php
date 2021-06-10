<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

class FirebaseController extends Controller
{
    public function index(){
       

        $factory = (new Factory)->withServiceAccount(__DIR__.'/FirebaseKey2.json')->withDatabaseUri('https://t2shop-notification-default-rtdb.firebaseio.com/');
        $database = $factory->createDatabase();

        $ref = $database->getReference('Vouchers');
        $key = $ref ->push()->getKey();
        // $ref->getChild($key)->set([
        //     'name' => 'VoucherUpdated',
        //     'date' => '1/1/9999'
        // ]);
        $ref->getChild('0')->update([
                'name' => 'VoucherUpdated',
                'date' => '1/1/9999'
            ]);
        return $key;
    }
}
