<?php

namespace App\Http\Controllers\Api\V1;

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
// use App\Master_app_configuration;
// use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
// use Pusher\Pusher;
use GuzzleHttp\Client;

use Illuminate\Support\Facades\Validator;

use GuzzleHttp\Exception\ClientException;

class AuthController extends Controller
{


    /**
     * @OA\Post(path="/api/v1/login",
     *   tags={"User"},
     *   summary="Logs user into the system",
     *   description="",
     *   operationId="firebase token",
     *   @OA\Parameter(
     *     name="token",
     *     required=true,
     *     in="query",
     *     description="firebase token",
     *     @OA\Schema(
     *         type="string"
     *     )
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
    public function login(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'token' => 'required',

        ]);


        if ($validator->fails()) {
            return response()->json([
                'status' => 'Failed',
                'message' => $validator->messages()
            ], 400);
        }


     // Create a client with a base URI
        $client = new Client(
            [
                'base_uri' => 'https://oauth2.googleapis.com/tokeninfo?id_token='.$request->token
            ]
        );


        try {
            $response = $client->request('GET');
            if ($response->getStatusCode() == 200) {
                $obj = json_decode($response->getBody());

                $iss = $obj->iss;

                $sub = $obj->sub;
                $email = $obj->email;
                $fullname = $obj->name;
                $picture = $obj->picture;
                $firstname = $obj->given_name;
                $lastname = $obj->family_name;
                $exp = $obj->exp;

                $user = MasterUsers::where('uid', $sub)->first();

                if(isset($user)){
                    $user->update([
                        'email' => $email,
                        'username' => $fullname,
                        'firstname' => $firstname,
                        'lastname' => $lastname,
                        'picture' => $picture,
                        'expired_at' => date('Y-m-d H:i:s', $exp),
                        'api_token' => Helper::strRandom(60)
                    ]);

                    return response()->json([
                        'status' => 'success',
                        'data' => $user
                    ], 200);

                }else{
                    $newUser = new MasterUsers([
                        'iss' => $iss,
                        'uid' => $sub,
                        'email' => $email,
                        'username' => $fullname,
                        'firstname' => $firstname,
                        'lastname' => $lastname,
                        'picture' => $picture,
                        'expired_at' => date('Y-m-d H:i:s', $exp),
                        'api_token' => Helper::strRandom(60)
                    ]);
                    if($newUser->save()){
                        return response()->json([
                            'status' => 'success',
                            'data' => $newUser
                        ], 200);
                    }
                }

            }
        } catch (ClientException $e) {
            return response()->json([
                'status' => 'error',
                'msg' => 'Invalid token'
            ], 400);
            // echo Psr7\str($e->getRequest());
            // echo Psr7\str($e->getResponse());
        }






        return response()->json([
            'status' => 'error',
            'message' => 'invalid oken'
        ], 400);

    }


}
