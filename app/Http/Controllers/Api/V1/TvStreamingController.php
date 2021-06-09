<?php

namespace App\Http\Controllers\Api\V1;

use App\Channel;
use App\Conversation;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Vinkla\Hashids\Facades\Hashids as VinklaHashids;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\User;
use App\Models\Master_player_banks;
use App\Models\History_ip_logins;
use App\Helpers\Gamexyz;
use App\Helpers\Helper;
use App\MasterUsers;
use App\News;
use App\NewsCategory;
use App\TvStreaming;
// use App\Master_app_configuration;
// use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
// use Pusher\Pusher;
use GuzzleHttp\Client;
use Hashids\Hashids;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Smsglobal\RestApiClient2\ApiKey;
use Smsglobal\RestApiClient2\Resource\Sms;
use Smsglobal\RestApiClient2\RestApiClient;

class TvStreamingController extends Controller
{


      /**
     * @OA\Get(path="/api/v1/tv",
     *   tags={"Tv"},
     *   summary="List tv ",
     *   description="",
     *   operationId="listTv",
     *   @OA\Response(response="default", description="successful operation"),
     * )
     */
    public function tv(Request $request)
    {

        $user =  auth()->guard('api')->user();

        $tv = TvStreaming::where('tv_status_delete', 0)
                    ->get();

        foreach($tv as $item){
            $item->tv_img = url('').'/'.$item->tv_img;
        }


        return response()->json([
            'status' => 'success',
            'data' => $tv
        ], 200);
    }

      /**
     * @OA\Get(path="/api/v1/detail-tv/{id_tv}",
     *   tags={"Tv"},
     *   summary="detal tv ",
     *   description="",
     *   operationId="detailTv",
     *   @OA\Parameter(
     *     name="id_tv",
     *     in="query",
     *     @OA\Schema(
     *         type="int",
     *     ),
     *     description="detail tv",
     *   ),
     *   @OA\Response(response="default", description="successful operation"),
     * )
     */
    public function detailTv(Request $request)
    {

        $user =  auth()->guard('api')->user();

        $tv = TvStreaming::find($request->id_tv);

        $tv->tv_img = url('').'/'.$tv->tv_img;

        if(!isset($tv)){
            return response()->json([
                'status' => 'error',
                'data' => 'tv not found'
            ], 400);
        }

        return response()->json([
            'status' => 'success',
            'data' => $tv
        ], 200);
    }

       /**
     * @OA\Get(path="/api/v1/historychat/{id_tv}",
     *   tags={"Tv"},
     *   summary="history chat tv ",
     *   description="",
     *   operationId="historyChat",
     *   @OA\Parameter(
     *     name="id_tv",
     *     in="query",
     *     @OA\Schema(
     *         type="int",
     *     ),
     *     description="history chat tv",
     *   ),
     *   @OA\Response(response="default", description="successful operation"),
     * )
     */
    public function historyChat(Request $request)
    {

        $user =  auth()->guard('api')->user();

        $tv = TvStreaming::find($request->id_tv);

        $tv->tv_img = url('').'/'.$tv->tv_img;

        if(!isset($tv)){
            return response()->json([
                'status' => 'error',
                'data' => 'tv not found'
            ], 400);
        }

        $channel = $tv->channel;

        return response()->json([
            'status' => 'success',
            'data' => $channel->messages
        ], 200);
    }

    /**
     * @OA\Post(path="/api/v1/sendchat",
     *   tags={"Tv"},
     *   summary="send chat",
     *   description="",
     *   operationId="send chat",
     *   @OA\Parameter(
     *     name="channel_id",
     *     required=true,
     *     in="query",
     *     description="id channel chatt",
     *     @OA\Schema(
     *         type="string"
     *     )
     *   ),
     *   @OA\Parameter(
     *     name="message",
     *     required=true,
     *     in="query",
     *     @OA\Schema(
     *         type="string",
     *     ),
     *     description="message",
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="successful operation",
     *     @OA\Schema(type="string"),
     *     @OA\Header(
     *       header="X-Rate-Limit",
     *       @OA\Schema(
     *           type="integer",
     *           format="int32"
     *       ),
     *       description="calls per hour allowed by the user"
     *     ),
     *     @OA\Header(
     *       header="X-Expires-After",
     *       @OA\Schema(
     *          type="string",
     *          format="date-time",
     *       ),
     *       description="date in UTC when token expires"
     *     )
     *   ),
     *   @OA\Response(response=400, description="fail send chat"),
     *   security={{
     *     "Authorization":{}
     *   }}
     * )
     */
    public function sendChat(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'channel_id' => 'required',
            'message' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'Failed',
                'message' => $validator->messages()
            ], 400);
        }

        $user =  auth()->guard('api')->user();

        $channel = Channel::find($request->channel_id);

         $pusher = Helper::initPusher();

         $data['message'] = $request->message;
         $data['user']    = $user;
         $pusher->trigger($channel->channel_name, 'new_messages', $data);

         $conversation = Conversation::create([
           'message' => $request->message,
           'channel_id' => $request->channel_id,
           'user_id' => $user->id,
         ]);

         $conversation->save();

         $message = Conversation::find($conversation->id);

         return response()->json([
           'status' => 'success',
           'message' => 'success send message',
           'data' => $message
       ], 200);

    }

}
