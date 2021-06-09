<?php

namespace App\Http\Controllers;

use App\Channel;
use App\Conversation;
use App\Helpers\Helper;
use App\MasterUsers;
use Illuminate\Http\Request;
use Pusher\Pusher;

class PusherController extends Controller
{
    public function sendMessage(Request $request){

         $channel = Channel::find($request->channel_id);
         $user = MasterUsers::find($request->user_id);



          $pusher = Helper::initPusher();

          $data['message'] = $request->message;
          $data['user']    = $user;
          $pusher->trigger($channel->channel_name, 'new_messages', $data);

          $conversation = Conversation::create([
            'message' => $request->message,
            'channel_id' => $request->channel_id,
            'user_id' => $request->user_id,
          ]);

          $conversation->save();

          return response()->json([
            'status' => 'success',
            'message' => 'success send message',
            'data' => $conversation->with('channel')->with('user')
        ], 200);

    }
}
