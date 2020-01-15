<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Contact;
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
            // 'contacts' => Contact::all()->sortByDesc('created_at')
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
}
