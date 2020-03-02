<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\MoreGrant;
use App\Models\MoreGrantToFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class MoreGrantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('moreGrant.moreGrantApi', [
            'title' => 'Президентские гранты',
            'grant' => MoreGrant::select('*')->where('type', $request->t)->latest()->first(),
            'files' => MoreGrantToFile::where('m_grant_id', $request->t)->get(),
        ]);
    }
}
