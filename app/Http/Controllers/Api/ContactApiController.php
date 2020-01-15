<?php

namespace App\Http\Controllers\Api;

use App\Models\Contact;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class ContactApiController extends ApiBaseController
{
    public $successStatus = 200;

    public function index()
    {
        $contacts = Contact::select('name', 'supervisor', 'adress', 'phone', 'created_at')->orderBy('created_at', 'desc')->get()->toArray();

        return $this->sendResponse($contacts, 'Contacts returned');
    }

}
