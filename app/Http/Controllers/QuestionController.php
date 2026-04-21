<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Answer;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index()
    {
        $questions = Question::all();
        return view("question.index", compact("question"));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
        'topic_id' => 'required',
        'question' => 'required',
        'answers' => 'required|array|min:2',
        'correct_answer' => 'required'
    ]);

    $question = Question::create([
        'topic_id' => $validated["topic_id"],
        'question' => $validated["question"]
    ]);

    foreach ($request->answers as $index => $answerText) {
        Answer::create([
            'question_id' => $question->id,
            'answer' => $answerText,
            'is_correct' => $index == $request->correct_answer
        ]);
    }

    return back()->with('success', 'Question created!');
    }

}
