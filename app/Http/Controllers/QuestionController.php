<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Answer;
use App\Models\Topic;
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

    public function edit(Question $question){
        $topics = Topic::all();
        return view('question.edit', compact('question', 'topics'));
    }

    public function update(Request $request, Question $question)
{
    $validated = $request->validate([
        'topic_id'         => 'required|exists:topics,id',
        'question'         => 'required|string',
        'answers'          => 'required|array|min:2',
        'answers.*.id'     => 'nullable|exists:answers,id',
        'answers.*.text'   => 'required|string',
        'answers.*.correct'=> 'nullable',
    ]);

    
    $question->update([
        'topic_id' => $validated['topic_id'],
        'question' => $validated['question'],
    ]);

    
    foreach ($validated['answers'] as $answerData) {
        $question->answers()->updateOrCreate(
            ['id' => $answerData['id'] ?? null], 
            [
                'answer' => $answerData['text'],
                'is_correct' => isset($answerData['correct']) ? 1 : 0,
            ]
        );
    }

    return redirect()->route('quiz')->with('success', 'Updated!');
}

    public function destroy(Question $question){
        $question->delete();
        return redirect()->back()->with('success', 'Question deleted!');
    }
}
