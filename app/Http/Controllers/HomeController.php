<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function survey()
    {
        $currentUser = \Auth::user();
        $questions = $this->getUnAnsweredQuestions();

        $questionsQty = Question::count(); //todo improve last answers filter method

        $myLastAnswers = $currentUser->answers()
            ->with(['question'])
            ->orderBy('created_at', 'desc')
            ->limit($questionsQty);

        return view('home', [
            'is_admin' => $currentUser->admin,
            'questions' => $questions,
            'last_answers' => $myLastAnswers->get()
        ]);
    }

    public function sendSurvey(Request $request){

        $questions = $this->getUnAnsweredQuestions();
        $rules = $questions->mapWithKeys(function($question){
            return[
                'input-' . $question->id => 'required'
            ];
        });

        $this->validate($request, $rules->toArray());

        $currentUser = \Auth::user();
        foreach ($questions as $question){
            $answer = $request->input('input-' . $question->id);
            Answer::create(
                [
                    'answer' => $answer,
                    'question_id' => $question->id,
                    'user_id' => $currentUser->id
                ]
            );
        }

        return view('success');

    }

    protected function getUnAnsweredQuestions(){

        $currentUser = \Auth::user();
        $now = Carbon::today();

        $query = Question::whereDoesntHave('answers', function($answer) use($now, $currentUser){
            $answer->where('user_id', $currentUser->id)
                ->whereRaw('MONTH(created_at) = ?', [$now->month]);
        });

        if($currentUser->admin){
            $query->with(['answers']);
        };

        return $query->get()
            ->transform(function($question){
                $question->answer_type = json_decode($question->answer_type);
                return $question;
            });

    }

    /**
     * Show the application stats.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function stats()
    {

        $lastAnswers = Answer::with(['user', 'question'])
            ->orderBy('created_at', 'desc')
            ->get();

        $chartLabels = $lastAnswers->pluck('answer')
            ->unique()
            ->toArray();

        $chartValues = [];
        foreach ($chartLabels as $label){
            $chartValues[] = $lastAnswers->filter(function($answer) use($label){
               return $answer->answer === $label;
            })->count();
        }

        return view('stats', [
            'last_answers' => $lastAnswers,
            'chart_labels' => $chartLabels,
            'chart_values' => $chartValues
        ]);
    }
}
