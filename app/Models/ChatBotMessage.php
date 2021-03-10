<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatBotMessage extends Model
{
    use HasFactory;
    protected $table = 'chatbotmessages';
    protected $primaryKey = 'message_id';
    protected $guarded = [];
}
