<?php

namespace App\Http\Controllers\Api;

use App\Models\Client;
use App\Models\Messenger;
use App\Models\UserToMessage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class MessengerApiController extends ApiBaseController
{
    public $successStatus = 200;

    public function index()
    {
        $userId = auth('api')->user()->id;

        $messenger = Messenger::where('client_id', '=', $userId)->first('id');

        $messages = UserToMessage::select('messenger_id', 'message', 'direction', 'created_at')->where('messenger_id', '=', $messenger->id)->orderBy('created_at', 'asc')->get()->toArray();

        return $this->sendResponse($messages, 'Messages returned');
    }

    public function send(Request $request)
    {
        $validator = Validator::make($request->all(), [ 
            'message' => 'required|string|min:1|max:1000'
        ]);
        
        if ($validator->fails()) { 
            return response()->json(['errors'=>$validator->errors()], 404);            
        }

        $userId = auth('api')->user()->id;

        $messenger = Messenger::where('client_id', '=', $userId)->first('id');

        UserToMessage::create([
            'uuid' => Str::uuid(),
            'messenger_id' => $messenger->id,
            'message' => $request->message,
            'direction' => 0
        ]);

        return $this->sendResponse([], 'Messages sended');
    }

}
