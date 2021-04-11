<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailBallotExport extends Model
{
    use HasFactory;
    protected $table = 'detail_ballot_export';
    protected $primaryKey = 'dbe_id';
    protected $guarded = [];
}
