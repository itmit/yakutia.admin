<?php

namespace App\Http\Controllers\Api;

use App\Models\Cases;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class CaseApiController extends ApiBaseController
{
    public $successStatus = 200;

    public function index($limit = 100, $offset = 0)
    {
        $Cases = Cases::select('uuid', 'head', 'body', 'picture', 'created_at')->limit($limit)->offset($offset)->orderBy('created_at', 'desc')->get()->toArray();

        return $this->sendResponse($Cases, 'Cases returned');
    }

}
