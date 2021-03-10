<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderWarehouse extends Model
{
    use HasFactory;
    protected $table = 'orderwarehouse';
    protected $primaryKey = 'orderWh_id';
    protected $guarded = [];
}
