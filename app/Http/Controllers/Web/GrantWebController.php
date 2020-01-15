<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Grant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class GrantWebController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('grants.grants', [
            'title' => 'Президентские гранты',
            'grant' => Grant::select('*')->latest()->first()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->grant = trim($request->grant);
        
        $validator = Validator::make($request->all(), [
            'grant' => 'required|min:3|max:100000|string',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('auth.grants.index')
                ->withErrors($validator)
                ->withInput();
        }

        $contest = Grant::create([
            'grant' => $request->grant,
        ]);    

        return redirect()->route('auth.grants.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Contact::where('id', '=', $request->id)->delete();
        return response()->json(['succses'=>'Удалено'], 200); 
    }
}
