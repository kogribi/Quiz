<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $fillable = [
    'topic'
];

    public function questions()
{
    return $this->hasMany(Question::class);
}

public function results()
{
    return $this->hasMany(Result::class);
}
}
