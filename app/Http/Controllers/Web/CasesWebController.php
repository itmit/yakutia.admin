<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cases;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CasesWebController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('cases.caseList', [
            'title' => 'Кейсы/успешные практики',
            'cases' => Cases::all()->sortByDesc('created_at')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cases.caseCreate', [
            'title' => 'Добавить кейс'
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

        $request->case_head = trim($request->case_head);
        $request->case_body = trim($request->case_body);

        $validator = Validator::make($request->all(), [
            'case_head' => 'required|min:3|max:100|string',
            'case_body' => 'required|min:3|max:20000',
            'case_picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('auth.cases.create')
                ->withErrors($validator)
                ->withInput();
        }


        $path = $request->file('case_picture')->store('public/newsPictures');
        $url = Storage::url($path);

        Cases::create([
            'uuid' => Str::uuid(),
            'head' => $request->input('case_head'),
            'body' => $request->input('case_body'),
            'picture' => $url,
        ]);

        return redirect()->route('auth.cases.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
}
