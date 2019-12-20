<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Contest;
use App\Models\DocumentToContest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class ContestWebController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('contests.contestsList', [
            'title' => 'Конкурсы',
            'contests' => Contest::all()->sortByDesc('level')
        ]);
    }

    public function show($id)
    {
        return view('contests.contestDetail', [
            'title' => 'Конкурс',
            'contest' => Contest::where('id', '=', $id)->first(),
            'files' => DocumentToContest::where('contest_id', '=', $id)->get()
        ]);
    }

    public function create()
    {
        return view('contests.contestCreate', [
            'title' => 'Создать конкурс'
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
        $request->contest_name = trim($request->contest_name);
        $request->contest_description = trim($request->contest_description);
        
        $validator = Validator::make($request->all(), [
            'contest_name' => 'required|min:3|max:191|string',
            'contest_description' => 'required|min:3|max:100000',
            'contest_level' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('auth.cases.create')
                ->withErrors($validator)
                ->withInput();
        }

        $contest = Contest::create([
            'name' => $request->contest_name,
            'level' => $request->contest_level,
            'description' => $request->contest_description,
        ]);

        if($contest != null)
        {
            foreach($request->file('docs') as $file)
            {
                $path = $file->storeAs('public/contestDocuments', $file->getClientOriginalName());
                $url = Storage::url($path);
    
                DocumentToContest::create([
                    'contest_id' => $contest->id,
                    'document' => $url,
                ]);
            }
        }
        

        return redirect()->route('auth.contests.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        DocumentToContest::where('contest_id', '=', $request->id)->delete();
        Contest::where('id', '=', $request->id)->delete();
        return response()->json(['succses'=>'Удалено'], 200); 
    }
}
