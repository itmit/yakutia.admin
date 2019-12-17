<?php

namespace App\Http\Controllers\Api;

use App\Models\Client;
use App\Models\Event;
use App\Models\UserToEvent;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class EventApiController extends ApiBaseController
{
    public $successStatus = 200;

    public function getEventsByDate(string $date = null)
    {
        if($date == null)
        {
            return response()->json(['error'=>'Пустая дата'], 404); 
        }

        $events = Event::where('date_start', '=', $date)->get()->toArray();

        return $this->sendResponse($events, 'Events returned');
    }

    public function registerOnEvent(Request $request)
    {
        $validator = Validator::make($request->all(), [ 
            'event' => 'required|uuid'
        ]);
        
        if ($validator->fails()) { 
            return response()->json(['errors'=>$validator->errors()], 404);            
        }

        $userId = auth('api')->user()->id;
        $event = Event::where('uuid', '=', $request->event)->first('id');

        if(UserToEvent::where('user_id', '=', $userId)->where('event_id', '=', $event->id)->exists())
        {
            return response()->json(['error'=>'Пользователь уже зарегистрирован на данное мероприятие'], 404);       
        }

        UserToEvent::create([
            'user_id' => $userId,
            'event_id' => $event->id,
        ]);

        return $this->sendResponse([], 'Пользователь успешно зарегистрировался на мероприятие');
    }

}
