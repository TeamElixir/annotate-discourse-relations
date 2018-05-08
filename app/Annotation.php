<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Annotation extends Model
{
    public function user() {
        return $this->belongsTo(User::class);
    }

    public function sentencePair() {
        return $this->belongsTo(SentencePair::class);
    }
}
