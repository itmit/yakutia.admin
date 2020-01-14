<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Poll;
use App\PollQuestions;
use App\PollQuestionAnswers;
use App\PollQuestionAnswerUsers;
use App\UserToPoll;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PollApiController extends ApiBaseController
{
    /**
     * Выводит список опросов
     *
     * @return \Illuminate\Http\Response
     */
    public function getPollList(Request $request)
    {
        $polls = Poll::all()->toArray();

        return $this->sendResponse($polls, 'Список опросов');
    }

    /**
     * Выводит список вопросов и ответов данного опроса
     *
     * @return \Illuminate\Http\Response
     */
    public function getPollQuestionList(Request $request)
    {
        $validator = Validator::make($request->all(), [ 
            'poll_uuid' => 'required|uuid',
        ]);

        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }

        $poll = Poll::where('uuid', '=', $request->poll_uuid)->first();

        if($poll == null)
        {
            return $this->sendError(0, 'Такого опроса не существует');
        }

        $questions = PollQuestions::where('poll_id', '=', $poll->id)->get();

        $response = [];

        foreach($questions as $question)
        {
            $response_answers = [];
            $question_answers = PollQuestionAnswers::where('question_id', '=', $question->id)->get();
            foreach($question_answers as $question_answer)
            {
                $response_answers [] = [
                    'answer_uuid' => $question_answer->uuid,
                    'answer' => $question_answer->answer,
                    'type' => $question_answer->type
                ];
            }
            $response[] = [
                'question_uuid' => $question->uuid,
                'question' => $question->question,
                'multiple' => $question->multiple,
                'answers' => $response_answers
            ];
            // $response[] = [
                
            // ];
            
        }

        return $this->sendResponse($response, 'Список вопросов');
    }

    /**
     * Прохождение опроса пользователем
     *
     * @return \Illuminate\Http\Response
     */
    public function passPoll(Request $request)
    {
        $validator = Validator::make($request->all(), [ 
            'user_answer' => 'required|array',
            'uuid' => 'required|uuid'
        ]);

        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }

        $poll = Poll::where('uuid', '=', $request->uuid)->first();

        $isAlreadyPassed = UserToPoll::where('user_id', '=', auth('api')->user()->id)->where('poll_id', '=', $poll->id)->first();
        if($isAlreadyPassed != NULL)
        {
            return $this->sendError('Poll already passed', 'Опрос уже пройден');
        }

        foreach ($request->user_answer as $question_uuid => $answer_uuids)
        {
            foreach ($answer_uuids as $answer_uuid => $value)
            {                
                $answer_id = PollQuestionAnswers::where('uuid', '=', $answer_uuid)->first(['id', 'type']);
                $uuid = Str::uuid();
                if($answer_id['type'] == 0) // обычный ответ, не другой
                {
                    PollQuestionAnswerUsers::create([
                        'uuid' => $uuid,
                        'answer_id' => $answer_id['id'],
                        'user_id' => auth('api')->user()->id,
                    ]);
                }
                else
                {
                    PollQuestionAnswerUsers::create([
                        'uuid' => $uuid,
                        'answer_id' => $answer_id['id'],
                        'user_id' => auth('api')->user()->id,
                        'other' => $value,
                    ]);
                }
            }
        }

        UserToPoll::create([
            'user_id' => auth('api')->user()->id,
            'poll_id' => $poll->id
        ]);
        
    }


    public function showPollResults($uuid)
    {
        $poll = Poll::where('uuid', '=', $uuid)->first('id');

        $questions = PollQuestions::where('poll_id', '=', $poll->id)->get();

        $response = [];
        $userAnswers = [];

        foreach($questions as $question)
        {
            $response_answers = [];
            $question_answers = PollQuestionAnswers::where('question_id', '=', $question->id)->get();
            foreach($question_answers as $question_answer)
            {
                $response_answers [] = [
                    'answer_id' => $question_answer->id,
                    'answer_uuid' => $question_answer->uuid,
                    'answer' => $question_answer->answer,
                    'type' => $question_answer->type,
                    'answers_count' => $question_answer->answers_count
                ];
                // $data = [];
                // $userAnswers[] = PollQuestionAnswerUsers::where('answer_id', '=', $question_answer->id)
            }
            $response[] = [
                'question_uuid' => $question->uuid,
                'question' => $question->question,
                'multiple' => $question->multiple,
                'answers' => $response_answers
            ];
        }

        $data = UserToPoll::where('poll_id', '=', $poll->id)->get();

        return view('polls.showPollResults', [
            'poll' => Poll::where('id', '=', $poll->id)->first(),
            'questions' => PollQuestions::where('poll_id', '=', $poll->id)->get(),
            'response' => $response,
            'data' => $data
        ]); 
    }
}
