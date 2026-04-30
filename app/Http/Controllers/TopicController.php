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
public function start(Topic $topic)
        {
        $questionIds = $topic->questions()
            ->inRandomOrder()
            ->pluck('id')
            ->toArray();

        session([
            'quiz_question_order' => $questionIds,
            'answers' => [] // reset answers
        ]);

        return redirect()->route('quiz.show', [
            'topic' => $topic->id,
            'page' => 1
        ]);
        }

    public function show(Request $request, Topic $topic)
    {
    $questionIds = session('quiz_question_order');

    if (!$questionIds) {
        return redirect()->route('quiz.start', $topic->id);
    }

    $validIds = $topic->questions()->pluck('id')->toArray();

    if (count(array_diff($questionIds, $validIds)) > 0) {
        return redirect()->route('quiz.start', $topic->id);
    }

    $currentPage = (int) $request->get('page', 1);

    $currentId = $questionIds[$currentPage - 1] ?? null;

    if (!$currentId) {
        abort(404);
    }

    $question = $topic->questions()
        ->with('answers')
        ->findOrFail($currentId);

    return view("quiz.show", [
        "topic" => $topic,
        "question" => $question,
        "currentPage" => $currentPage,
        "total" => count($questionIds)
    ]);
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

    public function update(Request $request, Topic $topic){
        $validated = $request->validate([
            "topic" => ["required", "max:50"],
          ]);
        $topic->update([
        'topic' => $validated['topic']
    ]);
    return response()->json(['success' => true], 200);
    }

    public function destroy(Topic $topic){
        $topic->delete();
        return response()->json(['success' => true], 200);
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
