<?php

namespace App\Http\Controllers\Api;

use App\Models\FAQ;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class FaqApiController extends ApiBaseController
{
    public $successStatus = 200;

    public function index()
    {
        $faq = Contact::select('question', 'answer', 'created_at')->orderBy('created_at', 'desc')->get()->toArray();

        return $this->sendResponse($faq, 'Contacts returned');
    }

}
