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

    public function index($userId = null)
    {
        $userId = auth('api')->user()->id;

        $messenger = Messenger::where('client_id', '=', $userId)->first('id');

        $messages = UserToMessage::select('messenger_id', 'message', 'direction', 'created_at')->where('messenger_id', '=', $messenger->id)->orderBy('created_at', 'desc')->get()->toArray();

        return $this->sendResponse($messages, 'Messages returned');
    }

    public function send()
    {
        $userId = auth('api')->user()->id;

        $messenger = Messenger::where('client_id', '=', $userId)->first('id');

        $messages = UserToMessage::select('messenger_id', 'message', 'direction', 'created_at')->where('messenger_id', '=', $messenger->id)->orderBy('created_at', 'desc')->get()->toArray();

        return $this->sendResponse($messages, 'Messages returned');
    }



}
