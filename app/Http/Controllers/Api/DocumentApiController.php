<?php

namespace App\Http\Controllers\Api;

use App\Models\Document;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class DocumentApiController extends ApiBaseController
{
    public $successStatus = 200;

    public function index()
    {
        $docs = Document::select('section', 'doc')->orderBy('section', 'desc')->toArray();

        return $this->sendResponse($docs, 'Messages returned');
    }

}
