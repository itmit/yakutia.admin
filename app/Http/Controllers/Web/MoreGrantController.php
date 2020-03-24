<?php

namespace App\Http\Controllers\Web;

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
    public function index($t = 1)
    {
        return view('moreGrant.moreGrant', [
            'title' => 'Президентские гранты',
            'grant' => MoreGrant::select('*')->where('type', $t)->latest()->first(),
            'files' => MoreGrantToFile::where('m_grant_id', $t)->get(),
            't' => $t
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
            'grant' => 'required|min:3|max:191|string',
            't' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->to('http://yakutia.itmit-studio.ru/g'.$request->t)
                ->withErrors($validator)
                ->withInput();
        }

        $grant = MoreGrant::create([
            'type' => $request->t,
            'grant' => $request->grant,
        ]);

        if($grant != null)
        {
            if($request->file('docs') != null)
            {
                foreach($request->file('docs') as $file)
            {
                $path = $file->storeAs('public/moreGrantsFiles/'.$request->t.'', $file->getClientOriginalName());
                $url = Storage::url($path);
    
                MoreGrantToFile::create([
                    'm_grant_id' => $request->t,
                    'file' => $url,
                ]);
            }
            }
        }
        

        return redirect()->to('http://yakutia.itmit-studio.ru/g'.$request->t);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function deleteMoreGrantsFile(Request $request)
    {
        MoreGrantToFile::where('id', $request->file)->delete();
    }
}
