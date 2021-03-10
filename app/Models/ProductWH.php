<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductWH extends Model
{
    use HasFactory;
    protected $table='productwh';
    protected $primaryKey='prod_id';
    protected $keyType = 'string';
    protected $guarded=[];
}
