<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BallotImport extends Model
{
    use HasFactory;
    protected $table = 'ballotimports';
    protected $primaryKey = 'bi_id';
    protected $guarded = [];
}
