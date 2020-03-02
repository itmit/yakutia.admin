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
            'event' => 'required|uuid',
            'phone' => 'string',
            'organization' => 'string',
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
            'phone' => $request->phone,
            'org' => $request->organization,
        ]);

        return $this->sendResponse([], 'Пользователь успешно зарегистрировался на мероприятие');
    }

    public function send()
    {
        $url = 'https://fcm.googleapis.com/fcm/send';
        $today = date("Y-m-d");  
        $events = Event::where('date_start', $today)->get();

        foreach ($events as $event) {
            $users = UserToEvent::where('event_id', $event->id)->get();
            $usersTokens = [];
            foreach ($users as $user) {
                $usersTokens[] = $user->user()->device_token;
            };
            return $usersTokens;
            $fields = array (
                'to' => $usersTokens,
                "notification" => [
                    "body" => "Сегодня событие" . $event->head,
                    "title" => "Внимание"
                ]
            );
            $fields = json_encode ( $fields );
    
            $headers = array (
                    'Authorization: key=' . "AAAA6ySBDpw:APA91bH_y7bFtB0fHFyLiSiDjvy4BvqzkiOzsU_QbJyWFHAH0n1EdGqsllWm_r_wOxDGxiThbHtLRVF7WzaG3pZFTp_Skxk9bb-VeZdA8HOwIQG7hOvZb4LhOWqjX6sV9nkaHhbzpgzp",
                    'Content-Type: application/json'
            );
    
            $ch = curl_init ();
            curl_setopt ( $ch, CURLOPT_URL, $url );
            curl_setopt ( $ch, CURLOPT_POST, true );
            curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
            curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
            curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields );
    
            curl_exec ( $ch );
    
            curl_close ( $ch );
        };
    }

}
