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
            'contacts' => Contact::all()->sortByDesc('created_at')
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
        return view('contacts.contactsCreate', [
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
        $request->сontact_name = trim($request->сontact_name);
        $request->сontact_supervisor = trim($request->сontact_supervisor);
        
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
            'name' => $request->сontact_name,
            'supervisor' => $request->сontact_supervisor,
            'adress' => $request->сontact_adress,
            'phone' => $request->сontact_phone,
        ]);    

        return redirect()->route('auth.contacts.index');
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contact = Contact::where('id', $id)->first();
        return view('contacts.contactsEdit', [
            'title' => 'Редактировать контакт',
            'id' => $id,
            'contact' => $contact
        ]);
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
        $request->сontact_name = trim($request->сontact_name);
        $request->сontact_supervisor = trim($request->сontact_supervisor);
        
        $validator = Validator::make($request->all(), [
            'сontact_name' => 'required|min:3|max:191|string',
            'сontact_supervisor' => 'required|min:3|max:191',
            'сontact_adress' => 'required',
            'сontact_phone' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('auth.contacts.edit', ['id' => $id])
                ->withErrors($validator)
                ->withInput();
        }

        Contact::where('id', $id)->update([
            'name' => $request->сontact_name,
            'supervisor' => $request->сontact_supervisor,
            'adress' => $request->сontact_adress,
            'phone' => $request->сontact_phone,
        ]);    

        return redirect()->route('auth.contacts.index');
    }
}
