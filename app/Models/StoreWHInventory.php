<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreWHInventory extends Model
{
    use HasFactory;
    protected $table = 'store_wh_inventories';
    protected $primaryKey = 'store_wh_inventory_id';
    protected $guarded = [];
}
