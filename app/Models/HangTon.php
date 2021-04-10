<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HangTon extends Model
{
    use HasFactory;
    protected $table = 'hang_ton';
    protected $primaryKey = 'ht_id';
    protected $guarded = [];
}
