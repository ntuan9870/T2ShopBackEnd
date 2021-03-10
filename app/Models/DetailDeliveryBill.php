<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailDeliveryBill extends Model
{
    use HasFactory;
    protected $table = 'detaildeliverybill';
    protected $primaryKey = 'id';
    protected $guarded = [];
}
