<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class ContactWebController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('contacts.contactsList', [
            'title' => 'Конкурсы',
            'contacts' => Contact::all()
        ]);
    }

    // public function show($id)
    // {
    //     return view('contests.contestDetail', [
    //         'title' => 'Конкурс',
    //         'contest' => Contest::where('id', '=', $id)->first(),
    //         'files' => DocumentToContest::where('contest_id', '=', $id)->get()
    //     ]);
    // }

    public function create()
    {
        return view('contacts.contacts', [
            'title' => 'Создать контакт'
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
            'сontact_name' => 'required|min:3|max:191|string',
            'сontact_supervisor' => 'required|min:3|max:191',
            'сontact_adress' => 'required',
            'сontact_phone' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('auth.сontacts.create')
                ->withErrors($validator)
                ->withInput();
        }

        $contest = Contact::create([
            'name' => $request->contest_name,
            'level' => $request->contest_level,
            'description' => $request->contest_description,
        ]);    

        return redirect()->route('auth.сontacts.index');
    }

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function destroy(Request $request)
    // {
    //     DocumentToContest::where('contest_id', '=', $request->id)->delete();
    //     Contest::where('id', '=', $request->id)->delete();
    //     return response()->json(['succses'=>'Удалено'], 200); 
    // }
}
