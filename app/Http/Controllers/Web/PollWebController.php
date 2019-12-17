<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Poll;
use App\Models\PollQuestions;
use App\Models\PollQuestionAnswers;
use App\Models\PollQuestionAnswerUsers;
use App\Models\UserToPoll;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PollWebController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('polls.pollsList', [
        'polls' => Poll::select('*')
            ->orderBy('created_at', 'desc')->get()
        ]); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('polls.pollCreate'); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $poll = Poll::create([
            'uuid' => (string) Str::uuid(),
            'name' => $request->all_data["name"],
            'description' => $request->all_data["description"],
            'link' => $request->all_data["link"],
            'start_at' => $request->all_data["start_at"],
            'end_at' => $request->all_data["end_at"],
        ]);

        foreach($request->all_data["questions"] as $questions)
        {
            if($questions['multiple'] == 'true') $questions['multiple'] = 1;
            if($questions['multiple'] == 'false') $questions['multiple'] = 0;

            $pollQuestion = PollQuestions::create([
                'uuid' => (string) Str::uuid(),
                'poll_id' => $poll->id,
                'question' => $questions['question_name'],
                'multiple' => $questions['multiple'],
            ]);

            $i = 0;

            foreach ($questions['answers'] as $key => $value) {
                $pollQuestionAnswer = PollQuestionAnswers::create([
                    'uuid' => (string) Str::uuid(),
                    'question_id' => $pollQuestion->id,
                    'answer' => $value,
                    // 'answers_count' => $questions['answer_count'][$i],
                    'type' => 0,
                ]);
                $i++;
            }

            if($questions['other'] == 'true'){
                $pollQuestionAnswer = PollQuestionAnswers::create([
                    'uuid' => (string) Str::uuid(),
                    'question_id' => $pollQuestion->id,
                    'answer' => 'Другой',
                    'type' => 1,
                ]);
            }
        };
    }
}