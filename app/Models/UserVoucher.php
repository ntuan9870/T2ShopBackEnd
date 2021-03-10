<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserVoucher extends Model
{
    use HasFactory;
    protected $table = 'user_voucher';
    protected $primaryKey = 'user_voucher_id';
    protected $guarded = [];
}
