<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Messenger;
use App\Models\UserToMessage;
use App\Models\Client;
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

        $client = Client::where('id', '=', $request->i)->first();
        if($client->device_token)
        {
            self::SendPush($client->device_token);
        }

        return route('auth.messenger/', ['id' => $request->i]);
    }

    private function SendPush($token)
    {
        $url = 'https://fcm.googleapis.com/fcm/send';

        $fields = array (
            'to' => $token,
            "notification" => [
                "body" => "Вам ответил администратор!",
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
    }

}
