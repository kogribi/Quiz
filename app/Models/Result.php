<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $fillable = [
    'score',
    'total',
    'topic_id',
    'user_id'
];

public function topic()
{
    return $this->belongsTo(Topic::class);
}
public function user()
{
    return $this->belongsTo(User::class);
}
}
