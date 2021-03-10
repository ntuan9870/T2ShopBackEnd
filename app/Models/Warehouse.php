<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    use HasFactory;
    protected $table='warehouse';
    protected $primaryKey='warehouse_id';
    protected $keyType = 'string';
    protected $guarded=[];
}
