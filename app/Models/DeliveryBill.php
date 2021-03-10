<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryBill extends Model
{
    use HasFactory;
    protected $table = 'deliverybill';
    protected $primaryKey = 'deliverybill_id';
    protected $guarded = [];
}
