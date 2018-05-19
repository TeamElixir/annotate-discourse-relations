<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SentencePair extends Model
{
    protected $table = "annotated_sentence_pairs";
    protected $attributes = [
        'AuthUserId' => '',
        'SourceSentence' => '',
        'TargetSentence' => '',
        'OriginalRelation' => '',
    ];

    public function annotations() {
        return $this->hasMany(Annotation::class);
    }

    public function getOriginalRelationAttribute() {
        $r = Relation::find($this->relation);
        return $r->relation;
    }

    public function getAuthUserIdAttribute() {
        $id = Auth::user()->id;
        return $id;
    }

    public function getSourceSentenceAttribute() {
        $source_sentence = Sentence::find($this->source_sntc_id);
        return $source_sentence;
    }

    public function getTargetSentenceAttribute() {
        $target_sentence = Sentence::find($this->target_sntc_id);
        return $target_sentence;
    }

}
