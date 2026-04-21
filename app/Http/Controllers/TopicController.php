<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use App\Models\Result;
use Illuminate\Http\Request;

class TopicController extends Controller
{
   public function index(){
        $topics = Topic::all();
        return view("quiz.index", compact("topics"));

    }

    public function show(Topic $topic) {
        session()->forget('answers');
        $questions = $topic->questions()
        ->with('answers')
        ->paginate(1);

    return view("quiz.show", compact("topic", "questions"));

    }

    public function create() {
        $topics = Topic::all();
        return view("quiz.create", compact("topics"));
    }

     public function store(Request $request){
        $validated = $request->validate([
            "topic" => ["required", "max:20"],
          ]);
        Topic::create([
            "topic" => $validated["topic"], 
          ]);
            return redirect("/quiz/create");
    }


    public function answer(Request $request, Topic $topic)
    {
    $answers = session()->get('answers', []);
    $answers[$request->question_id] = $request->answer_id;
    session()->put('answers', $answers);

    $currentPage = (int) $request->page;
    $totalQuestions = $topic->questions()->count();

    if ($currentPage >= $totalQuestions) {

        $score = 0;

        foreach ($answers as $questionId => $answerId) {
            $correct = \App\Models\Answer::where('question_id', $questionId)
                ->where('is_correct', true)
                ->first();

            if ($correct && $correct->id == $answerId) {
                $score++;
            }
        }

          Result::create([
            "score" => $score,
            "total" => $totalQuestions,
            "topic_id" => $topic->id,
            "user_id" => auth()->id()
          ]);

        session()->forget('answers');

        return view('quiz.result', [
            'topic_id' => $topic->id,
            'topic' => $topic->topic,
            'score' => $score,
            'total' => $totalQuestions
        ]);
    }

    return redirect()->route('quiz.show', [
        'topic' => $topic->id,
        'page' => $currentPage + 1
    ]);
    }

}
