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
        'topic_id'         => 'required|exists:topics,id',
        'question'         => 'required|string',
        'answers'          => 'required|array|min:2',
        'answers.*.text'   => 'required|string',
        'answers.*.correct'=> 'nullable|in:0,1',
    ]);

    $question = Question::create([
        'topic_id' => $validated['topic_id'],
        'question' => $validated['question'],
    ]);

    foreach ($validated['answers'] as $answer) {
        Answer::create([
            'question_id' => $question->id,
            'answer'      => $answer['text'],
            'is_correct'  => isset($answer['correct']) ? 1 : 0,
        ]);
    }

    return back()->with('success', 'Question created!');
    }

}
