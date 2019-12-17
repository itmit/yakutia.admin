<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Messenger;
use App\Models\UserToMessage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MessengerWebController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('messenger.messengerList', [
            'title' => 'Мессенджер',
            'messengers' => Messenger::all()->sortByDesc('created_at')
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('messenger.messengerDetail', [
            'title' => 'Чат с пользователем',
            'messenger' => Messenger::select('client_id', 'id')->where('id', '=', $id)->first(),
            'messages' => UserToMessage::select('messenger_id', 'message', 'direction', 'created_at')->where('messenger_id', '=', $id)->orderBy('created_at', 'asc')->get(),
            'id' => $id
        ]);
    }

    /**
     * Отправить сообщение от имени администратора
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [ 
            'message_answer' => 'required|string|min:1|max:1000',
            'i' => 'required'
        ]);
        
        if ($validator->fails()) {
            return redirect()
                ->route('auth.messenger.show', ['id' => $request->i])
                ->withErrors($validator)
                ->withInput();
        }

        $messenger = Messenger::where('client_id', '=', $request->i)->first('id');

        UserToMessage::create([
            'uuid' => Str::uuid(),
            'messenger_id' => $messenger->id,
            'message' => $request->message_answer,
            'direction' => 1
        ]);

        return self::show($request->i);
    }

    private function SendPush()
    {
        $url = 'https://fcm.googleapis.com/fcm/send';

        $fields = array (
            'to' => '/topics/AdminNotification',
            "notification" => [
                "body" => "У вас ".$countOfReservations." необработанных заявок.",
                "title" => "Внимание"
            ]
        );
        $fields = json_encode ( $fields );

        $headers = array (
                'Authorization: key=' . "AAAAcZkfTDU:APA91bGgoysHhtZfk272579GGadndryldrSN49MEIO3QGrgI1aKTYir62YbtVXHEaICk1-G1NIWq9DsmCwQGmcmnqqlXWltysqQRoXPoXEdkvz-1oiHS-cF54VSNsWOvut-I_0gBQgrx",
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
    }

}
