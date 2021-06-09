<?php

namespace App\Http\Controllers\Api\V1;

use App\FcmTokens;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Vinkla\Hashids\Facades\Hashids as VinklaHashids;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\User;
use App\Models\Master_player_banks;
use App\Models\History_ip_logins;
use App\Helpers\Gamexyz;
use App\MasterUsers;
use FcmToken;
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
use Illuminate\Support\Str;

class FirebaseController extends Controller
{


    /**
     * @OA\Post(path="/api/v1/firebase/token",
     *   tags={"Firebase"},
     *   summary="update fcm token",
     *   description="",
     *   operationId="fcm token",
     *   @OA\Parameter(
     *     name="users_id",
     *     required=true,
     *     in="query",
     *     description="user id // 0 for guest",
     *     @OA\Schema(
     *         type="string"
     *     )
     *   ),
     *   @OA\Parameter(
     *     name="fcm_token",
     *     required=true,
     *     in="query",
     *     @OA\Schema(
     *         type="string",
     *     ),
     *     description="fcm token",
     *   ),
     *   @OA\Parameter(
     *     name="device_id",
     *     required=true,
     *     in="query",
     *     @OA\Schema(
     *         type="string",
     *     ),
     *     description="id device user phone",
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
     *   @OA\Response(response=400, description="Invalid username/password supplied")
     * )
     */
    public function fcmToken(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'device_id' => 'required',
            'fcm_token' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'Failed',
                'message' => $validator->messages()
            ], 400);
        }

        //if registered users
        if(isset($request->users_id) && $request->users_id != 0){
            $user = MasterUsers::find($request->users_id);

            if(!isset($user)){
                return response()->json([
                    'status' => 'Failed',
                    'message' => 'Users not exist'
                ], 400);
            }

            $tokens = FcmTokens::where('users_id', $user->id)->first();

            if(isset($tokens)){
                $update = $tokens->update([
                    'tokens' => $request->fcm_token,
                    'device_id' => $request->device_id
                ]);

                if($update){
                    return response()->json([
                        'status' => 'Success',
                        'message' => 'Token Updated'
                    ], 200);
                }
            }else{
                $newToken = new FcmTokens([
                    'users_id' => $request->users_id,
                    'tokens'    => $request->fcm_token,
                    'device_id' => $request->device_id
                ]);

                if($newToken->save()){
                    return response()->json([
                        'status' => 'Success',
                        'message' => 'Token Saved'
                    ], 200);
                }
            }
        }else{
            $tokens = FcmTokens::where('device_id', $request->device_id)->first();

            if(isset($tokens)){
                $update = $tokens->update([
                    'tokens' => $request->fcm_token,
                    'device_id' => $request->device_id
                ]);

                if($update){
                    return response()->json([
                        'status' => 'Success',
                        'message' => 'Token Updated'
                    ], 200);
                }
            }else{
                $newToken = new FcmTokens([
                    'users_id' => 0,
                    'tokens'    => $request->fcm_token,
                    'device_id' => $request->device_id
                ]);

                if($newToken->save()){
                    return response()->json([
                        'status' => 'Success',
                        'message' => 'Token Saved'
                    ], 200);
                }
            }

        }

    }


}
