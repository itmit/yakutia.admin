<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserWebController extends Controller
{
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('user.userEdit', [
            'title' => 'Сменить пароль',
            'suc' => 0
        ]);
    }

    private $old_pass;
    private $pass;

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $request->old_password = trim($request->old_password);
        $request->old_password_confirmation = trim($request->old_password_confirmation);
        $request->new_password = trim($request->new_password);
        $request->new_password_confirmation = trim($request->new_password_confirmation);

        $validator = Validator::make($request->all(), [
            'old_password' => 'required|confirmed',
            'new_password' => 'required|confirmed'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('auth.user.show', ['id' => Auth::user()->id])
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::where('id', '=', $id)->first('password');
        $this->pass = $user->password;
        $this->old_password = $request->old_password;

        $validator->after(function ($validator) {
            if (!Hash::check($this->old_password, $this->pass)) {
                $validator->errors()->add('old_password', 'Текущий введенный пароль не совпадает с текущим паролем пользователя');
            }
        });

        if ($validator->fails()) {
            return redirect()
                ->route('auth.user.show', ['id' => Auth::user()->id])
                ->withErrors($validator)
                ->withInput();
        }

        User::where('id', '=', $id)->update([
            'password' => Hash::make($request->new_password),
        ]);

        return redirect()->route('auth.user.edit', ['id' => Auth::user()->id, 'suc' => 1]);
    }

}
