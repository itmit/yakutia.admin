<?php

namespace App\Http\Controllers\Api;

use App\Models\Contest;
use App\Models\DocumentToContest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class ContestApiController extends ApiBaseController
{
    public $successStatus = 200;

    public function index()
    {
        $contests = Contest::select('name', 'level', 'description')->orderBy('level', 'desc')->get()->toArray();

        return $this->sendResponse($contests, 'Messages returned');
    }

}
