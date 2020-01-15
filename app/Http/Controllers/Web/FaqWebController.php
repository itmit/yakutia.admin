<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\FAQ;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class FaqWebController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('faq.faqList', [
            'title' => 'Вопрос-ответ',
            'faq' => FAQ::all()->sortByDesc('created_at')
        ]);
    }

    public function create()
    {
        return view('faq.faqCreate', [
            'title' => 'Создать вопрос-ответ'
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
        $request->faq_question = trim($request->faq_question);
        $request->faq_answer = trim($request->faq_answer);
        
        $validator = Validator::make($request->all(), [
            'faq_question' => 'required|min:3|max:191|string',
            'faq_answer' => 'required|min:3|max:10000'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('auth.faq.create')
                ->withErrors($validator)
                ->withInput();
        }

        $contest = FAQ::create([
            'question' => $request->faq_question,
            'answer' => $request->faq_answer
        ]);    

        return redirect()->route('auth.faq.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        FAQ::where('id', '=', $request->id)->delete();
        return response()->json(['succses'=>'Удалено'], 200); 
    }
}
