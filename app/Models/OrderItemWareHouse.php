<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItemWareHouse extends Model
{
    use HasFactory;
    protected $table = 'orderitemwarehouse';
    protected $primaryKey = 'id_item';
    protected $guarded = [];
}
