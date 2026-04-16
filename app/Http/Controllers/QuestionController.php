<?php

namespace App\Http\Controllers;

use App\Models\Question;
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
            "topic_id" => ["required", "exists:topics,id"],
            "question" => ["required", "max:50"],
          ]);
        Question::create([
            "topic_id" => $validated["topic_id"], 
            "question" => $validated["question"],
          ]);
            return redirect("/quiz/create");
    }

}
