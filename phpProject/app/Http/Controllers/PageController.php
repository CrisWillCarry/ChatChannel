<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\response;
use App\Models\ChatUser;
use App\Models\Message;

class PageController extends Controller
{
    public function setChatUser(Request $request){
        $fields = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
            'imageURL' => 'required|string'
        ]);
        $chatuser = ChatUser::create([
            'username' => $fields['username'],
            'password' => $fields['password'],
            'imageURL' => $fields['imageURL']
        ]);

        return response($chatuser, 201);
    }

    public function getChatUsers(){
        $arrayChatUsers = ChatUser::all();
        return response($arrayChatUsers, 200);
    }

    public function getChatUserById($id){
        $chatuser = ChatUser::find($id);

        if (!$chatuser){
            return response()->json(['message' => 'Chatuser not found'], 404);
        }

        return response()->json($chatuser, 200);
    }

    public function setMessage(Request $request){
        $fields = $request->validate([
            'message' => 'required|string',
            'senderId' => 'required|integer',
            'receiverId' => 'required|integer'
        ]);
        $message = Message::create([
            'message' => $fields['message'],
            'senderId' => $fields['senderId'],
            'receiverId' => $fields['receiverId']
        ]);

        return response($message, 201);
    }

    public function deleteChatUser($id){
        $chatuser = ChatUser::find($id);
        $senderMessages = Message::where('senderId', $id);
        $receiverMessages;

        if ($senderMessages){
            $senderMessages->delete();
            $receiverMessages = Message::where('receiverId', $id);
        }
        if($receiverMessages){
            $receiverMessages->delete();
        }

        if ($chatuser) {
            $chatuser->delete();
            return response()->json(['message' => 'User deleted successfully.']);
        }
            return response()->json(['message' => 'User not found.']);
    }

    public function getMessages(){
        $arrayMessages = Message::all();
        return response($arrayMessages, 200);
    }

    public function getMessageById($id){
        $message = Message::find($id);

        if (!$message){
            return response()->json(['message' => 'Message not found'], 404);
        }

        return response()->json($message, 200);
    }

    public function getMessageBySenderId($senderId){}

    public function getMessageBySenderIdAndReceiverId($senderId, $receiverId){
        $messages = Message::where(function($query) use ($senderId, $receiverId) {
            $query->where('senderId', $senderId)
                  ->where('receiverId', $receiverId);
        })
        ->orWhere(function($query) use ($senderId, $receiverId) {
            $query->where('senderId', $receiverId)
                  ->where('receiverId', $senderId);
        })
        ->orderBy('created_at', 'asc')
        ->get();

        if (!$messages){
            return response()->json(['message' => 'Messages not found with receiverId: ' + $receiverId + 'and senderId: ' + $senderId]);
        }

        return response()->json($messages, 200);
    }

    public function deleteMessage($id){
        $message = Message::find($id);

        if ($message){
            $message->delete();
            return response()->json(['message' => 'Message deleted successfully']);
        }

        return response()->json(['message' => 'Messages not found']);
    }
    
    public function deleteMessages(){
        Message::truncate();

    return response()->json(['message' => 'All messages deleted successfully.']);
    }


}
