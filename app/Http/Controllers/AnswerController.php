<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    public function index()
    {
        //
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            "question_id" => ["required", "exists:questions,id"],
            "answer" => ["required", "max:50"],
            "is_correct" =>["int"]
          ]);
        Answer::create([
            "question_id" => $validated["question_id"], 
            "answer" => $validated["answer"],
            "is_correct" => $validated["is_correct"]
          ]);
            return redirect("/quiz/create");
    }
}
