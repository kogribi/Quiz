<?php

namespace App\Http\Controllers;

use App\Models\Result;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    public function index()
    {
        $results = Result::with('topic')
        ->where('user_id', auth()->id())
        ->get()
        ->groupBy('topic_id')
        ->map(function ($group) {
            return $group->sortByDesc('score')->first();
        })
        ->values();
        return view("result.index", compact("results"));
    }

}
