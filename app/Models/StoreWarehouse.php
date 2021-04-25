<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreWarehouse extends Model
{
    use HasFactory;
    protected $table = 'store_warehouses';
    protected $primaryKey = 'store_wh_id';
    protected $guarded = [];
}
