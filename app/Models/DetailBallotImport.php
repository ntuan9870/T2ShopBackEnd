<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailBallotImport extends Model
{
    use HasFactory;
    protected $table = 'detail_ballot_import';
    protected $primaryKey = 'dbi_id';
    protected $guarded = [];
}
