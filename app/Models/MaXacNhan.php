<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaXacNhan extends Model
{
    use HasFactory;
    protected $table = 'maxacnhan';
    protected $primaryKey = 'id';
    protected $guarded = [];
}
