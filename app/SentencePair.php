<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SentencePair extends Model
{
    protected $table = "annotated_sentence_pairs";

    public function annotations() {
        return $this->hasMany(Annotation::class);
    }
}
