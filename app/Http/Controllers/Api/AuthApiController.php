<?php

namespace App\Http\Controllers\Api;

use App\Models\Client;
use App\Models\Messenger;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AuthApiController extends ApiBaseController
{
    public $successStatus = 200;

    private $name;
    private $email;
    private $type;
    private $password;
    private $user;
    private $device_token;

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [ 
            'email' => 'required|unique:clients|email|max:191',
            'name' => 'required|max:191|min:2',
            'type' => 'required|max:191',
            'password' => 'required|confirmed',
        ]);
        
        if ($validator->fails()) { 
            return response()->json(['errors'=>$validator->errors()], 401);            
        }

        if(Client::where('email', '=', $request->email)->exists())
        {
            return response()->json(['error'=>'Клиент уже зарегистрирован'], 401);     
        }

        $this->name = $request->name;
        $this->email = $request->email;
        $this->type = $request->type;
        $this->password = $request->password;
        $this->device_token = $request->device_token;

        DB::transaction(function () {
            $this->user = Client::create([
                'uuid' => Str::uuid(),
                'name' => $this->name,
                'email' => $this->email,
                'type' => $this->type,
                'password' => Hash::make($this->password),
            ]);

            if($this->device_token)
            {
                Client::where('id', '=', $this->user->id)->update([
                    'device_token' => $this->device_token
                ]);
            };
           
            Messenger::create([
                'uuid' => Str::uuid(),
                'client_id' => $this->user->id,
            ]);

        });

        if(!Client::where('email', '=', $request->email)->exists())
        {
            return response()->json(['error'=>'Не удалось зарегистрировать клиента'], 401);     
        }

        Auth::login($this->user);     

        if (Auth::check()) {
            $tokenResult = $this->user->createToken(config('app.name'));
            $token = $tokenResult->token;
            $token->expires_at = Carbon::now()->addWeeks(1);
            $token->save();

            return $this->sendResponse([
                'access_token' => $tokenResult->accessToken,
                'token_type' => 'Bearer',
                'expires_at' => Carbon::parse(
                    $tokenResult->token->expires_at
                )->toDateTimeString()
            ],
                'Authorization is successful');
        }
        
        return response()->json(['error'=>'Не удалось авторизоваться'], 401);     
    }

    /** 
     * login api 
     * 
     * @return Response 
     */ 
    public function login(Request $request) { 

        $validator = Validator::make($request->all(), [ 
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);
        
        if ($validator->fails()) { 
            return response()->json(['errors'=>$validator->errors()], 401);            
        }

        if(!Client::where('email', '=', $request->email)->exists())
        {
            return response()->json(['error'=>'Такого пользователя не существует'], 401); 
        }       

        $client = Client::where('email', '=', $request->email)->first();

        if(Hash::check($request->password, $client->password))
        {
            Auth::login($client);
            if (Auth::check()) {
                $tokenResult = $client->createToken(config('app.name'));
                $token = $tokenResult->token;
                $token->expires_at = Carbon::now()->addWeeks(1);
                $token->save();

                if($request->device_token)
                {
                    Client::where('id', '=', $client->id)->update([
                        'device_token' => $request->device_token
                    ]);
                }

                return $this->sendResponse([
                    'access_token' => $tokenResult->accessToken,
                    'token_type' => 'Bearer',
                    'expires_at' => Carbon::parse(
                        $tokenResult->token->expires_at
                    )->toDateTimeString(),
                ],
                    'Authorization is successful');
            }
        }
        else
        {
            return response()->json(['error'=>'Неверный пароль'], 401); 
        }
        return response()->json(['error'=>'Авторизация не удалась'], 401); 
    }

    public function logout(Request $request)
    {
        $isUser = $request->client()->token()->revoke();
        if($isUser){
            $success['message'] = "Successfully logged out.";
            return $this->sendResponse($success);
        }
        else{
            $error = "Something went wrong.";
            return $this->sendResponse($error);
        }
    }

    public function sendCode(Request $request)
    {
        $validator = Validator::make($request->all(), [ 
            'email' => 'required|email|exists:clients',
        ]);
        
        if ($validator->fails()) { 
            return response()->json(['errors'=>$validator->errors()], 401);            
        }

        $code = random_int(1000, 9999);
        $message = "Ваш код для сброса пароля: " . $code;

        // На случай если какая-то строка письма длиннее 70 символов мы используем wordwrap()
        $message = wordwrap($message, 70, "\r\n");

        // Отправляем
        mail($request->email, 'My Subject', $message);
    }
    
    public function resetPassword(Request $request)
    {
        
    }
}
