<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CTPX_LN extends Model
{
    use HasFactory;
    protected $table = 'ctpx_ln';
    protected $primaryKey = 'cl_id';
    protected $guarded = [];
}
