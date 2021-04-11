<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BallotExport extends Model
{
    use HasFactory;
    protected $table = 'ballotexports';
    protected $primaryKey = 'be_id';
    protected $guarded = [];
}
