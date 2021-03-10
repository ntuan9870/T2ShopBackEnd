<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ship extends Model
{
    use HasFactory;
    protected $table = 'ship';
    protected $primaryKey = 'ship_id';
    protected $guarded = [];
}
