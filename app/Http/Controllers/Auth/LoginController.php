<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\MasterUsers;
use App\Providers\RouteServiceProvider;
use App\User;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = 'dashboard/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        // return $request;

        $user = User::where('email', $request->email)->first();

        // return $user;

        if(isset($user)){


            if($request->password == Crypt::decrypt($user->password)){

                // return $user;
                // Auth::login($user);
                Auth::guard('admin')->login($user);
                // Auth::guard('web')->login($user);


                return redirect('/dashboard');

            }else{

                return redirect()->back()->with('error', 'Password is incorrect');
            }
        }else{
            return redirect()->back()->with('error', 'Username or email does not exist');
        }
    }

    public function loginAuth(Request $request)
    {

        // return $request;
        $validator = Validator::make($request->all(), [
            'token' => 'required',
        ]);


        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->messages());
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

                $iss = $request->providerId;

                $sub = $request->uid;
                $email = $request->email;
                $fullname = $request->username;
                $picture = $request->picture;
                // $firstname = $obj->given_name;
                // $lastname = $obj->family_name;
                // $exp = $request->exp;

                $user = MasterUsers::where('uid', $sub)->first();

                if(isset($user)){
                    $user->update([
                        'email' => $email,
                        'username' => $fullname,
                        // 'firstname' => $firstname,
                        // 'lastname' => $lastname,
                        'picture' => $picture,
                        // 'expired_at' => date('Y-m-d H:i:s', $exp),
                        'api_token' => Helper::strRandom(60)
                    ]);



                    Auth::guard('web')->login($user);


                    return redirect()->back()->with('success', 'login success');


                }else{
                    $newUser = new MasterUsers([
                        'iss' => $iss,
                        'uid' => $sub,
                        'email' => $email,
                        'username' => $fullname,
                        // 'firstname' => $firstname,
                        // 'lastname' => $lastname,
                        'picture' => $picture,
                        // 'expired_at' => date('Y-m-d H:i:s', $exp),
                        'api_token' => Helper::strRandom(60)
                    ]);
                    if($newUser->save()){

                        Auth::login($newUser);

                        return redirect()->back()->with('success', 'login success');

                    }
                }

            }
        } catch (ClientException $e) {
            return redirect()->back()->with('error', 'invalid token');

        }


    }
}
