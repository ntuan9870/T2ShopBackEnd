<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recommended_Product extends Model
{
    use HasFactory;
    protected $table="recommend_product";
    protected $primaryKey = "recommend_id";
    protected $guarded = [];
}
