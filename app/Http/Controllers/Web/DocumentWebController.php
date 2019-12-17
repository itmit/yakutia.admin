<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Document;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class DocumentWebController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('documents.documentsList', [
            'title' => 'Документы',
            'docs' => Document::all()->sortByDesc('section')
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
        foreach($request->file('docs') as $file)
        {
            $path = $file->storeAs('public/documents', $file->getClientOriginalName());
            $url = Storage::url($path);

            Document::create([
                'section' => $request->section,
                'doc' => $url,
            ]);
        }

        return redirect()->route('auth.documents.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        Document::where('id', '=', $request->id)->delete();
        return 'deleted';
    }
}
