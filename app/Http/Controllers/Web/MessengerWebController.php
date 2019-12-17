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
            'messages' => UserToMessage::select('messenger_id', 'message', 'direction', 'created_at')->where('messenger_id', '=', $id)->orderBy('created_at', 'desc')->get()
        ]);
    }

}
