<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;

class TopicController extends Controller
{
   public function index(){
        $topics = Topic::all();
        return view("quiz.index", compact("topics"));

    }

    public function show(Topic $topic) {
        $topic->load('questions.answers');
        return view("quiz.show", compact("topic"));

    }

}
