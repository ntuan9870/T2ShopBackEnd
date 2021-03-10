<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChatBotMessage;

class ChatBotController extends Controller
{
    public function addMessage(Request $request){
        $message = new ChatBotMessage();
        $message->user_id = $request->user_id;
        $message->message_content = $request->message_content;
        $message->customer_chatbot = $request->customer_chatbot;
        $message->save();
        return response()->json(['message'=>'success']);
    }
}
